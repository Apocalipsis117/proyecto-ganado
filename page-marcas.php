<?php
require_once 'core/config.php';
require_once 'core/marcas.php';
require_once 'core/marcas-crud.php';
require_once 'core/auth.php';
?>
<div class="container py-4">
    <h2 class="mb-3">CRUD de Marcas</h2>
    <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <!-- FORMULARIO -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="action" value="<?= $editMarca ? 'update' : 'create' ?>">
                <?php if ($editMarca): ?>
                    <input type="hidden" name="marca_id" value="<?= $editMarca['id'] ?>">
                <?php endif; ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Ganado*</label>
                        <select name="ganado_id" class="form-control" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($ganados as $g): ?>
                                <option value="<?= $g['id'] ?>" <?= (isset($editMarca['ganado_id']) && $editMarca['ganado_id'] == $g['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($g['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Imagen de Marca</label>
                        <input type="file" name="imagen" class="form-control">
                    </div>
                </div>
                <div class="row g-2 mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary w-100">
                            <?= $editMarca ? 'Actualizar' : 'Agregar' ?>
                        </button>
                        <?php if ($editMarca): ?>
                            <a href="index.php?params=marcas" class="btn btn-secondary ms-2">Cancelar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLA de Marcas -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Ganado</th>
                    <th width="200">Imagen de Marca</th>
                    <th style="width: 140px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($marcas as $m): ?>
                <tr>
                    <td><?= $m['marca_id'] ?></td>
                    <td>
                        <a href="index.php?params=detalle-ganado&id=<?= $m['ganado_id'] ?>">
                            <?= htmlspecialchars($m['ganado_nombre']) ?>
                        </a>
                    </td>
                    <td><img src="<?= htmlspecialchars($m['imagen_marca']) ?>" alt="Marca" style="max-width: 100px;"></td>
                    <td>
                        <a class="btn btn-sm btn-info" href="index.php?params=marcas&edit=<?= $m['marca_id'] ?>">Editar</a>
                        <form method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar esta marca?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="marca_id" value="<?= $m['marca_id'] ?>">
                            <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>