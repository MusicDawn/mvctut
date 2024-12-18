<?php

namespace UserControllerSpace;

use Exception;
use UserModelNamespace\ListModel;

class ListController
{
    private $con;
    public function __construct()
    {
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
}
