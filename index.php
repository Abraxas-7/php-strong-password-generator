<?php
require_once './functions.php';

$caratteri_maiuscoli = true;
$caratteri_minuscoli = true;
$numeri = true;
$simboli = false;
$lunghezza_password = 16;

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
            <form action="./result.php" method="get">
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
    </div>
</body>

</html>