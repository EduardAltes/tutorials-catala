@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $tutorial->title }}</h1>
    <p class="text-muted">{{ $tutorial->summary }}</p>

    <div class="mb-3">
        <strong>Dificultat:</strong> {{ $tutorial->difficulty ?? 'Desconeguda' }} |
        <strong>Temps estimat:</strong> {{ $tutorial->time_required ?? 'No especificat' }}
    </div>

    @foreach($tutorial->steps as $step)
        <div class="mb-4">
            <h4>PAS {{ $step->order }}: {{ $step->title }}</h4>
            <p>{{ $step->body }}</p>
        </div>
    @endforeach

    <img src="{{ $tutorial->image->url }}" alt="{{ $tutorial->title }}" class="img-fluid mb-4"  loading="lazy">
</div>
@endsection
