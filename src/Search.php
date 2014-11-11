<?php
include_once "DataAccessLayer/Fireball.php";
include_once "Searchable.php";


/**
 * Provides static methods for search funcitonality.
 */
class Search {


    /**
     * Runs a search query
     */
    public static function runQuery($que) {
        $query = explode(" ", $que);

        //funciton used to gather and score results
        $addToResults = function (&$results, $query) {
            while ($result = $query->fetch()) {
                if (isset($results[$result['ID']])) {
                    $results[$result['ID']]['score']++;

                } else {
                    $result['score'] = 0; //default priority
                    $results[$result['ID']] = $result;
                }
            }
        };

        //sub-array compare funciton used later for sorting.
        function cmp($a, $b) {
            if ($a['score'] == $b['score']) {
                return 0;
            }
            return ($a['score'] > $b['score']) ? -1 : 1;
        }

        $results = array();

        foreach($query as $q) { //for each word the user searched

            if ($q != "" && $q != "%") {

                $q = $q . "%";
                $query = Fireball\ORM::getConnection()->prepare('SELECT ' . Searchable::PRIMARY_KEY .
                                                                ' FROM ' . Searchable::TABLE_NAME .
                                                                ' where ' . Searchable::TITLE .
                                                                ' COLLATE latin1_general_ci LIKE :q'
                );

                $query->execute(array(':q' => $q));
                $query->setFetchMode(PDO::FETCH_ASSOC);



                $addToResults($results, $query);
                $query = Fireball\ORM::getConnection()->prepare('SELECT ' . Searchable::PRIMARY_KEY.
                                                                ' FROM ' . Searchable::TABLE_NAME .
                                                                ' where match(' . Searchable::CONTENT . ')' .
                                                                ' against (:q)'
                );

                $query->execute(array(':q' => $q));
                $query->setFetchMode(PDO::FETCH_ASSOC);

                $addToResults($results, $query);

            }

        }


        usort($results, "cmp");
        $out = array();
        foreach ($results as $result) {
            $out[] = $result['ID'];
        }

        return $out;

    }


}



?>
