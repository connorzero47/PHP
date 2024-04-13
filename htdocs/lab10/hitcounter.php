<?php
class HitCounter {
    private $conn;
    private $table;

    public function __construct($host, $user, $pswd, $dbnm, $tablename) {
        $this->conn = new mysqli($host, $user, $pswd, $dbnm);
        $this->table = $tablename;

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getHits() {
        $query = "SELECT hits FROM {$this->table} WHERE id=1";
        $result = $this->conn->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row["hits"];
        }

        return 0;
    }

    public function setHits() {
        $query = "UPDATE {$this->table} SET hits = hits + 1 WHERE id=1";
        $this->conn->query($query);
    }
	
	public function startOver() {
        $query = "UPDATE {$this->table} SET hits = 0 WHERE id=1";
        $this->conn->query($query);
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
