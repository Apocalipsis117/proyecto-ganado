<?php
class Ganado
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Crear nuevo registro de ganado
    public function crear($nombre, $fecha_nacimiento, $raza, $edad, $peso, $estado_id, $usuario_id, $color, $sexo, $fecha_monta, $nota)
    {
        $sql = "INSERT INTO ganado (nombre, fecha_nacimiento, raza, edad, peso, estado_id, usuario_id, color, sexo, fecha_monta, nota)
                VALUES (:nombre, :fecha_nacimiento, :raza, :edad, :peso, :estado_id, :usuario_id, :color, :sexo, :fecha_monta, :nota)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nombre'           => $nombre,
            ':fecha_nacimiento' => $fecha_nacimiento ?: null,
            ':raza'             => $raza,
            ':edad'             => $edad,
            ':peso'             => $peso,
            ':estado_id'        => $estado_id ?: null,
            ':usuario_id'       => $usuario_id ?: null,
            ':color'            => $color,
            ':sexo'             => $sexo,
            ':fecha_monta'      => $fecha_monta ?: null, // <--- este es el fix
            ':nota'             => $nota
        ]);
    }

    // Obtener un registro por ID
    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM ganado WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Obtener todos los registros de ganado, con nombre del estado y usuario
    public function obtenerTodos()
    {
        $sql = "SELECT 
                    g.*, 
                    e.nombre AS estado_nombre, 
                    CONCAT(u.nombre, ' ', u.apellidos) AS usuario_nombre 
                FROM ganado g 
                LEFT JOIN estados e ON g.estado_id = e.id 
                LEFT JOIN usuarios u ON g.usuario_id = u.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Actualizar un registro de ganado
    public function actualizar($id, $nombre, $fecha_nacimiento, $raza, $edad, $peso, $estado_id, $usuario_id, $color, $sexo, $fecha_monta, $nota)
    {
        $sql = "UPDATE ganado SET 
                    nombre = :nombre,
                    fecha_nacimiento = :fecha_nacimiento,
                    raza = :raza,
                    edad = :edad,
                    peso = :peso,
                    estado_id = :estado_id,
                    usuario_id = :usuario_id,
                    color = :color,
                    sexo = :sexo,
                    fecha_monta = :fecha_monta,
                    nota = :nota
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id'               => $id,
            ':nombre'           => $nombre,
            ':fecha_nacimiento' => $fecha_nacimiento ?: null,
            ':raza'             => $raza,
            ':edad'             => $edad,
            ':peso'             => $peso,
            ':estado_id'        => $estado_id ?: null,
            ':usuario_id'       => $usuario_id ?: null,
            ':color'            => $color,
            ':sexo'             => $sexo,
            ':fecha_monta'      => $fecha_monta ?: null, // <--- este es el fix
            ':nota'             => $nota
        ]);
    }

    // Eliminar un registro por ID
    public function eliminar($id)
    {
        $sql = "DELETE FROM ganado WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Traer todos los usuarios (para el select)
    public function obtenerUsuarios()
    {
        $sql = "SELECT id, nombre, apellidos FROM usuarios";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Traer todos los estados (para el select)
    public function obtenerEstados()
    {
        $sql = "SELECT id, nombre FROM estados";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
?>