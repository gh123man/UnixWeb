<?php

include_once 'DataAccessLayer/Fireball.php';

class Account extends Fireball\ORM {

    const TABLE_NAME  = 'Account';
    const PRIMARY_KEY = 'ID';
    const EMAIL       = 'email';
    const FNAME       = 'fname';
    const LNAME       = 'lname';
    const HASH        = 'hash';
    const SALT        = 'salt';
    const TIME        = 'time';

    private static $fields = array (
        self::PRIMARY_KEY,
        self::EMAIL,
        self::FNAME,
        self::LNAME,
        self::HASH,
        self::SALT,
        self::TIME
    );

    //Override
    protected function setUp(Fireball\TableDef $def) {
        $def->setName(self::TABLE_NAME);
        $def->addKey(self::PRIMARY_KEY);
        $def->setCols(self::$fields);
    }

    public static function createNew($email, $password, $fname, $lname) {
        if (strlen($email) <= 0 || strlen($password) <= 0 || strlen($fname) <= 0 || strlen($lname) <= 0) {
            throw new Exception("Invalid input");
        }

        if (self::accountExistsEmail($email)) {
            throw new Exception("Account already Exists");
        }

        $ID = Fireball\ORM::createUniquePrimaryKey(self::TABLE_NAME, self::PRIMARY_KEY, $title);

        $bytes = openssl_random_pseudo_bytes(16, $cstrong);
        $salt = md5(sha1($bytes));
        $hash = self::hashPassword($password, $salt);


        if (Fireball\ORM::newRecord(self::TABLE_NAME, self::$fields, array($ID, $email, $fname, $lname, $hash, $salt, time()))) {
            return new self($ID);
        } else {
            throw new Exception("account creation failed");
        }

    }


     public static function login($email, $password) {
        if (!self::accountExistsEmail($email)) {
            throw new Exception("Account Does Not Exist");
        }
        $account = self::fromEmail($email);
        $hash = self::hashPassword($password, $account->salt());

        if ($account->hash() == $hash) {
            return $account;
        } else if ($account->email() == $email) {
            return false;
        }
    }

    public static function accountExistsEmail($email) {
        return Fireball\ORM::rowExistsFrom(self::TABLE_NAME, self::EMAIL, $email);
    }

    protected function hashPassword($password, $salt) {
        return substr(crypt($password, '$6$rounds=5000$' . $salt . '$'), 15);
    }

    public static function fromEmail($email) {
        $result = Fireball\ORM::dbSelect(self::PRIMARY_KEY, self::TABLE_NAME, self::EMAIL, $email);
        return new Account($result);
    }


}

?>
