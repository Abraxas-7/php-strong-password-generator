<?php
require_once './functions.php';

$caratteri_maiuscoli = true;
$caratteri_minuscoli = true;
$numeri = true;
$simboli = true;
$lunghezza_password = '';

$password = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['lunghezza_password'])) {
    if (isset($_GET["lunghezza_password"]) && is_numeric($_GET["lunghezza_password"]) && $_GET["lunghezza_password"] >= 1 && $_GET["lunghezza_password"] <= 50) {
        $lunghezza_password = (int)$_GET["lunghezza_password"];
    }

    if (!isset($_GET["caratteri_maiuscoli"]) || !$_GET["caratteri_maiuscoli"] == 'on') {
        $caratteri_maiuscoli = false;
    }

    if (!isset($_GET["caratteri_minuscoli"]) || !$_GET["caratteri_minuscoli"] == 'on') {
        $caratteri_minuscoli = false;
    }

    if (!isset($_GET["numeri"]) || !$_GET["numeri"] == 'on') {
        $numeri = false;
    }

    if (!isset($_GET["simboli"]) || !$_GET["simboli"] == 'on') {
        $simboli = false;
    }

    if (!$caratteri_maiuscoli && !$caratteri_minuscoli && !$numeri && !$simboli) {
        $error = 'Devi selezionare almeno una delle opzioni!';
    }

    if (!$lunghezza_password) {
        $error = 'Scemo come te la genero la password se non metti la lunghezza, mica te la seleziono io di default, non devo fare il tuo lavoro <br> <br> Vai a sistemarlo va!';
    }

    if ($error == '') {
        $password = \password_generator($lunghezza_password, $caratteri_maiuscoli, $caratteri_minuscoli, $numeri, $simboli);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <?php if ($password): ?>
            <div class="mt-4 text-center">
                <h2><code class="fw-bold "><?php echo ($password); ?></code></h2>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="mt-4 text-center">
                <h3 class="text-danger"><?php echo ($error); ?></h3>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>