@extends('emails.layout', ['title' => 'Recuperación de Contraseña'])

@section('content')
    <h2>Recuperación de Contraseña</h2>
    <p>Hola,</p>
    <p>Has recibido este correo porque se solicitó un restablecimiento de contraseña para tu cuenta en la plataforma de <strong>OpenBook</strong>.</p>
    
    <div class="btn-container">
        <a href="{{ $resetLink }}" class="btn">Restablecer Contraseña</a>
    </div>

    <div class="details-box">
        <p style="margin: 0; font-size: 14px; color: #718096;">
            Si tienes problemas con el botón, copia y pega el siguiente enlace en tu navegador:<br>
            <a href="{{ $resetLink }}" style="color: #2563EB; word-break: break-all;">{{ $resetLink }}</a>
        </p>
    </div>

    <p>Si no solicitaste este cambio, puedes ignorar este correo de forma segura. Tu contraseña actual no cambiará hasta que accedas al enlace anterior y crees una nueva.</p>
@endsection
