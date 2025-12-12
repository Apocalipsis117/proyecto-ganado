<?php

class Negociaciones
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Crear nueva negociación
    public function crear($tipo_negociacion_id, $usuario_principal_id, $usuario_negociador_id)
    {
        $sql = "INSERT INTO negociaciones (tipo_necociacion_id, usuario_principal_id, usuario_negociador_id)
                VALUES (:tipo_negociacion_id, :usuario_principal_id, :usuario_negociador_id)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':tipo_negociacion_id' => $tipo_negociacion_id,
            ':usuario_principal_id' => $usuario_principal_id,
            ':usuario_negociador_id' => $usuario_negociador_id
        ]);
    }

    // Obtener negociación por ID
    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM negociaciones WHERE tipo_necociacion_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Obtener todas las negociaciones
    public function obtenerTodas()
    {
        $sql = "SELECT 
                    n.*,
                    tn.nombre AS tipo_negociacion_nombre,
                    up.nombre AS usuario_principal_nombre,
                    up.apellidos AS usuario_principal_apellidos,
                    un.nombre AS usuario_negociador_nombre,
                    un.apellidos AS usuario_negociador_apellidos
                FROM negociaciones n
                JOIN tipo_negocio tn ON n.tipo_necociacion_id = tn.id
                JOIN usuarios up ON n.usuario_principal_id = up.id
                JOIN usuarios un ON n.usuario_negociador_id = un.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Actualizar negociación
    public function actualizar($id, $tipo_negociacion_id, $usuario_principal_id, $usuario_negociador_id)
    {
        $sql = "UPDATE negociaciones SET
                    tipo_necociacion_id = :tipo_negociacion_id,
                    usuario_principal_id = :usuario_principal_id,
                    usuario_negociador_id = :usuario_negociador_id
                WHERE tipo_necociacion_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':tipo_negociacion_id' => $tipo_negociacion_id,
            ':usuario_principal_id' => $usuario_principal_id,
            ':usuario_negociador_id' => $usuario_negociador_id
        ]);
    }

    // Eliminar negociación
    public function eliminar($id)
    {
        $sql = "DELETE FROM negociaciones WHERE tipo_necociacion_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Obtener tipos de negociaciones
    public function obtenerTiposNegociaciones()
    {
        $sql = "SELECT id, nombre FROM tipo_negocio";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Obtener usuarios
    public function obtenerUsuarios()
    {
        $sql = "SELECT id, nombre, apellidos FROM usuarios";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
?>