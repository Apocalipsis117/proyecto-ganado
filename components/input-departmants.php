<?php
$options = [
    "Amazonas",
    "Antioquia",
    "Arauca",
    "Atlántico",
    "Bolívar",
    "Boyacá",
    "Caldas",
    "Caquetá",
    "Casanare",
    "Cauca",
    "Cesar",
    "Chocó",
    "Córdoba",
    "Cundinamarca",
    "Guainía",
    "Guaviare",
    "Huila",
    "La Guajira",
    "Magdalena",
    "Meta",
    "Nariño",
    "Norte de Santander",
    "Putumayo",
    "Quindío",
    "Risaralda",
    "San Andrés y Providencia",
    "Santander",
    "Sucre",
    "Tolima",
    "Valle del Cauca",
    "Vaupés",
    "Vichada"
];
?>

<select name="department" class="form-control" value="<?= htmlspecialchars($editUser['departamento'] ?? '') ?>">
    <option value="">Seleccione un departamento</option>
    <?php foreach($options as $key): ?>
        <option value="<?php echo $key ?>"><?php echo $key ?></option>
<?php endforeach; ?>
</select>