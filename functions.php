<?php
function password_generator(int $lunghezza_password, bool $caratteri_maiuscoli, bool $caratteri_minuscoli, bool $numeri, bool $simboli): string
{
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $symbols = '!@#$%^&*()-_=+[]{}|;:,.?';  // <> caratteri banditi, mi spaccano tutto

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
