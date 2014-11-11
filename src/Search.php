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
        $addToResults = function (&$results, $query, $baseScore = 0) {
            while ($result = $query->fetch()) {
                if (isset($results[$result['ID']])) {
                    $results[$result['ID']]['score']++;

                } else {
                    $result['score'] = $baseScore; // priority
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

        $addToResults($results, self::searchContent($que), 2); //full query full text matches take priority

        foreach($query as $q) { //for each word the user searched

            if ($q != "" && $q != "%") {

                $q = $q . "%";


                $addToResults($results, self::searchTitles($q), 3); //exact title match takes highest priority

                $addToResults($results, self::searchContent($q));

            }

        }

        usort($results, "cmp");
        $out = array();
        foreach ($results as $result) {
            $out[] = $result['ID'];
        }

        return $out;

    }

    private static function searchTitles($q) {
        $query = Fireball\ORM::getConnection()->prepare(
            'SELECT ' . Searchable::PRIMARY_KEY .
            ' FROM ' . Searchable::TABLE_NAME .
            ' where ' . Searchable::TITLE .
            ' COLLATE latin1_general_ci LIKE :q'
        );

        $query->execute(array(':q' => $q));
        $query->setFetchMode(PDO::FETCH_ASSOC);
        return $query;
    }

    private static function searchContent($q) {
        $query = Fireball\ORM::getConnection()->prepare(
            'SELECT ' . Searchable::PRIMARY_KEY.
            ' FROM ' . Searchable::TABLE_NAME .
            ' where match(' . Searchable::CONTENT . ')' .
            ' against (:q)'
        );

        $query->execute(array(':q' => $q));
        $query->setFetchMode(PDO::FETCH_ASSOC);
        return $query;
    }


}



?>
