<?php

include_once 'DatabaseConnection.php';

/**
 * Implementació de la clase DatabaseConnection segons el model Procedimental.
 *
 * @author Pep
 */
class DatabaseProc extends DatabaseConnection {

    public function __construct($servername, $username, $password, $database) {
        parent::__construct($servername, $username, $password);
    }

//put your code here
    public function connect(): void {
        $this->connection = mysqli_connect($this->servername, $this->username, $this->password);
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
            $this->connection = null;
        }
    }

    private function getLastId(): int {
        return 1;
    }

    public function insert($modalitat, $nivell, $intents): int {
        $sql = "INSERT INTO estdistiques (modalitat, nivell, intents) VALUES ('$modalitat', $nivell, $intents)";
        if ($this->connection != null) {
            if (mysqli_query($this->connection, $sql)) {
                return mysqli_insert_id($this->connection);
            } else {
                return -1;
            }
        }
    }

    public function selectAll() {
        $sql = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques";
        $result = null;
        if ($this->connection != null) {
            $result = mysqli_query($this->connection, $sql);
        }
        return $result;        
    }

}
