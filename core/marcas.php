<?php
// Clase: Marcas

class Marcas
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Crear nueva marca
    public function crear($ganado_id, $imagen)
    {
        $nombreImagen = null;
        if (isset($imagen['tmp_name']) && !empty($imagen['name'])) {
            // Define el directorio donde se guardará la imagen
            $directorioUploads = 'uploads/';
            // Verificar si el directorio 'uploads/' existe; si no, crearlo
            if (!file_exists($directorioUploads)) {
                mkdir($directorioUploads, 0777, true); // 0777 para permisos completos
            }

            // Guardar la imagen en el directorio
            $nombreImagen = $directorioUploads . basename($imagen['name']);
            if (!move_uploaded_file($imagen['tmp_name'], $nombreImagen)) {
                $this->logError('Error al mover el archivo al directorio de uploads.');
                return false;
            }
        }

        $sql = "INSERT INTO marca (ganado_id, imagen) VALUES (:ganado_id, :imagen)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':ganado_id' => $ganado_id,
            ':imagen' => $nombreImagen
        ]);
    }

    // Obtener marca por ID
    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM marca WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Obtener todas las marcas
    public function obtenerTodas()
    {
        $sql = "SELECT
                    m.id as marca_id,
                    m.imagen AS imagen_marca,
                    g.nombre AS ganado_nombre,
                    g.id AS ganado_id,
                    g.raza,
                    g.color
                FROM marca m
                JOIN ganado g ON m.ganado_id = g.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Actualizar marca
    public function actualizar($id, $ganado_id, $imagen)
    {
        $nombreImagen = null;
        if (!empty($imagen['tmp_name']) && !empty($imagen['name'])) {
            $nombreImagen = 'uploads/' . basename($imagen['name']);
            move_uploaded_file($imagen['tmp_name'], $nombreImagen);
        }

        $sql = "UPDATE marca SET 
                    ganado_id = :ganado_id,
                    imagen = COALESCE(:imagen, imagen)
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':ganado_id' => $ganado_id,
            ':imagen' => $nombreImagen
        ]);
    }

    // Eliminar marca
    public function eliminar($id)
    {
        $sql = "DELETE FROM marca WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Obtener ganados disponibles
    public function obtenerGanados()
    {
        $sql = "SELECT id, nombre FROM ganado";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
?>