@extends('emails.layout', ['title' => '¡Nueva Tutoría Agendada!'])

@section('content')
    <h2>¡Nueva Tutoría Agendada!</h2>
    <p>Hola <strong>{{ $assignee->name }}</strong>,</p>
    <p>Un estudiante ha reservado exitosamente una de tus tutorías. A continuación, encontrarás los detalles de la sesión:</p>
    
    <div class="details-box">
        <div class="details-item"><strong>Materia:</strong> {{ $booking->tutoring->subject }}</div>
        <div class="details-item"><strong>Estudiante:</strong> {{ $student->name }}</div>
        <div class="details-item"><strong>Fecha:</strong> {{ $booking->booking_date }}</div>
        <div class="details-item"><strong>Hora:</strong> {{ $booking->booking_time }}</div>
        <div class="details-item"><strong>Duración:</strong> 1 Hora y 30 Minutos</div>
        <div class="details-item"><strong>Costo:</strong> Gratis</div>
    </div>

    <p>El día y hora de la tutoría, por favor ingresa al siguiente enlace de Google Meet para conectarte con el estudiante:</p>

    <div class="btn-container">
        <a href="{{ $meetLink }}" class="btn">Unirme a la Tutoría</a>
    </div>
    
    <p style="text-align: center;">
        <small style="color: #718096;">O copia este enlace: <a href="{{ $meetLink }}" style="color: #2563EB;">{{ $meetLink }}</a></small>
    </p>

    <p>Recuerda estar presente 5 minutos antes para asegurar una buena experiencia para el estudiante.</p>
@endsection
