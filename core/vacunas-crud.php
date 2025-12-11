<?php
$vacunasModel = new Vacunas($pdo);

$action = $_POST['action'] ?? '';
$error = '';
$success = '';

// CREAR
if ($action === 'create') {
    $data = [
        'nombre'            => trim($_POST['nombre'] ?? ''),
        'tipo'              => trim($_POST['tipo'] ?? ''),
        'fecha'             => trim($_POST['fecha'] ?? ''),
        'ganado_id'         => trim($_POST['ganado_id'] ?? ''),
        'clase_vacuna_id'   => trim($_POST['clase_vacuna_id'] ?? ''),
        'fecha_vacunacion'  => trim($_POST['fecha_vacunacion'] ?? ''),
        'imagen'            => trim($_POST['imagen'] ?? ''),
    ];
    if ($data['nombre'] && $data['ganado_id']) {
        $ok = $vacunasModel->crear(
            $data['nombre'],
            $data['tipo'],
            $data['fecha'],
            $data['ganado_id'],
            $data['clase_vacuna_id'],
            $data['fecha_vacunacion'],
            $data['imagen']
        );
        if ($ok) $success = '¡Vacuna creada!';
        else $error = 'No se pudo crear la vacuna.';
    } else {
        $error = 'Por favor completa los campos obligatorios: Nombre y Ganado.';
    }
}

// ACTUALIZAR
if ($action === 'update') {
    $id = intval($_POST['vacuna_id'] ?? 0);
    $data = [
        'nombre'            => trim($_POST['nombre'] ?? ''),
        'tipo'              => trim($_POST['tipo'] ?? ''),
        'fecha'             => trim($_POST['fecha'] ?? ''),
        'ganado_id'         => trim($_POST['ganado_id'] ?? ''),
        'clase_vacuna_id'   => trim($_POST['clase_vacuna_id'] ?? ''),
        'fecha_vacunacion'  => trim($_POST['fecha_vacunacion'] ?? ''),
        'imagen'            => trim($_POST['imagen'] ?? ''),
    ];
    if ($id > 0 && $data['nombre'] && $data['ganado_id']) {
        $ok = $vacunasModel->actualizar(
            $id,
            $data['nombre'],
            $data['tipo'],
            $data['fecha'],
            $data['ganado_id'],
            $data['clase_vacuna_id'],
            $data['fecha_vacunacion'],
            $data['imagen']
        );
        if ($ok) $success = '¡Vacuna actualizada!';
        else $error = 'No se pudo actualizar la vacuna.';
    } else {
        $error = 'Por favor completa los campos obligatorios: Nombre y Ganado.';
    }
}

// ELIMINAR
if ($action === 'delete') {
    $id = intval($_POST['vacuna_id'] ?? 0);
    if ($id > 0) {
        $ok = $vacunasModel->eliminar($id);
        if ($ok) $success = '¡Vacuna eliminada!';
        else $error = 'No se pudo eliminar la vacuna.';
    }
}

// Listar para tabla y selects
$vacunas = $vacunasModel->obtenerTodas();
$ganados = $vacunasModel->obtenerGanados();
$clases = $vacunasModel->obtenerClasesVacunas();

// Para editar:
$editId = intval($_GET['edit'] ?? 0);
$editVacuna = $editId ? $vacunasModel->obtenerPorId($editId) : null;
?>