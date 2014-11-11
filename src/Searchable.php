<?php

include_once 'DataAccessLayer/Fireball.php';
/*
create table Searchable (
    ID char(32) NOT NULL,
    title varchar(80) NOT NULL,
    content TEXT NOT NULL,
    PRIMARY KEY (ID)
) ENGINE=MyISAM;
*/

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
        $def->addCol(self::TITLE);
        $def->addCol(self::CONTENT);
        $def->addCol(self::PATH);
    }

    public static function createNew($title, $content, $type) {
        $ID = Fireball\ORM::createUniquePrimaryKey(self::TABLE_NAME, self::PRIMARY_KEY, $title);
        if (Fireball\ORM::newRecord(self::TABLE_NAME, self::$fields, array($ID, $title, $content, $type))) {
            return new self($ID);
        }
    }


}





?>
