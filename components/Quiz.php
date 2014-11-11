<?php

include_once './components/LocalNavBuilder.php';
include_once 'PageBuilder.php';

class Quiz extends PageBuilder {

    function getPageTypePath() {
        return './content/quizzes/%s.php';
    }

    function getPageHeader($page) {
        echo "$page Quiz!";
    }

    function getDefaultPage() {
        include_once './content/quizzes/index.html';
    }

    function getLocalNav() {
        return new LocalNavBuilder('content/quizzes', 'quizzes');
    }

}
?>
