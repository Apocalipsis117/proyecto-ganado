<?php
$options = [
    "Angus",
    "Hereford",
    "Holstein",
    "Charolais",
    "Brahman",
];
?>

<select name="raza" class="form-control">
    <option value="">Seleccione</option>
    <?php foreach ($options as $key): ?>
            <option value="<?= htmlspecialchars($key) ?>" <?= (isset($editUser['raza']) && $editUser['raza'] === $key) ? 'selected' : '' ?>>
                <?= htmlspecialchars($key) ?>
            </option>
        <?php endforeach; ?>
</select>