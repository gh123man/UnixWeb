<?php
include_once 'components/helpers/url.php';
include_once 'components/PrimaryNavBuilder.php';
include_once 'Doc.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <title>Group Site</title>
    </head>

    <body>
        <?php
t
        $urlParams = parseUrl();

        //builds and displays the local nav
        $primaryNav = new PrimaryNavBuilder(array(
            "test"  => "test",
            "test1" => "test",
            "test2" => "test",
        ));
        $primaryNav->display();

        //decides which kind of page to display
        switch ($urlParams[0]) {

            case "doc":
                try {
                    $docPage = new Doc($urlParams);
                    $docPage->display();
                    break;
                } catch (Exception $e) {}



            default:
                //ob_clean();
                echo '<iframe width=1000 height=1000 src="http://www.thebest404pageever.com"></iframe>';
                //echo "page not found";
        }
        ?>

    </body>
</html>
