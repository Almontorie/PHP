<?php
/**
 * Created by PhpStorm.
 * User: almontorie
 * Date: 24/11/18
 * Time: 09:53
 */

class ConnexionDB extends PDO
{
    private $stmt;

    public function __construct($dsn, $username, $passwd)
    {
        parent::__construct($dsn, $username, $passwd);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function executeQuery($query, array $parameters = [])
    {
        try {
            $this->stmt = parent::prepare($query);
            foreach ($parameters as $name => $value) {
                $this->stmt->bindValue($name, $value[0], $value[1]);
            }
            return $this->stmt->execute();
        }
        catch (PDOException $e){
            throw $e;
        }
    }

    public function getResults(){
        return $this->stmt->fetchall();
    }

    public function getRowCount(){
        return $this->stmt->rowCount();
    }
}