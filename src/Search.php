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
        $addToResults = function (&$results, $newItems, $baseScore = 0) {
            foreach ($newItems as $item) {

                if (isset($results[$item->ID()])) {
                    $results[$item->ID()]['score']++;

                } else {

                    $result = array (
                        'ID' => $item->ID(),
                        'obj' => $item,
                        'score' => $baseScore,
                    );

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
            $out[] = $result['obj'];
        }

        return $out;

    }



    private static function searchTitles($q) {

        $results = Fireball\ORM::mapQuery(function() {
            return new Searchable();
        }, Fireball\ORM::rawQuery(
            'SELECT ' . Searchable::PRIMARY_KEY .
            ' FROM ' . Searchable::TABLE_NAME .
            ' where ' . Searchable::TITLE .
            ' COLLATE latin1_general_ci LIKE :q',
            array(':q' => $q), true)
        );
        return $results;
    }

    private static function searchContent($q) {


        $results = Fireball\ORM::mapQuery(function() {
            return new Searchable();
        }, Fireball\ORM::rawQuery(
            'SELECT *' .
            ' FROM ' . Searchable::TABLE_NAME .
            ' where match(' . Searchable::CONTENT . ')' .
            ' against (:q)',
            array(':q' => $q), true)
        );
        return $results;

    }

}



?>
