<?php
$options = [
    "Colombia",
    "Argentina",
    "Brasil",
    "Chile",
    "Perú",
    "Venezuela",
    "Ecuador",
    "Uruguay",
    "Paraguay",
    "Bolivia",
    "Guyana",
    "Surinam"
];
?>

<select name="country" class="form-control">
    <option value="">Seleccione</option>
    <?php foreach ($options as $key): ?>
            <option value="<?= htmlspecialchars($key) ?>"
                <?= (isset($editUser['pais']) && $editUser['pais'] === $key) ? 'selected' : '' ?>>
                <?= htmlspecialchars($key) ?>
            </option>
        <?php endforeach; ?>
</select>