<?php

//THIS IS TEMP, DO NOT RUN UNLESS YOU KNOW WHAT YOU ARE DOING

include_once 'DBConnect.php';
include_once 'src/Searchable.php';
include_once 'src/Search.php';

//$test = Searchable::createNew('test', 'BODY asdf asdf asdf sdf fdsas df');

//echo $test->title();
//echo $test->content();


$query = Fireball\ORM::getConnection()->prepare(
    'DELETE FROM ' . Searchable::TABLE_NAME
);

$query->execute();



$docs = 'docs';
$tut = 'tutorials';
$quiz = 'quizzes';

index($docs);
index($tut);
index($quiz);


function index($dir) {
    $updateCount = 0;
    $searchDir = './content/';
    $files = scandir($searchDir . $dir);
    $files = array_slice($files, 2);

    foreach ($files as $file) {
        $name = explode('.', $file);
        if (isset($name[1]) && ($name[1] == "php" || $name[1] == "html")) {
            $fname = $name[0];
            $content = file_get_contents($searchDir . $dir . '/' . $file);
            $content = strip_tags($content);

            if ($fname == "index") {
                Searchable::createNew($dir, $content, '/' . $dir);
            } else {
                Searchable::createNew($fname, $content, '/' . $dir . '/' . $fname);
            }
            $updateCount++;


        }
    }
    echo "Indexed $updateCount $dir's <br>";

}







?>
