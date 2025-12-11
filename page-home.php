<?php
require_once 'core/auth.php';
// dashboard.php - Vista principal de estadísticas (relleno, ejemplo)
// Esta vista es para mostrar tu "home" del sistema ganadero, lista para conectar con datos futuros.
// Usa Bootstrap 5.3

?>
<div class="container my-5">
    <h1 class="mb-4 text-center">Estadísticas del Sistema Ganadero</h1>
    <div class="row g-4 justify-content-center">
        <div class="col-md-3">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Ganado Registrado</h5>
                    <h2 class="display-5 text-primary">0</h2>
                    <p class="text-muted">Total de animales</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Usuarios</h5>
                    <h2 class="display-5 text-success">0</h2>
                    <p class="text-muted">Registro de usuarios activos</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Vacunas Aplicadas</h5>
                    <h2 class="display-5 text-warning">0</h2>
                    <p class="text-muted">Total de vacunas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-danger shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Negociaciones</h5>
                    <h2 class="display-5 text-danger">0</h2>
                    <p class="text-muted">Movimientos comerciales</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col text-center">
            <p class="lead">Panel de estadísticas. Aquí podrás visualizar resúmenes importantes del sistema, gráficos y alertas relevantes.</p>
        </div>
    </div>
    <!-- Puedes agregar más tarjetas, gráficos, o incluir datos reales en el futuro -->
</div>