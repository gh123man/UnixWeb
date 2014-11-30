<?php
chdir('..');
include_once './DBConnect.php';
include_once "src/Search.php";



if (isset($_GET['q'])) {
    $result = Search::runQuery($_GET['q']);

    $out = array();

    foreach ($result as $id) {
        $item = new Searchable($id);
        $content = $item->content();
        $out[] = array(
            'title'   => $item->title(),
            'path'    => $item->path(),
            'content' => substr($content, 0, 100),
        );
    }
    echo json_encode($out);
}


?>
