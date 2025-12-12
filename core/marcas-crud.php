<?php
// Archivo CRUD: marcas-crud.php

$marcasModel = new Marcas($pdo);

$action = $_POST['action'] ?? '';
$error = '';
$success = '';

// CREAR
if ($action === 'create') {
    $data = [
        'ganado_id' => trim($_POST['ganado_id'] ?? ''),
        'imagen' => $_FILES['imagen'] ?? null
    ];
    if ($data['ganado_id'] && $data['imagen']) {
        $ok = $marcasModel->crear($data['ganado_id'], $data['imagen']);
        if ($ok) $success = '¡Marca creada!';
        else $error = 'No se pudo crear la marca.';
    } else {
        $error = 'Complete todos los campos requeridos.';
    }
}

// ACTUALIZAR
if ($action === 'update') {
    $id = intval($_POST['marca_id'] ?? 0);
    $data = [
        'ganado_id' => trim($_POST['ganado_id'] ?? ''),
        'imagen' => $_FILES['imagen'] ?? null
    ];
    if ($id > 0 && $data['ganado_id']) {
        $ok = $marcasModel->actualizar($id, $data['ganado_id'], $data['imagen']);
        if ($ok) $success = '¡Marca actualizada!';
        else $error = 'No se pudo actualizar la marca.';
    } else {
        $error = 'Complete todos los campos requeridos.';
    }
}

// ELIMINAR
if ($action === 'delete') {
    $id = intval($_POST['marca_id'] ?? 0);
    if ($id > 0) {
        $ok = $marcasModel->eliminar($id);
        if ($ok) $success = '¡Marca eliminada!';
        else $error = 'No se pudo eliminar la marca.';
    }
}

// Listar para tabla y selects
$marcas = $marcasModel->obtenerTodas();
$ganados = $marcasModel->obtenerGanados();

// Para editar:
$editId = intval($_GET['edit'] ?? 0);
$editMarca = $editId ? $marcasModel->obtenerPorId($editId) : null;
?>