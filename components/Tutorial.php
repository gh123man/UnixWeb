<?php

include_once './components/LocalNavBuilder.php';
include_once 'PageBuilder.php';

class Tutorial extends PageBuilder {


    function getPageTypePath() {
        return './content/tutorials/%s.html';
    }

    function getPageHeader($page) {
        echo "Tutorial of $page";
    }

    function getDefaultPage() {
        include_once './content/tutorials/index.html';
    }

    function getLocalNav() {
        return new LocalNavBuilder('content/tutorials', 'tutorials');
    }

}
?>
