<?php

namespace Fireball {

    use \PDO;
    use \Exception;
    use \UnexpectedValueException;

    abstract class ORM {

        private $tableDef;
        private $tableID;
        private $colChangedCache;
        private $ID;
        private static $connection;

        private static $colCacheCache;

        public function __construct($ID) {

            $this->tableDef = new TableDef();
            $this->setUp($this->tableDef);

            //self::validateTableDef($this->tableDef);

            /*
            if (!isset($ID) || !self::rowExistsFrom($this->tableName, $this->primaryKey, $ID)) {
                throw new UnexpectedValueException("ID: " . $ID . " does not exist in " . $this->tableName);
            }
            */

            $this->ID = $ID;

            $this->tableID = md5(serialize($this->tableDef));

            //Load from cache if possible TODO: test this
            if (isset(self::$colCacheCache[$this->tableID])) {
                $this->colCache = self::$colCacheCache[$tableID];
                error_log('cache loaded');
            }

        }

        protected abstract function setUp(TableDef $def);

        /**
         * intercepts funciton calls and translates them to the table columns
         */
        public function __call($col, $value = null) {
            if (in_array($col, $this->tableDef->getDef())) {
                if (isset($value[0])) {
                    $this->setCol($col, $value[0]);
                } else {
                    return $this->getCol($col);
                }
            } else {
                throw new UnexpectedValueException("Column: " . $col . " does not exist in " . $this->orm->getTableName());
            }
        }

        public function getTableName() {
            return $this->tableName;
        }

        private static function validateTableDef($tableDef) {
            if (!isset($tableDef['primaryKey'])) {
                throw new UnexpectedValueException('primaryKey must be set');
            }

            if (!isset($tableDef['fields'])) {
                throw new UnexpectedValueException('database fields must be set');
            }

            if (!isset($tableDef['table'])) {
                throw new UnexpectedValueException('table name must be set');
            }
        }

        public static function connect($db, $host, $uname, $pword) {

            $connection = new PDO('mysql:dbname=' . $db . ';host=' . $host . ';charset=utf8', $uname, $pword);
            $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$connection = $connection;
        }

        public static function getConnection() {
            if (!isset(self::$connection)) {
                throw new UnexpectedValueException("Database conneciton not set");
            }
            return self::$connection;
        }

        public function getID() {
            return $this->ID;
        }

        /**
         * selects one item from the database
         */
        public static function dbSelect($what, $table, $where, $is) {
            $query = self::getConnection()->prepare('SELECT ' . $what . ' FROM ' . $table . ' WHERE ' . $where . ' = :IS');
            $query->execute(array(':IS' => $is));
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $results = $query->fetch();
            return $results[$what];
        }

        /**
         * updates a given column in the database
         */
        public function update($col, $val, $where, $is) {
            $query = self::getConnection()->prepare('UPDATE ' . $this->tableDef->getName() . ' SET ' . $col . ' = :data WHERE ' . $where . ' = :IS');
            return ($query->execute(array(':data' => $val, ':IS' => $is)));
        }

        /**
         * method to insert a key => value array into the database
         */
        public static function newRecord($tableName, $fields, $data) {

            //self::validateTableDef($tableDef); FIX

            $keys = array();
            $qArr = array();

            $i = 0;
            foreach($fields as $field) {

                $keys[$i] = ":" . $field;
                $qArr[$keys[$i]] = $data[$i];
                $i++;
            }
            $query = self::getConnection()->prepare('INSERT INTO ' . $tableName. ' VALUES (' . implode(", ", $keys) . ')');
            return ($query->execute($qArr));
        }

        /**
         * returns true if the row exists by the given ID
         */
        public function rowExists($ID) {
            if (!isset($ID)) {
                return false;
            }

            $ID1 = self::dbSelect($this->tableDef->getKey(), $this->tableDef->getName(), $this->tableDef->getKey(), $ID);
            return $ID1 == $ID;
        }

        /**
         * returns true if the row exists by the given ID, col, and table name
         */
        public static function rowExistsFrom($table, $col, $ID) {
            if (!isset($table) || !isset($col) || !isset($ID)) {
                return false; //throw here
            }
            $ID1 = self::dbSelect($col, $table, $col, $ID);
            return $ID1 == $ID;
        }

        /**
         * interchange bridging access to the database with a runtime cache
         */
        public function getCol($col) {
            if (!isset($this->colCache) || !isset($this->colCache[$col])) {
                $this->colCache[$col] = self::dbSelect($col, $this->tableDef->getName(), $this->tableDef->getKey(), $this->getID());
                $this->colChangedCache[$col] = false;
            }
            return $this->colCache[$col];
        }

        /**
         * updates object cache and ticks change value to true
         */
        public function setCol($col, $val) {
            $this->colCache[$col] = $val;
            $this->colChangedCache[$col] = true;
            return true;
        }

        /**
         * dumps all changed values into the database
         */
        public function flush() { //TODO: update this to assemble one query
            if (isset($this->colCache) && isset($this->colChangedCache)) {
                foreach($this->colCache as $col => $val) {
                    if ($this->colChangedCache[$col]) {
                        $this->update($col, $val, $this->tableDef->getKey(), $this->getID());
                    }
                }
            }
        }

        /**
         * called on object distruction
         */
        public function __destruct() {
            $this->flush();
        }

        public static function createUniquePrimaryKey($tableName, $key, $seed) {
            //self::validateTableDef($tableDef); FIX
            while (true) {
                $ID = md5($seed . rand());
                if (!self::rowExistsFrom($tableName, $key, $ID)) {
                    return $ID;
                }
            }
        }

    }

    class TableDef {

        private $name;
        private $def;

        public function __construct() {
            $this->def = array();
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function addKey($name) {
            $this->def['KEY'] = $name;
        }

        public function addCol($name) {
            $this->def['COL'] = $name;
        }

        public function getDef() {
            return $this->def;
        }

        public function getKey() {
            return $this->def['KEY'];
        }

        public function getName() {
            return $this->name;
        }
    }
}

?>
