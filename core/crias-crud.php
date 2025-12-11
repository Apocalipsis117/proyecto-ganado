<?php
$criasModel = new Crias($pdo);

$action = $_POST['action'] ?? '';
$error = '';
$success = '';

// CREAR
if ($action === 'create') {
    $data = [
        'ganado_cria_id' => trim($_POST['ganado_cria_id'] ?? ''),
        'ganado_mama_id' => trim($_POST['ganado_mama_id'] ?? ''),
        'ganado_papa_id' => trim($_POST['ganado_papa_id'] ?? ''),
    ];
    if ($data['ganado_cria_id']) {
        $ok = $criasModel->crear(
            $data['ganado_cria_id'],
            $data['ganado_mama_id'],
            $data['ganado_papa_id']
        );
        if ($ok) $success = '¡Cría creada!';
        else $error = 'No se pudo crear la cría.';
    } else {
        $error = 'Seleccione la cría.';
    }
}

// ACTUALIZAR
if ($action === 'update') {
    $id = intval($_POST['cria_id'] ?? 0);
    $data = [
        'ganado_cria_id' => trim($_POST['ganado_cria_id'] ?? ''),
        'ganado_mama_id' => trim($_POST['ganado_mama_id'] ?? ''),
        'ganado_papa_id' => trim($_POST['ganado_papa_id'] ?? ''),
    ];
    if ($id > 0 && $data['ganado_cria_id']) {
        $ok = $criasModel->actualizar(
            $id,
            $data['ganado_cria_id'],
            $data['ganado_mama_id'],
            $data['ganado_papa_id']
        );
        if ($ok) $success = '¡Cría actualizada!';
        else $error = 'No se pudo actualizar la cría.';
    } else {
        $error = 'Seleccione la cría.';
    }
}

// ELIMINAR
if ($action === 'delete') {
    $id = intval($_POST['cria_id'] ?? 0);
    if ($id > 0) {
        $ok = $criasModel->eliminar($id);
        if ($ok) $success = '¡Cría eliminada!';
        else $error = 'No se pudo eliminar la cría.';
    }
}

// Listar para tabla y selects
$crias = $criasModel->obtenerTodas();
$ganados = $criasModel->obtenerGanados();

// Para editar:
$editId = intval($_GET['edit'] ?? 0);
$editCria = $editId ? $criasModel->obtenerPorId($editId) : null;
?>