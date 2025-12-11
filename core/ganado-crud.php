<?php
$ganadoModel = new Ganado($pdo);

// HANDLERS: Crear, Actualizar, Eliminar
$action = $_POST['action'] ?? '';
$error = '';
$success = '';

// CREAR
if ($action === 'create') {
    $data = [
        'nombre'           => trim($_POST['nombre'] ?? ''),
        'fecha_nacimiento' => trim($_POST['fecha_nacimiento'] ?? ''),
        'raza'             => trim($_POST['raza'] ?? ''),
        'edad'             => trim($_POST['edad'] ?? ''),
        'peso'             => trim($_POST['peso'] ?? ''),
        'estado_id'        => trim($_POST['estado_id'] ?? ''),
        'usuario_id'       => trim($_POST['usuario_id'] ?? ''),
        'color'            => trim($_POST['color'] ?? ''),
        'sexo'             => trim($_POST['sexo'] ?? ''),
        'fecha_monta'      => trim($_POST['fecha_monta'] ?? ''),
        'nota'             => trim($_POST['nota'] ?? ''),
    ];
    if ($data['nombre']) {
        $ok = $ganadoModel->crear(
            $data['nombre'],
            $data['fecha_nacimiento'],
            $data['raza'],
            $data['edad'],
            $data['peso'],
            $data['estado_id'],
            $data['usuario_id'],
            $data['color'],
            $data['sexo'],
            $data['fecha_monta'],
            $data['nota']
        );
        if ($ok) $success = '¡Registro de ganado creado!';
        else $error = 'No se pudo crear el registro.';
    } else {
        $error = 'Por favor completa al menos el campo Nombre.';
    }
}

// ACTUALIZAR
if ($action === 'update') {
    $id = intval($_POST['ganado_id'] ?? 0);
    $data = [
        'nombre'           => trim($_POST['nombre'] ?? ''),
        'fecha_nacimiento' => trim($_POST['fecha_nacimiento'] ?? ''),
        'raza'             => trim($_POST['raza'] ?? ''),
        'edad'             => trim($_POST['edad'] ?? ''),
        'peso'             => trim($_POST['peso'] ?? ''),
        'estado_id'        => trim($_POST['estado_id'] ?? ''),
        'usuario_id'       => trim($_POST['usuario_id'] ?? ''),
        'color'            => trim($_POST['color'] ?? ''),
        'sexo'             => trim($_POST['sexo'] ?? ''),
        'fecha_monta'      => trim($_POST['fecha_monta'] ?? ''),
        'nota'             => trim($_POST['nota'] ?? ''),
    ];
    if ($id > 0 && $data['nombre']) {
        $ok = $ganadoModel->actualizar(
            $id,
            $data['nombre'],
            $data['fecha_nacimiento'],
            $data['raza'],
            $data['edad'],
            $data['peso'],
            $data['estado_id'],
            $data['usuario_id'],
            $data['color'],
            $data['sexo'],
            $data['fecha_monta'],
            $data['nota']
        );
        if ($ok) $success = '¡Registro de ganado actualizado!';
        else $error = 'No se pudo actualizar el registro.';
    } else {
        $error = 'Por favor completa al menos el campo Nombre.';
    }
}

// ELIMINAR
if ($action === 'delete') {
    $id = intval($_POST['ganado_id'] ?? 0);
    if ($id > 0) {
        $ok = $ganadoModel->eliminar($id);
        if ($ok) $success = '¡Registro de ganado eliminado!';
        else $error = 'No se pudo eliminar el registro.';
    }
}

// Seleccionar registros de ganado siempre (para la tabla)
$ganados = $ganadoModel->obtenerTodos();

// Para los selects de usuarios y estados
$usuarios = $ganadoModel->obtenerUsuarios();
$estados = $ganadoModel->obtenerEstados();

// Editar registro de ganado
$editId = intval($_GET['edit'] ?? 0);
$editGanado = $editId ? $ganadoModel->obtenerPorId($editId) : null;