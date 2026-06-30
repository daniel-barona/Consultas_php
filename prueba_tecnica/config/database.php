<?php
/**
 * Configuración de base de datos PostgreSQL
 * Database: phs_tecnica
 */

class Database {
    private static $instance = null;
    private $conn;
    
    // Configuración de la base de datos
    private $host = 'localhost';
    private $port = '5432';
    private $database = 'phs_tecnica';
    private $username = '';
    private $password = ''; // CAMBIAR por tu contraseña real
    
    private function __construct() {
        try {
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->database}";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn->exec("SET NAMES 'UTF8'");
        } catch(PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
}
?>
