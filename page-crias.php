<?php
require_once 'core/config.php';
require_once 'core/crias.php';
require_once 'core/crias-crud.php';
?>
<div class="container py-4">
    <h2 class="mb-3">CRUD de Crías</h2>
    <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <!-- FORMULARIO -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" autocomplete="off">
                <input type="hidden" name="action" value="<?= $editCria ? 'update' : 'create' ?>">
                <?php if ($editCria): ?>
                    <input type="hidden" name="cria_id" value="<?= $editCria['id'] ?>">
                <?php endif; ?>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Cría*</label>
                        <select name="ganado_cria_id" class="form-control" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($ganados as $g): ?>
                                <option value="<?= $g['id'] ?>" <?= (isset($editCria['ganado_cria_id']) && $editCria['ganado_cria_id'] == $g['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($g['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Madre</label>
                        <select name="ganado_mama_id" class="form-control">
                            <option value="">Seleccione</option>
                            <?php foreach ($ganados as $g): ?>
                                <option value="<?= $g['id'] ?>" <?= (isset($editCria['ganado_mama_id']) && $editCria['ganado_mama_id'] == $g['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($g['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Padre</label>
                        <select name="ganado_papa_id" class="form-control">
                            <option value="">Seleccione</option>
                            <?php foreach ($ganados as $g): ?>
                                <option value="<?= $g['id'] ?>" <?= (isset($editCria['ganado_papa_id']) && $editCria['ganado_papa_id'] == $g['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($g['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row g-2 mt-3">
                    <div class="col-md-12 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <?= $editCria ? 'Actualizar' : 'Agregar' ?>
                        </button>
                        <?php if ($editCria): ?>
                            <a href="index.php?view=crias" class="btn btn-secondary ms-2">Cancelar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLA Crías -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Cría</th>
                    <th>Madre</th>
                    <th>Padre</th>
                    <th style="width: 140px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($crias as $c): ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td>
                        <a href="index.php?params=detalle-ganado&id=<?= $c['id'] ?>">
                            <?= htmlspecialchars($c['cria_nombre']) ?>
                        </a>
                    </td>
                    <td>
                        <a href="index.php?params=detalle-ganado&id=<?= $c['id'] ?>">
                            <?= htmlspecialchars($c['mama_nombre']) ?>
                        </a>
                    </td>
                    <td>
                        <a href="index.php?params=detalle-ganado&id=<?= $c['id'] ?>">
                            <?= htmlspecialchars($c['papa_nombre']) ?>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-info" href="index.php?params=crias&edit=<?= $c['id'] ?>">Editar</a>
                        <form method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar esta cría?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="cria_id" value="<?= $c['id'] ?>">
                            <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>