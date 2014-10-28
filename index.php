<?php
include_once 'components/helpers/url.php';
include_once 'components/drawFunctions.php';
include_once 'components/PrimaryNavBuilder.php';
include_once 'Doc.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <title>Group Site</title>
    </head>

    <link rel="stylesheet" href="/static/css/core.css"/>

    <body>
        <?php

        $urlParams = parseUrl();

        //builds and displays the local nav
        $primaryNav = new PrimaryNavBuilder(array(
            "Docs"  => "/doc",
            "test1" => "/test",
            "test2" => "/test",
        ));


        $primaryNav->display('drawLogo', 'drawSearch');

        ?>
        <div class="pageContentWrapper">
            <?php

            //decides which kind of page to display
            switch ($urlParams[0]) {

                case "": //home page
                    include_once 'home.php';
                    break;

                case "doc":
                    try {
                        $docPage = new Doc($urlParams);
                        $docPage->display();
                        break;
                    } catch (Exception $e) {
                        error_log($e);
                    }



                default:
                    //ob_clean();
                    //echo '<iframe width=1000 height=1000 src="http://www.thebest404pageever.com"></iframe>';
                    echo "page not found";
            }
            ?>
        </div>
    </body>
</html>
