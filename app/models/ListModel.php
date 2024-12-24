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

    public function single($con, $id)
    {
        try {
            // We using prepare/bind_para/execute so we dont get hacked!
            $sql = "SELECT * FROM users WHERE id=?"; 
            $stm = $con->prepare($sql);
            $stm->bind_param("s", $id);
            $stm->execute();
            $result = $stm->get_result();
            if($con->error) throw new Exception("Datababase Error: " . $con->error); 
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
