<?php
class ContactoModel
{
    private $db;
    public function __construct($conexion)
    {
        $this->db = $conexion;
    }
    public function guardarContacto($nombre, $email, $comentario)
    {
        try {
            $sql = "INSERT INTO contactos
                    (nombre, email, comentario)
                    VALUES (:nombre, :email, :comentario)";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':nombre' => $nombre,
                ':email' => $email,
                ':comentario' => $comentario
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }
}