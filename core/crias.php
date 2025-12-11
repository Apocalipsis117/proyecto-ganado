<?php
class Crias
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Crear nueva cría
    public function crear($ganado_cria_id, $ganado_mama_id, $ganado_papa_id)
    {
        $sql = "INSERT INTO crias (ganado_cria_id, ganado_mama_id, ganado_papa_id)
                VALUES (:ganado_cria_id, :ganado_mama_id, :ganado_papa_id)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':ganado_cria_id' => $ganado_cria_id ?: null,
            ':ganado_mama_id' => $ganado_mama_id ?: null,
            ':ganado_papa_id' => $ganado_papa_id ?: null
        ]);
    }

    // Obtener cría por ID
    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM crias WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Obtener todas las crías, con nombres de ganado relacionados
    public function obtenerTodas()
    {
        $sql = "SELECT 
                    c.*,
                    gcria.nombre as cria_nombre,
                    gmama.nombre as mama_nombre,
                    gpapa.nombre as papa_nombre
                FROM crias c
                LEFT JOIN ganado gcria ON c.ganado_cria_id = gcria.id
                LEFT JOIN ganado gmama ON c.ganado_mama_id = gmama.id
                LEFT JOIN ganado gpapa ON c.ganado_papa_id = gpapa.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Actualizar cría
    public function actualizar($id, $ganado_cria_id, $ganado_mama_id, $ganado_papa_id)
    {
        $sql = "UPDATE crias SET
                    ganado_cria_id = :ganado_cria_id,
                    ganado_mama_id = :ganado_mama_id,
                    ganado_papa_id = :ganado_papa_id
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':ganado_cria_id' => $ganado_cria_id ?: null,
            ':ganado_mama_id' => $ganado_mama_id ?: null,
            ':ganado_papa_id' => $ganado_papa_id ?: null
        ]);
    }

    // Eliminar cría
    public function eliminar($id)
    {
        $sql = "DELETE FROM crias WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Ganados disponibles para selects
    public function obtenerGanados()
    {
        $sql = "SELECT id, nombre FROM ganado";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
?>