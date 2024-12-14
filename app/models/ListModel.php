<?php

namespace UserModelNamespace;

class ListModel
{
    public function list($con)
    {
        $sql = "SELECT * FROM users";
        $result = $con->query($sql);
        return $result;
    }
}
