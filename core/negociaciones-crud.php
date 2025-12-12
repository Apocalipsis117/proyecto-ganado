<?php
$negociacionesModel = new Negociaciones($pdo);

$action = $_POST['action'] ?? '';
$error = '';
$success = '';

// CREAR
if ($action === 'create') {
    $data = [
        'tipo_negociacion_id' => trim($_POST['tipo_negociacion_id'] ?? ''),
        'usuario_principal_id' => trim($_POST['usuario_principal_id'] ?? ''),
        'usuario_negociador_id' => trim($_POST['usuario_negociador_id'] ?? ''),
    ];
    if ($data['tipo_negociacion_id'] && $data['usuario_principal_id'] && $data['usuario_negociador_id']) {
        $ok = $negociacionesModel->crear(
            $data['tipo_negociacion_id'],
            $data['usuario_principal_id'],
            $data['usuario_negociador_id']
        );
        if ($ok) $success = '¡Negociación creada!';
        else $error = 'No se pudo crear la negociación.';
    } else {
        $error = 'Complete todos los campos requeridos.';
    }
}

// ACTUALIZAR
if ($action === 'update') {
    $id = intval($_POST['negociacion_id'] ?? 0);
    $data = [
        'tipo_negociacion_id' => trim($_POST['tipo_negociacion_id'] ?? ''),
        'usuario_principal_id' => trim($_POST['usuario_principal_id'] ?? ''),
        'usuario_negociador_id' => trim($_POST['usuario_negociador_id'] ?? ''),
    ];
    if ($id > 0 && $data['tipo_negociacion_id'] && $data['usuario_principal_id']) {
        $ok = $negociacionesModel->actualizar(
            $id,
            $data['tipo_negociacion_id'],
            $data['usuario_principal_id'],
            $data['usuario_negociador_id']
        );
        if ($ok) $success = '¡Negociación actualizada!';
        else $error = 'No se pudo actualizar la negociación.';
    } else {
        $error = 'Complete todos los campos requeridos.';
    }
}

// ELIMINAR
if ($action === 'delete') {
    $id = intval($_POST['negociacion_id'] ?? 0);
    if ($id > 0) {
        $ok = $negociacionesModel->eliminar($id);
        if ($ok) $success = '¡Negociación eliminada!';
        else $error = 'No se pudo eliminar la negociación.';
    }
}

// Listar para tabla y selects
$negociaciones = $negociacionesModel->obtenerTodas();
$tiposNegociaciones = $negociacionesModel->obtenerTiposNegociaciones();
$usuarios = $negociacionesModel->obtenerUsuarios();

// Para editar:
$editId = intval($_GET['edit'] ?? 0);
$editNegociacion = $editId ? $negociacionesModel->obtenerPorId($editId) : null;
?>