<?php
// Obtener el path de la URL (por ejemplo, index.php?view=register)
$view = 'home';
if (isset($_GET['params']) && !empty(trim($_GET['params']))) {
    $view = trim($_GET['params']);
}
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
    <main class="container-fluid">
        <div class="row">
            <div class="col-2">
                <?php include_once 'components/aside.php' ?>
            </div>
            <div class="col-8">
                <?php include_once 'page-' . $view . '.php'; ?>
            </div>
        </div>
    </main>
    <script src="assets/vendor/bootstrap-5.3.0/bootstrap.bundle.min.js"></script>
</body>
</html>