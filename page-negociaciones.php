<?php
require_once 'core/config.php';
require_once 'core/negociaciones.php';
require_once 'core/negociaciones-crud.php';
require_once 'core/auth.php';
?>
<div class="container py-4">
    <h2 class="mb-3">CRUD de Negociaciones</h2>
    <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <!-- FORMULARIO -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" autocomplete="off">
                <input type="hidden" name="action" value="<?= $editNegociacion ? 'update' : 'create' ?>">
                <?php if ($editNegociacion): ?>
                    <input type="hidden" name="negociacion_id" value="<?= $editNegociacion['id'] ?>">
                <?php endif; ?>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tipo de Negociación*</label>
                        <select name="tipo_negociacion_id" class="form-control" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($tiposNegociaciones as $t): ?>
                                <option value="<?= $t['id'] ?>" <?= (isset($editNegociacion['tipo_negociacion_id']) && $editNegociacion['tipo_negociacion_id'] == $t['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($t['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Usuario Principal*</label>
                        <select name="usuario_principal_id" class="form-control" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($usuarios as $u): ?>
                                <option value="<?= $u['id'] ?>" <?= (isset($editNegociacion['usuario_principal_id']) && $editNegociacion['usuario_principal_id'] == $u['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($u['nombre'] . ' ' . $u['apellidos']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Usuario Negociador*</label>
                        <select name="usuario_negociador_id" class="form-control" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($usuarios as $u): ?>
                                <option value="<?= $u['id'] ?>" <?= (isset($editNegociacion['usuario_negociador_id']) && $editNegociacion['usuario_negociador_id'] == $u['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($u['nombre'] . ' ' . $u['apellidos']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row g-2 mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary w-100">
                            <?= $editNegociacion ? 'Actualizar' : 'Agregar' ?>
                        </button>
                        <?php if ($editNegociacion): ?>
                            <a href="index.php?view=negociaciones" class="btn btn-secondary ms-2">Cancelar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLA de Negociaciones -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Tipo de Negociación</th>
                    <th>Usuario Principal</th>
                    <th>Usuario Negociador</th>
                    <th style="width: 140px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($negociaciones as $n): ?>
                <tr>
                    <td><?= $n['id'] ?></td>
                    <td><?= htmlspecialchars($n['tipo_negociacion_nombre']) ?></td>
                    <td><?= htmlspecialchars($n['usuario_principal_nombre'] . ' ' . $n['usuario_principal_apellidos']) ?></td>
                    <td><?= htmlspecialchars($n['usuario_negociador_nombre'] . ' ' . $n['usuario_negociador_apellidos']) ?></td>
                    <td>
                        <a class="btn btn-sm btn-info" href="index.php?view=negociaciones&edit=<?= $n['id'] ?>">Editar</a>
                        <form method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar esta negociación?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="negociacion_id" value="<?= $n['id'] ?>">
                            <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>