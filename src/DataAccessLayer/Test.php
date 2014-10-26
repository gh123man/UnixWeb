<?php

include_once 'Fireball.php';


/*
create table test(
    ID char(32) NOT NULL,
    test varchar(80) NOT NULL,
    PRIMARY KEY (ID)
    );

*/
class Test extends Fireball\ORM {

    private static $TABLE_NAME  = 'test';
    private static $PRIMARY_KEY = 'ID';
    private static $TEST        = 'test';

    //Override
    protected function setUp(Fireball\TableDef $def) {
        $def->setName(self::$TABLE_NAME);
        $def->addKey(self::$PRIMARY_KEY);
        $def->addCol(self::$TEST);
    }
    
    public static function newTest($test) {
        $fields = array(self::$PRIMARY_KEY, self::$TEST);
        $ID = Fireball\ORM::createUniquePrimaryKey(self::$TABLE_NAME, self::$PRIMARY_KEY, $test);
        if (Fireball\ORM::newRecord(self::$TABLE_NAME, $fields, array($ID, $test))) {
            return new self($ID);
        }
    }


}





?>
