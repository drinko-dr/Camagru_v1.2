<?php
class Database
{
    private $_server = 'mysql:host=127.0.0.1;dbname=camagru';
    private $_user = 'root';
    private $_password = 'root';

    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    protected $con;

    public function openConnection()
    {
        try {
            $this->con = new PDO($this->_server, $this->_user, $this->_password, $this->options);
            return $this->con;
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    public function closeConnection()
    {
        $this->con = null;
    }
}