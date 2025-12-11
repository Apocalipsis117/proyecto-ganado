<?php
// usuario.php
class Usuario
{
    private $pdo;

    // Constructor recibe la instancia PDO (desde config.php)
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Crear nuevo usuario
    public function crear($nombre, $apellidos, $correo, $contrasena, $cargo = null, $numIdentificacion = null, $direccion = null, $telefono = null, $departamento = null, $municipio = null, $pais = null)
    {
        $sql = "INSERT INTO usuarios (nombre, apellidos, correo, contrasena, cargo, numIdentificacion, direccion, telefono, departamento, municipio, pais)
                VALUES (:nombre, :apellidos, :correo, :contrasena, :cargo, :numIdentificacion, :direccion, :telefono, :departamento, :municipio, :pais)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nombre'           => $nombre,
            ':apellidos'        => $apellidos,
            ':correo'           => $correo,
            ':contrasena'       => $contrasena, // SIN ENCRIPTAR, solo texto plano
            ':cargo'            => $cargo,
            ':numIdentificacion'=> $numIdentificacion,
            ':direccion'        => $direccion,
            ':telefono'         => $telefono,
            ':departamento'     => $departamento,
            ':municipio'        => $municipio,
            ':pais'             => $pais
        ]);
    }

    // Leer un usuario por ID
    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Leer todos los usuarios
    public function obtenerTodos()
    {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Actualizar usuario
    public function actualizar($id, $nombre, $apellidos, $correo, $contrasena, $cargo = null, $numIdentificacion = null, $direccion = null, $telefono = null, $departamento = null, $municipio = null, $pais = null)
    {
        $sql = "UPDATE usuarios
                SET nombre = :nombre,
                    apellidos = :apellidos,
                    correo = :correo,
                    contrasena = :contrasena,
                    cargo = :cargo,
                    numIdentificacion = :numIdentificacion,
                    direccion = :direccion,
                    telefono = :telefono,
                    departamento = :departamento,
                    municipio = :municipio,
                    pais = :pais
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id'               => $id,
            ':nombre'           => $nombre,
            ':apellidos'        => $apellidos,
            ':correo'           => $correo,
            ':contrasena'       => $contrasena, // SIN ENCRIPTAR
            ':cargo'            => $cargo,
            ':numIdentificacion'=> $numIdentificacion,
            ':direccion'        => $direccion,
            ':telefono'         => $telefono,
            ':departamento'     => $departamento,
            ':municipio'        => $municipio,
            ':pais'             => $pais
        ]);
    }

    // Eliminar usuario por ID
    public function eliminar($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Buscar usuario por correo y contrasena (para login simple)
    public function buscarPorCorreoYContrasena($correo, $contrasena)
    {
        $sql = "SELECT * FROM usuarios WHERE correo = :correo AND contrasena = :contrasena";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':correo'       => $correo,
            ':contrasena'   => $contrasena
        ]);
        return $stmt->fetch();
    }
}
?>