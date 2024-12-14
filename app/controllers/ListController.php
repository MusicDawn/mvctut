<?php

namespace UserControllerSpace;

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
        $result = new ListModel;
        $rows = $result->list($this->con);
        require_once('app/views/list.php');
    }
}