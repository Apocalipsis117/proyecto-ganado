<?php
$userModel = new Usuario($pdo);

// HANDLERS: Crear, Actualizar, Eliminar
$action = $_POST['action'] ?? '';
$error = '';
$success = '';

// CREAR
if ($action === 'create') {
    $data = [
        'first_name' => trim($_POST['first_name'] ?? ''),
        'last_name' => trim($_POST['last_name'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'password' => trim($_POST['password'] ?? ''),
        'role' => trim($_POST['role'] ?? ''),
        'id_number' => trim($_POST['id_number'] ?? ''),
        'address' => trim($_POST['address'] ?? ''),
        'phone' => trim($_POST['phone'] ?? ''),
        'department' => trim($_POST['department'] ?? ''),
        'city' => trim($_POST['city'] ?? ''),
        'country' => trim($_POST['country'] ?? ''),
    ];
    if ($data['first_name'] && $data['last_name'] && $data['email'] && $data['password']) {
        $ok = $userModel->crear(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['role'],
            $data['id_number'],
            $data['address'],
            $data['phone'],
            $data['department'],
            $data['city'],
            $data['country']
        );
        if ($ok) $success = '¡Usuario creado!';
        else $error = 'No se pudo crear el usuario.';
    } else {
        $error = 'Por favor completa los campos obligatorios.';
    }
}

// ACTUALIZAR
if ($action === 'update') {
    $id = intval($_POST['user_id'] ?? 0);
    $data = [
        'first_name' => trim($_POST['first_name'] ?? ''),
        'last_name' => trim($_POST['last_name'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'password' => trim($_POST['password'] ?? ''),
        'role' => trim($_POST['role'] ?? ''),
        'id_number' => trim($_POST['id_number'] ?? ''),
        'address' => trim($_POST['address'] ?? ''),
        'phone' => trim($_POST['phone'] ?? ''),
        'department' => trim($_POST['department'] ?? ''),
        'city' => trim($_POST['city'] ?? ''),
        'country' => trim($_POST['country'] ?? ''),
    ];
    if ($id > 0 && $data['first_name'] && $data['last_name'] && $data['email'] && $data['password']) {
        $ok = $userModel->actualizar(
            $id,
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['role'],
            $data['id_number'],
            $data['address'],
            $data['phone'],
            $data['department'],
            $data['city'],
            $data['country']
        );
        if ($ok) $success = '¡Usuario actualizado!';
        else $error = 'No se pudo actualizar el usuario.';
    } else {
        $error = 'Por favor completa los campos obligatorios.';
    }
}

// ELIMINAR
if ($action === 'delete') {
    $id = intval($_POST['user_id'] ?? 0);
    if ($id > 0) {
        $ok = $userModel->eliminar($id);
        if ($ok) $success = '¡Usuario eliminado!';
        else $error = 'No se pudo eliminar el usuario.';
    }
}

// Seleccionar usuarios siempre
$users = $userModel->obtenerTodos();

// Editar usuario
$editId = intval($_GET['edit'] ?? 0);
$editUser = $editId ? $userModel->obtenerPorId($editId) : null;
