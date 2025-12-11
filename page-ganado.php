<?php
require_once 'core/auth.php';
require_once 'core/config.php';
require_once 'core/ganado.php';
require_once 'core/ganado-crud.php';
?>
<div class="container py-4">
    <h2 class="mb-3">CRUD de Ganado</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <!-- FORMULARIO -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" autocomplete="off">
                <input type="hidden" name="action" value="<?= $editGanado ? 'update' : 'create' ?>">
                <?php if ($editGanado): ?>
                    <input type="hidden" name="ganado_id" value="<?= $editGanado['id'] ?>">
                <?php endif; ?>
                <div class="row g-2">
                    <div class="col-md-4">
                        <label class="form-label">Nombre*</label>
                        <input name="nombre" class="form-control" required
                            value="<?= htmlspecialchars($editGanado['nombre'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fecha de nacimiento</label>
                        <input name="fecha_nacimiento" type="date" class="form-control"
                            value="<?= htmlspecialchars($editGanado['fecha_nacimiento'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Raza</label>
                        <?php include 'components/input-raza.php' ?>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">Edad</label>
                        <input name="edad" type="number" min="0" class="form-control"
                            value="<?= htmlspecialchars($editGanado['edad'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Peso</label>
                        <input name="peso" type="number" step="0.01" min="0" class="form-control"
                            value="<?= htmlspecialchars($editGanado['peso'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Estado</label>
                        <select name="estado_id" class="form-control">
                            <option value="">Seleccione</option>
                            <?php foreach ($estados as $estado): ?>
                            <option value="<?= $estado['id'] ?>" <?= isset($editGanado['estado_id']) && $editGanado['estado_id'] == $estado['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($estado['nombre']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">Color</label>
                        <input name="color" class="form-control"
                            value="<?= htmlspecialchars($editGanado['color'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Sexo</label>
                        <select name="sexo" class="form-control">
                            <option value="">Seleccione</option>
                            <option value="Macho" <?= (isset($editGanado['sexo']) && $editGanado['sexo'] == 'Macho') ? 'selected' : '' ?>>Macho</option>
                            <option value="Hembra" <?= (isset($editGanado['sexo']) && $editGanado['sexo'] == 'Hembra') ? 'selected' : '' ?>>Hembra</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Usuario (propietario)</label>
                        <select name="usuario_id" class="form-control">
                            <option value="">Seleccione</option>
                            <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= $usuario['id'] ?>" <?= isset($editGanado['usuario_id']) && $editGanado['usuario_id'] == $usuario['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellidos']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">Fecha de monta</label>
                        <input name="fecha_monta" type="date" class="form-control"
                            value="<?= htmlspecialchars($editGanado['fecha_monta'] ?? '') ?>">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Nota</label>
                        <input name="nota" class="form-control"
                            value="<?= htmlspecialchars($editGanado['nota'] ?? '') ?>">
                    </div>
                </div>
                <div class="row g-2 mt-3">
                    <div class="col-md-12 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <?= $editGanado ? 'Actualizar' : 'Agregar' ?>
                        </button>
                        <?php if ($editGanado): ?>
                            <a href="index.php?params=ganado" class="btn btn-secondary ms-2">Cancelar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLA DE GANADO -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Fecha nacimiento</th>
                    <th>Raza</th>
                    <th>Edad</th>
                    <th>Peso</th>
                    <th>Estado</th>
                    <th>Color</th>
                    <th>Sexo</th>
                    <th>Usuario</th>
                    <th>Nota</th>
                    <th style="width: 140px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ganados as $g): ?>
                <tr>
                    <td><?= $g['id'] ?></td>
                    <td><?= htmlspecialchars($g['nombre']) ?></td>
                    <td><?= htmlspecialchars($g['fecha_nacimiento']) ?></td>
                    <td><?= htmlspecialchars($g['raza']) ?></td>
                    <td><?= htmlspecialchars($g['edad']) ?></td>
                    <td><?= htmlspecialchars($g['peso']) ?></td>
                    <td><?= htmlspecialchars($g['estado_nombre']) ?></td>
                    <td><?= htmlspecialchars($g['color']) ?></td>
                    <td><?= htmlspecialchars($g['sexo']) ?></td>
                    <td><?= htmlspecialchars($g['usuario_nombre']) ?></td>
                    <td><?= htmlspecialchars($g['nota']) ?></td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="index.php?params=detalle-ganado&id=<?= $g['id'] ?>">Ver</a>
                        <a class="btn btn-sm btn-info" href="index.php?params=ganado&edit=<?= $g['id'] ?>">Editar</a>
                        <form method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar este registro?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="ganado_id" value="<?= $g['id'] ?>">
                            <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>