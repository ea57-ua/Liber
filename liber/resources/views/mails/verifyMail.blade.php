@component('mail::message')
    # Verificación de Cuenta

    ¡Gracias por registrarte en nuestra plataforma! Por favor, verifica tu dirección de correo electrónico haciendo clic en el siguiente botón:

    @component('mail::button', ['url' => $url])
        Verificar Correo Electrónico
    @endcomponent

    Si no has creado una cuenta en nuestra plataforma, puedes ignorar este correo.

    Gracias,
    {{ config('app.name') }}
@endcomponent
