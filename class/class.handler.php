<?php

class handler extends msDB
{
    private $text = '';

    public function __construct($connection)
    {
        $this->messsage = 'initialize class';
        if (true == $connection) {
            $radiochecked = $this->connect();
        }
    }

    public function __destruct()
    {
        unset($radiochecked);
    }

    public function getHandler($id)
    {
        $tmp = '';
        $sql = 'select handler from menu where id =?';
        $args = array($id);
        $rs = $this->execSQL($sql, $args);
        if ($rs) {
            $tmp = $rs->fields['handler'];
        }

        return $tmp;
    }

    public function getEvent($menu_id)
    {
        $sql = 'select a.event_name AS event_name, b.is_active AS is_active
						FROM menu_event a, role_menu_event_group b
						where a.id = b.role_id and b.group_id =? 
						and a.menu_id =?
				';
        $args = array($_SESSION['group_id'], $menu_id);
        $rs = $this->execSQL($sql, $args);
        $result = array();
        if ($rs) {
            while ($row = $rs->FetchNextObject()) {
                $result[$row->EVENT_NAME] = ($row->IS_ACTIVE) ? true : false;
            }
        }

        return json_encode($result);
    }

    public function getAjax($id)
    {
        $tmp = '';
        $sql = 'select ajax,module from menu where id =?';
        $args = array($id);
        $rs = $this->execSQL($sql, $args);
        $module = '';
        if ($rs) {
            if ('' != $rs->fields['module']) {
                $module = $rs->fields['module'].'/';
            }
            $tmp = $module.$rs->fields['ajax'];
        }

        return $tmp;
    }

    public function getReport($id)
    {
        $tmp = '';
        $sql = 'select report,module from menu where id =?';
        $args = array($id);
        $rs = $this->execSQL($sql, $args);
        $module = '';
        if ($rs) {
            if ('' != $rs->fields['module']) {
                $module = $rs->fields['module'].'/';
            }
            $tmp = $module.$rs->fields['report'];
        }

        return $tmp;
    }

    public function loadModel($file)
    {
        $file_path = "app/model/{$file}.php";
        if (file_exists($file_path)) {
            include_once $file_path;
            //$_c = explode("_",$file);
                //$file = $_c[0];
                //return new $file(true);
        }
    }

    public function loadClass($file)
    {
        $file_path = "app/class/{$file}.php";
        if (file_exists($file_path)) {
            include_once $file_path;
            //return new $file(true);
        }
    }
}
