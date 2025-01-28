<?php

namespace UserControllerSpace;

use Exception;
use UserModelNamespace\ListModel;

class ListController
{
    // this $con is defined inside this class has nothing to do with the $con that is in the mysqlconnect.php file
    public $con;
    public $uri;
    public function __construct($uri1 = null, $con1 = null)
    {
        $this->uri = $uri1 ?? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // $this->con is the $con that is in the mysqlconnect.php file 
        // The variable $con and the contructor are set like this to assist testing
        $this->con = $con1 ?? $GLOBALS['con'];
    }

    public function listusers()
    {
        $uri = $this->uri;
        try {
            $result = new ListModel;
            if (!$result) throw new Exception("Instantiaton failure");
            $rows = $result->list($this->con);
            if (!$rows) throw new Exception("Method failure");
            require('app\views\components\header.php');
            foreach ($rows as $row) {
                require('app/views/list.php');
            }
            echo "</table>";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function listusersfa()
    {
        $uri = $this->uri;
        try {
            $inst = new ListModel;
            if (!$inst) throw new Exception("Instantiaton failure");
            $result = $inst->list($this->con);
            if (!$result) throw new Exception("Method failure");
            require('app\views\components\header.php');
            while ($row = $result->fetch_assoc()) {
                require('app/views/list.php');
            }
            echo "</table>";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function singleuser($id = NULL)
    {
        $id = $id ?? $_GET["id"];
        $uri = $this->uri;
        try {
            $result = new ListModel;
            if (!$result) throw new Exception("Instantiaton failure");
            $rows = $result->single($this->con, $id);
            if (!$rows) throw new Exception("Method failure");
            require('app\views\components\header.php');
            foreach ($rows as $row) {
                require('app/views/list.php');
            }
            echo "</table>";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function singleuserfa($id = NULL)
    {
        $uri = $this->uri;
        $id = $id ?? $_GET["id"];
        try {
            $inst = new ListModel;
            if (!$inst) throw new Exception("Instantiaton failure");
            $result = $inst->single($this->con, $id);
            if (!$result) throw new Exception("Method failure");
            require('app\views\components\header.php');
            $row = $result->fetch_assoc();
            require('app/views/list.php');
            echo "</table>";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //Wild card removing $_GET! and qury_string!
    public function singleuserfawc($id)
    {
        $uri = $this->uri;
        try {
            $inst = new ListModel;
            if (!$inst) throw new Exception("Instantiaton failure");
            $result = $inst->singlewc($this->con, $id);
            if (!$result) throw new Exception("Method failure");
            require('app\views\components\header.php');
            $row = $result->fetch_assoc();
            require('app/views/list.php');
            echo "</table>";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    //-------- Ajax functions
    public function ajaxload()
    {
        require('app/views/listajax.php');
    }

    public function ajaxlistusers()
    {
        // echo "Ignore the page :D";
        try {
            $result = new ListModel;
            if (!$result) throw new Exception("Instantiaton failure");
            $rows = $result->list($this->con);
            if (!$rows) throw new Exception("Method failure");
            $users = [];
            while ($row = $rows->fetch_assoc()) {
                $users[] = $row;
            }
            header('Content-Type: application/json');
            ob_clean();
            //The method json_encode bring the $users to a json format!
            echo json_encode($users);
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    public function ajaxsingleuser($id)
    {
        try {
            $inst = new ListModel;
            if (!$inst) throw new Exception("Instantiaton failure");
            $result = $inst->singlewc($this->con, $id);
            if (!$result) throw new Exception("Method failure");
            $row = $result->fetch_assoc();
            header('Content-Type: application/json');
            ob_clean();
            //The method json_encode bring the $users to a json format!
            echo json_encode($row);
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function ajaxsingleuserQ($id = NULL)
    {
        $id = $id ?? $_GET["id"];
        try {
            $inst = new ListModel;
            if (!$inst) throw new Exception("Instantiaton failure");
            $result = $inst->single($this->con, $id);
            if (!$result) throw new Exception("Method failure");
            $row = $result->fetch_assoc();
            header('Content-Type: application/json');
            ob_clean();
            //The method json_encode bring the $users to a json format!
            echo json_encode($row);
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
