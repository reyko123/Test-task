<?php

class MyPDO extends PDO
    {
        public function run($sql, $args = NULL)
    {
            $stmt = $this->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }
    }