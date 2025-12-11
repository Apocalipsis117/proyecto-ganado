<?php
class Vacunas
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Crear nueva vacuna
    public function crear($nombre, $tipo, $fecha, $ganado_id, $clase_vacuna_id, $fecha_vacunacion, $imagen)
    {
        $sql = "INSERT INTO vacunas (nombre, tipo, fecha, ganado_id, clase_vacuna_id, fecha_vacunacion, imagen)
                VALUES (:nombre, :tipo, :fecha, :ganado_id, :clase_vacuna_id, :fecha_vacunacion, :imagen)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nombre'            => $nombre,
            ':tipo'              => $tipo,
            ':fecha'             => $fecha ?: null,
            ':ganado_id'         => $ganado_id ?: null,
            ':clase_vacuna_id'   => $clase_vacuna_id ?: null,
            ':fecha_vacunacion'  => $fecha_vacunacion ?: null,
            ':imagen'            => $imagen
        ]);
    }

    // Obtener una vacuna por ID
    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM vacunas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Obtener todas las vacunas (con nombre de ganado y clase si existen)
    public function obtenerTodas()
    {
        $sql = "SELECT 
                    v.*, 
                    g.nombre AS ganado_nombre,
                    c.nombre AS clase_nombre
                FROM vacunas v
                LEFT JOIN ganado g ON v.ganado_id = g.id
                LEFT JOIN clases_vacunas c ON v.clase_vacuna_id = c.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Actualizar vacuna
    public function actualizar($id, $nombre, $tipo, $fecha, $ganado_id, $clase_vacuna_id, $fecha_vacunacion, $imagen)
    {
        $sql = "UPDATE vacunas SET
                    nombre = :nombre,
                    tipo = :tipo,
                    fecha = :fecha,
                    ganado_id = :ganado_id,
                    clase_vacuna_id = :clase_vacuna_id,
                    fecha_vacunacion = :fecha_vacunacion,
                    imagen = :imagen
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id'                => $id,
            ':nombre'            => $nombre,
            ':tipo'              => $tipo,
            ':fecha'             => $fecha ?: null,
            ':ganado_id'         => $ganado_id ?: null,
            ':clase_vacuna_id'   => $clase_vacuna_id ?: null,
            ':fecha_vacunacion'  => $fecha_vacunacion ?: null,
            ':imagen'            => $imagen
        ]);
    }

    // Eliminar vacuna por ID
    public function eliminar($id)
    {
        $sql = "DELETE FROM vacunas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Para selects: ganado existente
    public function obtenerGanados()
    {
        $sql = "SELECT id, nombre FROM ganado";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    // Para selects: clases de vacuna
    public function obtenerClasesVacunas()
    {
        $sql = "SELECT id, nombre FROM clases_vacunas";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
?>