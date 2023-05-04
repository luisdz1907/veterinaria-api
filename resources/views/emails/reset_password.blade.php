<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Restablecimiento de contraseña</h1>
        <p>Haga clic en el siguiente enlace para restablecer su contraseña:</p>
        <p><a href="{{ $resetUrl }}">{{ $resetUrl }}</a></p>
        <p>Este enlace de restablecimiento de contraseña expirará en {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} minutos.</p>
    </body>
</html>
