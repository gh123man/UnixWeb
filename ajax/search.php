<?php
chdir('..');
include_once './DBConnect.php';
include_once "src/Search.php";



if (isset($_GET['q'])) {
    $results = Search::runQuery($_GET['q']);

    $out = array();

    foreach ($results as $item) {

        try {
            $content = $item->content();
            $out[] = array(
                'title'   => $item->title(),
                'path'    => $item->path(),
                'content' => substr($content, 0, 100),
            );
        } catch (Exception $e) {

        }
    }
    echo json_encode($out);
}


?>
