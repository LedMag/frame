<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My App'; ?></title>
    <?php $this->assets()->renderStyles('/assets/css/components/header.css'); ?>
</head>
<body>
    <?php $this->component('header', ['user' => $user ?? null]); ?>

    <main>
        <?= $content; ?>
    </main>

    <?php $this->component('footer'); ?>

    <!-- <script src="/assets/scripts.js"></script> -->
    <?= $extraScripts ?? ''; ?>
</body>
</html>