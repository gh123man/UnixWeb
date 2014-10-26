<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <title>Group Site</title>
    </head>

    <body>

        <?php

        include_once 'helpers/url.php';
        include_once 'Doc.php';


        $urlParams = parseUrl();

        switch ($urlParams[0]) {

            case "doc":
                try {
                    $docPage = new Doc($urlParams);
                    $docPage->display();
                    break;
                } catch (Exception $e) {}



            default:
               echo "page not found";
        }
        ?>

    </body>
</html>
