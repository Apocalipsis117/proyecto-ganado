<?php
require_once 'core/config.php';
require_once 'core/vacunas.php';
require_once 'core/vacunas-crud.php';
?>
<div class="container py-4">
    <h2 class="mb-3">CRUD de Vacunas</h2>
    <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <!-- FORMULARIO -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" autocomplete="off">
                <input type="hidden" name="action" value="<?= $editVacuna ? 'update' : 'create' ?>">
                <?php if ($editVacuna): ?>
                    <input type="hidden" name="vacuna_id" value="<?= $editVacuna['id'] ?>">
                <?php endif; ?>
                <div class="row g-2">
                    <input type="hidden" name="fecha" value="<?= htmlspecialchars($editVacuna['fecha'] ?? date('Y-m-d')) ?>">
                    <input type="hidden" name="nombre" required value="lorem">
                    <input type="hidden" name="tipo" value="ipsum">
                    <div class="col-md-3">
                        <label class="form-label">Ganado*</label>
                        <select name="ganado_id" class="form-control" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($ganados as $g): ?>
                                <option value="<?= $g['id'] ?>" <?= (isset($editVacuna['ganado_id']) && $editVacuna['ganado_id'] == $g['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($g['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Clase Vacuna</label>
                        <select name="clase_vacuna_id" class="form-control">
                            <option value="">Seleccione</option>
                            <?php foreach ($clases as $c): ?>
                                <option value="<?= $c['id'] ?>" <?= (isset($editVacuna['clase_vacuna_id']) && $editVacuna['clase_vacuna_id'] == $c['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($c['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Fecha vacunación</label>
                        <input name="fecha_vacunacion" type="date" class="form-control" value="<?= htmlspecialchars($editVacuna['fecha_vacunacion'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Imagen (URL o nombre archivo)</label>
                        <input name="imagen" class="form-control" value="<?= htmlspecialchars($editVacuna['imagen'] ?? '') ?>">
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <?= $editVacuna ? 'Actualizar' : 'Agregar' ?>
                        </button>
                        <?php if ($editVacuna): ?>
                            <a href="index.php?params=vacunas" class="btn btn-secondary ms-2">Cancelar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- TABLA Vacunas -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <!-- <th>Nombre</th> -->
                    <!-- <th>Tipo</th> -->
                    <!-- <th>Fecha</th> -->
                    <th>Ganado</th>
                    <th>Clase Vacuna</th>
                    <th>Fecha vacunación</th>
                    <th>Imagen</th>
                    <th style="width: 140px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vacunas as $v): ?>
                <tr>
                    <td><?= $v['id'] ?></td>
                    <!-- <td><?= htmlspecialchars($v['nombre']) ?></td> -->
                    <!-- <td><?= htmlspecialchars($v['tipo']) ?></td> -->
                    <!-- <td><?= htmlspecialchars($v['fecha']) ?></td> -->
                    <td>
                        <a href="index.php?params=detalle-ganado&id=<?= $g['id'] ?>">
                            <?= htmlspecialchars($v['ganado_nombre']) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($v['clase_nombre']) ?></td>
                    <td><?= htmlspecialchars($v['fecha_vacunacion']) ?></td>
                    <td>
                        <?php if ($v['imagen']): ?>
                            <img src="<?= htmlspecialchars($v['imagen']) ?>" alt="Imagen" width="40" height="40">
                        <?php endif; ?>
                        <?= htmlspecialchars($v['imagen']) ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-info" href="index.php?params=vacunas&edit=<?= $v['id'] ?>">Editar</a>
                        <form method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar esta vacuna?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="vacuna_id" value="<?= $v['id'] ?>">
                            <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>