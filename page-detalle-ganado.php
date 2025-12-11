<?php
require_once 'core/config.php';
require_once 'core/ganado.php';

$ganadoModel = new Ganado($pdo);
$id = intval($_GET['id'] ?? 0);
$ganado = $ganadoModel->obtenerPorId($id);

if (!$ganado) {
    echo '<div class="alert alert-danger my-4">No se encontró el registro de ganado solicitado.</div>';
    echo '<a href="javascript:history.back()" class="btn btn-secondary">Volver</a>';
    exit;
}

// Obtener nombre estado y usuario
$estadoNombre = '';
$usuarioNombre = '';
if ($ganado['estado_id']) {
    foreach ($ganadoModel->obtenerEstados() as $estado) {
        if ($estado['id'] == $ganado['estado_id']) {
            $estadoNombre = $estado['nombre'];
            break;
        }
    }
}
if ($ganado['usuario_id']) {
    foreach ($ganadoModel->obtenerUsuarios() as $usuario) {
        if ($usuario['id'] == $ganado['usuario_id']) {
            $usuarioNombre = $usuario['nombre'];
            // Si tiene apellido
            if (isset($usuario['apellidos'])) $usuarioNombre .= ' ' . $usuario['apellidos'];
            break;
        }
    }
}
?>
<div class="container py-5">
    <h2 class="mb-4">Detalle de Ganado</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($ganado['nombre']) ?></dd>

                <dt class="col-sm-3">Fecha de Nacimiento</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($ganado['fecha_nacimiento']) ?></dd>

                <dt class="col-sm-3">Raza</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($ganado['raza']) ?></dd>

                <dt class="col-sm-3">Edad</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($ganado['edad']) ?> años</dd>

                <dt class="col-sm-3">Peso</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($ganado['peso']) ?> kg</dd>

                <dt class="col-sm-3">Estado</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($estadoNombre) ?></dd>

                <dt class="col-sm-3">Color</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($ganado['color']) ?></dd>

                <dt class="col-sm-3">Sexo</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($ganado['sexo']) ?></dd>

                <dt class="col-sm-3">Fecha de Monta</dt>
                <dd class="col-sm-9"><?php echo $ganado['fecha_monta'] ?></dd>

                <dt class="col-sm-3">Propietario</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($usuarioNombre) ?></dd>

                <dt class="col-sm-3">Nota</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($ganado['nota']) ?></dd>
            </dl>
            <div class="mt-4 d-flex">
                <a class="btn btn-info me-2" href="index.php?view=ganado&edit=<?= $ganado['id'] ?>">Editar</a>
                <a class="btn btn-secondary" href="javascript:history.back()">Volver</a>
            </div>
        </div>
    </div>
</div>