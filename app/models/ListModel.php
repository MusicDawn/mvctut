<?php

namespace UserModelNamespace;

use Exception;

class ListModel
{
    public function list($con)
    {
        try {
            $sql = "SELECT * FROM users";
            $result = $con->query($sql);
            if($con->error) throw new Exception("Datababase Error: " . $con->error); 
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
