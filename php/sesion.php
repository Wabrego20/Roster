<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$tiempo_inactividad = 600; // 10 minutos

if (isset($_SESSION['ULTIMA_ACTIVIDAD'])) {
    $inactividad = time() - $_SESSION['ULTIMA_ACTIVIDAD'];

    if ($inactividad >= $tiempo_inactividad) {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
        header("Location: ../../index.php?success=" . urlencode("Sesión cerrada por inactividad."));
        exit;
    }
}

$_SESSION['ULTIMA_ACTIVIDAD'] = time();