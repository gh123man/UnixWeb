<?php

include_once 'DataAccessLayer/Fireball.php';

class CommandTracker extends Fireball\ORM {

    const TABLE_NAME  = 'CommandTracker';
    const PRIMARY_KEY = 'ID';
    const NAME        = 'name';
    const HITS        = 'hits';
    const PATH        = 'path';
    const TYPE        = 'type';

    private static $fields = array (
        self::PRIMARY_KEY,
        self::NAME,
        self::HITS,
        self::PATH,
        self::TYPE,
    );

    //Override
    protected function setUp(Fireball\TableDef $def) {
        $def->setName(self::TABLE_NAME);
        $def->addKey(self::PRIMARY_KEY);
        $def->setCols(self::$fields);
    }

    private static function createNew($path, $type) {
        $ID = Fireball\ORM::createUniquePrimaryKey(self::TABLE_NAME, self::PRIMARY_KEY, $path);
        if (Fireball\ORM::newRecord(self::TABLE_NAME, self::$fields, array($ID, "", 0, $path, $type))) {
            return new self($ID);
        }
    }

    public static function track($name, $path, $type) {

        $instance = self::getInstance($path, $type);
        $instance->name($name);
        $instance->hits($instance->hits() + 1);

    }

    public function getInstanceClosure() {
        return function() {
            return new CommandTracker();
        };
    }


    private static function getInstance($path, $type) {

        $result = self::getItem($path);

        if ($result) {
            return $result;
        } else {
            return self::createNew($path, $type);
        }

    }

    public static function getItem($path) {
        $result = Fireball\ORM::mapQuery(
            self::getInstanceClosure(),
            Fireball\ORM::rawQuery(
                'select * from ' . self::TABLE_NAME . ' where ' . self::PATH . ' = :p',
                array(':p' => $path), true
            )
        );
        return isset($result[0]) ? $result[0] : null;
    }

    public static function getTopCommands($limit) {
        $result = Fireball\ORM::mapQuery(
            self::getInstanceClosure(),
            Fireball\ORM::rawQuery(
                'select * from ' . self::TABLE_NAME . ' where ' . self::TYPE . ' = :t order by hits desc limit ' . $limit,
                array(':t' => 'docs'), true
            )
        );
        return $result;
    }

    public static function getCommandOfTheDay() {
        $today = strtotime("today");

        $result = Fireball\ORM::mapQuery(
            self::getInstanceClosure(),
            Fireball\ORM::rawQuery(
                'select * from ' . self::TABLE_NAME . ' WHERE ' . self::TYPE . ' = :t ORDER BY RAND(' . $today . ') LIMIT 1',
                array(':t' => 'docs'), true
            )
        );
        return isset($result[0]) ? $result[0] : null;
    }


}





?>
