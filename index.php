<?php
function password_generator(int $lunghezza_password, bool $caratteri_maiuscoli, bool $caratteri_minuscoli, bool $numeri, bool $simboli): string
{
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $symbols = '!@#$%^&*()-_=+[]{}|;:,.<>?';

    $characters = '';

    if ($caratteri_maiuscoli) {
        $characters .= $uppercase;
    }
    if ($caratteri_minuscoli) {
        $characters .= $lowercase;
    }
    if ($numeri) {
        $characters .= $numbers;
    }
    if ($simboli) {
        $characters .= $symbols;
    }

    $password = '';

    for ($i = 0; $i < $lunghezza_password; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $password;
}

$caratteri_maiuscoli = true;
$caratteri_minuscoli = true;
$numeri = true;
$simboli = true;
$lunghezza_password = 16;

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

    if ($error == '') {
        $password = password_generator($lunghezza_password, $caratteri_maiuscoli, $caratteri_minuscoli, $numeri, $simboli);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generatore password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container p-5">
        <h1 class="text-center">Generatore password</h1>
        <div>
            <form action="" method="get">
                <div class="mb-3 d-flex justify-content-center align-items-center row my-5">
                    <!-- Lunghezza -->
                    <div class="col-4">
                        <label for="lunghezza" class="form-label">Lunghezza della password</label>
                        <input type="number" min="1" max="50" class="form-control" id="lunghezza" name="lunghezza_password" value="<?= $lunghezza_password ?>" placeholder="Inserisci la lunghezza della password">
                    </div>

                    <!-- Opzioni -->
                    <div class="col-4 d-flex flex-column">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="caratteri_maiuscoli" name="caratteri_maiuscoli" <?= $caratteri_maiuscoli ? 'checked' : '' ?>>
                            <label class="form-check-label" for="caratteri_maiuscoli">Caratteri maiuscoli</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="caratteri_minuscoli" name="caratteri_minuscoli" <?= $caratteri_minuscoli ? 'checked' : '' ?>>
                            <label class="form-check-label" for="caratteri_minuscoli">Caratteri minuscoli</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="numeri" name="numeri" <?= $numeri ? 'checked' : '' ?>>
                            <label class="form-check-label" for="numeri">Numeri</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="simboli" name="simboli" <?= $simboli ? 'checked' : '' ?>>
                            <label class="form-check-label" for="simboli">Simboli</label>
                        </div>
                    </div>

                </div>

                <div class="row d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary col-2">Genera</button>
                </div>
            </form>
        </div>

        <?php if ($password): ?>
            <div class="mt-4 text-center">
                <h3>Password generata: <code class="fw-bold "><?php echo ($password); ?></code></h3>
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