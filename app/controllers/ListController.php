<?php

namespace UserControllerSpace;

use Exception;
use UserModelNamespace\ListModel;

class ListController
{
    // this private $con is defined inside this class has nothing to do with the $con that is in the mysqlconnect.php file
    private $con;
    public function __construct()
    {
        // global $con is the $con that is in the mysqlconnect.php file
        global $con;
        $this->con = $con;
    }

    public function listusers()
    {
        try {
            $result = new ListModel;
            if (!$result) throw new Exception("Instantiaton failure");
            $rows = $result->list($this->con);
            if (!$rows) throw new Exception("Method failure");
            require_once('app/views/list.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function listusersfa()
    {
        try {
            $inst = new ListModel;
            if (!$inst) throw new Exception("Instantiaton failure");
            $result = $inst->list($this->con);
            if (!$result) throw new Exception("Method failure");
            require_once('app/views/list.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

     public function singleuser()
     {
        try {
            $result = new ListModel;
            if (!$result) throw new Exception("Instantiaton failure");
            $rows = $result->single($this->con, $_GET["id"]);
            if (!$rows) throw new Exception("Method failure");
            require_once('app/views/list.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
     }

     public function singleuserfa()
     {
        try {
            $inst = new ListModel;
            if (!$inst) throw new Exception("Instantiaton failure");
            $result= $inst->single($this->con, $_GET["id"]);
            if (!$result) throw new Exception("Method failure");
            $row = $result->fetch_assoc();
            require_once('app/views/list.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
     }
}
