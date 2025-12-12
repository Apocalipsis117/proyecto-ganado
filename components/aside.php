<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary vh-100"> <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"> <svg class="bi pe-none me-2" width="40" height="32" aria-hidden="true">
            <use xlink:href="#bootstrap"></use>
        </svg> <span class="fs-4">Sidebar</span> </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="index.php?params=home" class="nav-link <?php echo $view === 'home' ? 'active' : '' ?>" aria-current="page">
                Home
            </a> </li>
        <li> <a href="index.php?params=usuario" class="nav-link link-body-emphasis <?php echo $view === 'usuario' ? 'active' : '' ?>">
                Usuarios
            </a> </li>
        <li> <a href="index.php?params=ganado" class="nav-link link-body-emphasis <?php echo $view === 'ganado' ? 'active' : '' ?>">
                ganado
            </a> </li>
        <li> <a href="index.php?params=vacunas" class="nav-link link-body-emphasis <?php echo $view === 'vacunas' ? 'active' : '' ?>">
                Vacunas
            </a> </li>
        <li> <a href="index.php?params=crias" class="nav-link link-body-emphasis <?php echo $view === 'crias' ? 'active' : '' ?>">
                Crias
            </a> </li>
        <li> <a href="index.php?params=marcas" class="nav-link link-body-emphasis <?php echo $view === 'marcas' ? 'active' : '' ?>">
                Marcas
            </a> </li>
        <li> <a href="index.php?params=negociaciones" class="nav-link link-body-emphasis <?php echo $view === 'negociaciones' ? 'active' : '' ?>">
                Negociaciones
            </a> </li>
    </ul>
    <hr>
    <div class="dropdown"> <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> <img src="assets/imgs/avatar.jpg" alt="" width="32" height="32" class="rounded-circle me-2"> <strong>Usuario</strong> </a>
        <ul class="dropdown-menu text-small shadow">
            <li><a class="dropdown-item" href="#">Configuraciones</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="logout.php">Salir</a></li>
        </ul>
    </div>
</div>