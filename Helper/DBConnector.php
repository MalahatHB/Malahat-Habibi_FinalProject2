<?php

namespace CRUD\Helper;

use mysqli;

class DBConnector
{

    /** @var mixed $db */
    private $db;

    /** @var mixed $host */
    private $host;

    /** @var mixed $host */
    private $port;

    /** @var mixed $username */
    private $username;

    /** @var mixed $password */
    private $password;

    /** @var mixed $dbConnection */
    private $dbConnection;

    public function __construct()
    {
        $this->host     = "127.0.0.1";
        $this->db       = "final_project_movie";
        $this->username = "root";
        $this->password = "1234";
    }

    /**
     * @throws \Exception
     * @return void
     */
    public function connect()
    {
        $this->dbConnection = new mysqli($this->host, $this->username, $this->password,$this->db);

        if ($this->dbConnection->connect_error) {
            $this->exceptionHandler("Connection failed: " . $this->dbConnection->connect_error);
        }
    }

    /**
     * @param string $query
     */
    public function execQuery($query)
    {
        return $this->dbConnection->query($query);
    }

    /**
     * @param string $message
     * @throws \Exception
     * @return void
     */
    private function exceptionHandler(string $message)
    {
        throw new \Exception($message);
    }
}