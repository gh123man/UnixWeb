<?php

include_once 'DataAccessLayer/Fireball.php';

class Searchable extends Fireball\ORM {

    const TABLE_NAME  = 'Searchable';
    const PRIMARY_KEY = 'ID';
    const TITLE       = 'title';
    const CONTENT     = 'content';
    const PATH        = 'path';

    private static $fields = array (
        self::PRIMARY_KEY,
        self::TITLE,
        self::CONTENT,
        self::PATH
    );

    //Override
    protected function setUp(Fireball\TableDef $def) {
        $def->setName(self::TABLE_NAME);
        $def->addKey(self::PRIMARY_KEY);
        $def->setCols(self::$fields);
    }

    public static function createNew($title, $content, $type) {
        $ID = Fireball\ORM::createUniquePrimaryKey(self::TABLE_NAME, self::PRIMARY_KEY, $title);
        if (Fireball\ORM::newRecord(self::TABLE_NAME, self::$fields, array($ID, $title, $content, $type))) {
            return new self($ID);
        }
    }


}





?>
