<?php
include_once 'DBConnect.php';
include_once 'components/helpers/url.php';
include_once 'components/drawFunctions.php';
include_once 'components/PrimaryNavBuilder.php';
include_once 'components/Doc.php';
include_once 'components/Quiz.php';
include_once 'components/Tutorial.php';
include_once 'components/home.php';
include_once 'components/accountUtils.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <title>Unix Web</title>
    </head>

    <link rel="stylesheet" href="/static/css/core.css"/>
    <link rel="stylesheet" href="/static/js/jqueryUi/jquery-ui.css"/>
    <script src="/static/js/jquery/jquery.js"></script>
    <script src="/static/js/jqueryUi/jquery-ui.js"></script>
    <script src="/static/js/search.js"></script>
    <script src="/static/js/login.js"></script>

    <body>
        <?php


        $urlParams = parseUrl();

        //builds and displays the local nav
        $primaryNav = new PrimaryNavBuilder(array(
            "Docs"      => "/docs",
            "Tutorials" => "/tutorials",
            "Quizzes"   => "/quizzes",
            "History"   => "/histroy",
        ));


        $primaryNav->display('drawLogo', 'drawRightNavContent');

        ?>
        <div class="pageContentWrapper">
            <?php

            //decides which kind of page to display
            switch ($urlParams[0]) {

                case "": //home page
                    displayHome();
                    break;

                case "docs":
                    try {
                        $docPage = new Doc($urlParams);
                        $docPage->display();
                        break;
                    } catch (Exception $e) {
                        error_log($e);
                    }

                case "tutorials":
                    try {
                        $tutorialPage = new Tutorial($urlParams);
                        $tutorialPage->display();
                        break;
                    } catch (Exception $e) {
                        error_log($e);
                    }
                case "quizzes":
                    try {
                        $quiz = new Quiz($urlParams);
                        $quiz->display();
                        break;
                    } catch (Exception $e) {
                        error_log($e);
                    }
                case "histroy":
                        include_once 'components/History.php';
                        break;

                default:
                    echo "<h1> 404 </h1>";
                    //echo '<div id="errorPage"><iframe width="100%" height="1000px" frameborder="0" src="http://www.thebest404pageever.com"></iframe><div>';
            }
            ?>
        </div>
    </body>
</html>
