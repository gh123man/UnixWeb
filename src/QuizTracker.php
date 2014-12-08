<?php

include_once 'DataAccessLayer/Fireball.php';

class QuizTracker extends Fireball\ORM {

    const TABLE_NAME  = 'QuizTracker';
    const PRIMARY_KEY = 'ID';
    const USER        = 'user';
    const NAME        = 'name';
    const SCORE       = 'score';
    const POINTS      = 'points';
    const PATH        = 'path';
    const TIME        = 'time';

    private static $fields = array (
        self::PRIMARY_KEY,
        self::USER,
        self::NAME,
        self::SCORE,
        self::POINTS,
        self::PATH,
        self::TIME
    );

    //Override
    protected function setUp(Fireball\TableDef $def) {
        $def->setName(self::TABLE_NAME);
        $def->addKey(self::PRIMARY_KEY);
        $def->setCols(self::$fields);
    }

    private static function createNew($user, $path) {
        $ID = Fireball\ORM::createUniquePrimaryKey(self::TABLE_NAME, self::PRIMARY_KEY, $user);
        if (Fireball\ORM::newRecord(self::TABLE_NAME, self::$fields, array($ID, $user, "", 0, 0, $path, time()))) {
            return new self($ID);
        }
    }

    public static function track($user, $name, $path, $score, $points) {

        $instance = self::getInstance($user, $path);
        $instance->name($name);
        $instance->score($score);
        $instance->points($points);

    }

    private static function getInstance($user, $path) {

        $result = self::getQuiz($user, $path);

        if ($result) {
            return $result;
        } else {
            return self::createNew($user, $path);
        }

    }

    public static function getAllForUser($user) {
        $result = self::mapQuery(self::rawQuery(
                'select * from ' . self::TABLE_NAME .
                ' where ' . self::USER . ' = :u order by ' . self::NAME . ' asc',
                array(':u' => $user), true
            )
        );
        return $result;
    }

    public static function getQuiz($user, $path) {
        $result = self::mapQuery(self::rawQuery(
                'select * from ' . self::TABLE_NAME .
                ' where ' . self::PATH . ' = :p and ' . self::USER . ' = :u',
                array(':p' => $path, ':u' => $user), true
            )
        );
        return isset($result[0]) ? $result[0] : null;
    }


}





?>
