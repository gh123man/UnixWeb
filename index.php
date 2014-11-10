<?php
include_once 'components/helpers/url.php';
include_once 'components/drawFunctions.php';
include_once 'components/PrimaryNavBuilder.php';
include_once 'components/Doc.php';
include_once 'components/Tutorial.php';
include_once 'components/home.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <title>Group Site</title>
    </head>

    <link rel="stylesheet" href="/static/css/core.css"/>
    <script src="/static/js/jquery/jquery.js"></script>

    <body>
        <?php

        $urlParams = parseUrl();

        //builds and displays the local nav
        $primaryNav = new PrimaryNavBuilder(array(
            "Docs"      => "/docs",
            "Tutorials" => "/tutorials",
        ));


        $primaryNav->display('drawLogo', 'drawSearch');

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

                default:
                    //404
                    //echo '<div id="errorPage"><iframe width="100%" height="1000px" frameborder="0" src="http://www.thebest404pageever.com"></iframe><div>';
            }
            ?>
        </div>
    </body>
</html>
