<?php

include_once './components/LocalNavBuilder.php';
include_once 'PageBuilder.php';

class Doc extends PageBuilder {

    function getPageTypePath() {
        return './content/docs/%s.html';
    }

    function getPageHeader($page) {
        echo "$page Documentation";
    }

    function getDefaultPage() {
        include_once './content/docs/index.html';
    }

    function getLocalNav() {
        return new LocalNavBuilder('content/docs', 'docs');
    }

}
?>
