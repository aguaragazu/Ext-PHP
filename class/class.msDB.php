<?php


//	File name : connect.php
//	Save database connection

require ABSPATH.'includes/ADOdb/adodb-exceptions.inc.php';
require ABSPATH.'includes/ADOdb/adodb.inc.php';

class msDB
{ // define the properties
    public $db;
    public $message;
    protected $sql_query;
    protected $sql_array;

    // initialize class
    public function __construct()
    {
        $this->messsage = 'initialize class';
    }

    // define the methods

    public function connect()
    {
        global $conf_db;
        try {
            $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
            $mode = 'mysqli';
            if ($conf_db) {
                $mode = $conf_db['db_type'];
            }
            $this->db = adoNewConnection($mode);
            if ($conf_db) {
                $this->db->connect($conf_db['db_host'], $conf_db['db_user'], $conf_db['db_pwd'], $conf_db['db_name']) or die('COULD NOT SELECT DATABASE.<br>');
            } else {
                $this->db->connect(HOST, USER, PASS, DB) or die('COULD NOT SELECT DATABASE.<br>');
            }

            return 0;
        } catch (exception $e) {
            var_dump($e);
            adodb_backtrace($e->gettrace());
            $this->message = $e.' -> '.$this->db->errorMsg();

            return 1;
        }
    }

    public function connectBy($the_db)
    {
        $this->db = $the_db;
    }

    /**
     * Execute String Sql
     * Use executeSQL to return resutl.
     *
     * @param string $the_sql
     */
    public function setSQL($the_sql)
    {
        $this->sql_query = $the_sql;
    }

    public function setArray($the_array)
    {
        $this->sql_array = $the_array;
    }

    /**
     * Execute sql with Array Pakcet.
     *
     * @param string $sql_query
     * @param array  $sql_array
     *
     * @return recordset
     */
    protected function execSQL($sql_query, $sql_array)
    {
        $result = '';
        try {
            if ($sql_array) {
                $result = $this->db->execute($this->db->prepare($sql_query), $sql_array);
            } else {
                $result = $this->db->execute($sql_query);
            }
            $this->message = 'Execute SQL Succeed ';
        } catch (exception $e) {
            $this->message = 'Failed to execute '.$sql_query.
                          '---->'.$e.'--->'.$this->db->errorMsg();
        }

        return $result;
    }

    /**
     * Return recordset after setSQL.
     *
     * @return recordset
     */
    public function executeSQL()
    {
        $result = '';
        try {
            if ($this->sql_array) {
                $result = $this->db->execute($this->db->prepare($this->sql_query), $this->sql_array);
            } else {
                $result = $this->db->execute($this->sql_query);
            }
            $this->message = 'Execute SQL Succeed ';
        } catch (exception $e) {
            $this->message = 'Failed to execute '.$this->sql_query.
                          '---->'.$e.'--->'.$this->db->errorMsg();
        }

        return $result;
    }

    public function getLastID()
    {
        return $this->db->insert_id();
    }

    public function getAskTag($len)
    {
        $tmp = array();
        for ($i = 1; $i <= $len; ++$i) {
            $tmp[] = '?';
        }

        return implode(',', $tmp);
    }

    // de-initialize class
    public function __destruct()
    {
        unset($db);
        unset($messsage);
    }

    //end of class msDB
}
//end of file
