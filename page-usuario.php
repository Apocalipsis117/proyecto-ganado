<?php
require_once 'core/auth.php';
require_once 'core/config.php';
require_once 'core/usuario.php';
require_once 'core/usuario-crud.php';
?>
<div class="container py-4">
    <h2 class="mb-3">CRUD de usuarios</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <!-- FORMULARIO -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" autocomplete="off">
                <input type="hidden" name="action" value="<?= $editUser ? 'update' : 'create' ?>">
                <?php if ($editUser): ?>
                    <input type="hidden" name="user_id" value="<?= $editUser['id'] ?>">
                <?php endif; ?>
                <div class="row g-2">
                    <div class="col-md-4">
                        <label class="form-label">Nombre*</label>
                        <input name="first_name" class="form-control" required
                            value="<?= htmlspecialchars($editUser['nombre'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Apellidos*</label>
                        <input name="last_name" class="form-control" required
                            value="<?= htmlspecialchars($editUser['apellidos'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Correo electrónico*</label>
                        <input name="email" type="email" class="form-control" required
                            value="<?= htmlspecialchars($editUser['correo'] ?? '') ?>">
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">Contraseña*</label>
                        <input name="password" type="text" class="form-control" required
                            value="<?= htmlspecialchars($editUser['contrasena'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Cargo</label>
                        <input name="role" class="form-control"
                            value="<?= htmlspecialchars($editUser['cargo'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nº Identificación</label>
                        <input name="id_number" class="form-control"
                            value="<?= htmlspecialchars($editUser['numIdentificacion'] ?? '') ?>">
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">Dirección</label>
                        <input name="address" class="form-control"
                            value="<?= htmlspecialchars($editUser['direccion'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Teléfono</label>
                        <input name="phone" class="form-control"
                            value="<?= htmlspecialchars($editUser['telefono'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Departamento</label>
                        <?php include 'components/input-departmants.php' ?>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4">
                        <label class="form-label">Ciudad</label>
                        <input name="city" class="form-control"
                            value="<?= htmlspecialchars($editUser['municipio'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">País</label>
                        <input name="country" class="form-control"
                            value="<?= htmlspecialchars($editUser['pais'] ?? '') ?>">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <?= $editUser ? 'Actualizar' : 'Crear' ?>
                        </button>
                        <?php if ($editUser): ?>
                            <a href="index.php?params=usuario" class="btn btn-secondary ms-2">Cancelar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLA DE USUARIOS -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Cargo</th>
                    <th>Nº Identificación</th>
                    <th>Teléfono</th>
                    <th>Departamento</th>
                    <th>Ciudad</th>
                    <th>País</th>
                    <th style="width: 140px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['nombre']) ?></td>
                    <td><?= htmlspecialchars($u['apellidos']) ?></td>
                    <td><?= htmlspecialchars($u['correo']) ?></td>
                    <td><?= htmlspecialchars($u['cargo']) ?></td>
                    <td><?= htmlspecialchars($u['numIdentificacion']) ?></td>
                    <td><?= htmlspecialchars($u['telefono']) ?></td>
                    <td><?= htmlspecialchars($u['departamento']) ?></td>
                    <td><?= htmlspecialchars($u['municipio']) ?></td>
                    <td><?= htmlspecialchars($u['pais']) ?></td>
                    <td>
                        <a class="btn btn-sm btn-info" href="index.php?params=usuario&edit=<?= $u['id'] ?>">Editar</a>
                        <form method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar este usuario?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                            <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>