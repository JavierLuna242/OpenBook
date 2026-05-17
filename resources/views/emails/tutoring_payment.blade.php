@extends('emails.layout', ['title' => '¡Reserva Confirmada!'])

@section('content')
    <h2>¡Reserva Confirmada!</h2>
    <p>Hola <strong>{{ $user->name }}</strong>,</p>
    <p>Hemos agendado exitosamente tu solicitud de tutoría académica. A continuación, encontrarás los detalles de tu reserva:</p>
    
    <div class="details-box">
        @php
            $title = $booking->tutoring ? $booking->tutoring->subject : 'N/A';
            $assigneeName = $booking->tutoring ? $booking->tutoring->user->name : 'No asignado';
        @endphp
        <div class="details-item"><strong>Servicio:</strong> {{ $title }}</div>
        <div class="details-item"><strong>Tutor:</strong> {{ $assigneeName }}</div>
        <div class="details-item"><strong>Fecha:</strong> {{ $booking->booking_date }}</div>
        <div class="details-item"><strong>Hora:</strong> {{ $booking->booking_time }}</div>
        @if($booking->tutoring)
            <div class="details-item"><strong>Duración:</strong> 1 Hora y 30 Minutos</div>
        @endif
        <div class="details-item"><strong>Valor:</strong> Gratis</div>
    </div>

    @if($booking->tutoring)
        <p>El día y hora de la tutoría, utiliza el siguiente enlace para conectarte con tu tutor:</p>

        <div class="btn-container">
            <a href="{{ $meetLink }}" class="btn">Unirme a la Tutoría</a>
        </div>
        
        <p style="text-align: center;">
            <small style="color: #718096;">O copia este enlace: <a href="{{ $meetLink }}" style="color: #2563EB;">{{ $meetLink }}</a></small>
        </p>
    @endif
@endsection
