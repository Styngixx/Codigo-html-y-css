<?php
class CConexion {

    public static function ConexionDB(){
    $host = "localhost";
    $port = "5432";
    $dbname = "3Atienda";
    $username = "postgres";
    $password = "261025";

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }

    return $conn;
    }

}

?>