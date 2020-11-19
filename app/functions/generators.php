<?php
/**
 * Aprašoma navigacija priklausomai nuo prisijungimo statuso
 *
 * @return string[]
 */
function navigation_bar(): array
{
    if (is_logged_in()) {
        return [
            'Pagrindinis' => '/index.php',
            'Parduoti' => '/admin/add.php',
            'Atsijungti' => '/logout.php',
        ];
    } else {
        return [
            'Pagrindinis' => '/index.php',
            'Registracija' => '/register.php',
            'Prisijungti' => '/login.php',

        ];
    }
}