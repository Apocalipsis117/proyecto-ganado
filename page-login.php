<?php
// Verificar si el usuario ya está logueado
if (isset($_SESSION['user_id'])) {
    header("Location: index.php?params=home"); // Redirigir al home u otra página
    exit;
}
require_once 'core/usuario-login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($view); ?> | Mi sistema</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap-5.3.0/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid bg-img">
        <div class="row justify-content-center">
            <div class="col-md-3 mt-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-4 text-center">Iniciar sesión</h3>
                        <?php if ($error): ?>
                            <div class="alert alert-danger py-1"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>
                        <form method="POST" autocomplete="off">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="email" name="email" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Iniciar</button>
                            </div>
                        </form>
                        <!-- Puedes agregar opción para registro o recuperación de contraseña aquí -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
