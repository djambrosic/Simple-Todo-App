<?php

class Database{
    /**
     * @var bool
     */
    public $isConn;
    /**
     * @var PDO
     */
    protected $db;

    /**
     * Database constructor.
     * @param string $username
     * @param string $password
     * @param string $host
     * @param string $dbname
     * @param array $options
     * @throws Exception
     */
    public function __construct($username = DB['username'], $password = DB['password'], $host = DB['hostname'], $dbname = DB['dbname'], $options = DB['options']){
        $this->isConn = TRUE;
        try {
            $this->db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Disconnect from DB
     */
    public function disconnect()
    {
        $this->isConn = false;
        $this->db = false;
    }

    /**
     * Select single record from DB
     * @param string $query
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function selectRow($query, $params = []){
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Select multiple records from DB
     * @param string $query
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function selectRows($query, $params = []){
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Insert record into DB
     * @param string $query
     * @param array $params
     * @param bool $retId
     * @return int|bool
     * @throws Exception
     */
    public function insertRow($query, $params = [], $retId = false){
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            $lastInsertedId = $this->db->lastInsertId();
            $this->db->commit();
            if($retId) return $lastInsertedId;
            return TRUE;
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Update record in DB
     * @param string $query
     * @param array $params
     * @throws Exception
     */
    public function updateRow($query, $params = []){
        $this->insertRow($query, $params);
    }

    /**
     * Delete record in DB
     * @param string $query
     * @param array $params
     * @throws Exception
     */
    public function deleteRow($query, $params = []){
        $this->insertRow($query, $params);
    }
}