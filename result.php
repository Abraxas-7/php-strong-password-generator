<?php
session_start();

require_once './functions.php';

$password = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lunghezza_password'])) {
    if (isset($_POST["lunghezza_password"]) && is_numeric($_POST["lunghezza_password"]) && $_POST["lunghezza_password"] >= 1 && $_POST["lunghezza_password"] <= 50) {
        $_SESSION['lunghezza_password'] = (int)$_POST["lunghezza_password"];
    }

    $_SESSION['caratteri_maiuscoli'] = isset($_POST["caratteri_maiuscoli"]);
    $_SESSION['caratteri_minuscoli'] = isset($_POST["caratteri_minuscoli"]);
    $_SESSION['numeri'] = isset($_POST["numeri"]);
    $_SESSION['simboli'] = isset($_POST["simboli"]);

    $lunghezza_password = $_SESSION['lunghezza_password'];
    $caratteri_maiuscoli = $_SESSION['caratteri_maiuscoli'];
    $caratteri_minuscoli = $_SESSION['caratteri_minuscoli'];
    $numeri = $_SESSION['numeri'];
    $simboli = $_SESSION['simboli'];

    if (!$caratteri_maiuscoli && !$caratteri_minuscoli && !$numeri && !$simboli) {
        $error = 'Devi selezionare almeno una delle opzioni!';
    }

    if (empty($error)) {
        $password = password_generator($lunghezza_password, $caratteri_maiuscoli, $caratteri_minuscoli, $numeri, $simboli);
    }

    $_SESSION['password'] = $password;
    $_SESSION['error'] = $error;
}

$password = $_SESSION['password'] ?? '';
$error = $_SESSION['error'] ?? '';

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

    <div class="row d-flex justify-content-center">
        <div class="btn btn-primary col-2" onclick="window.location.href = './index.php'"> Torna alla selezione</div>
    </div>
</body>

</html>