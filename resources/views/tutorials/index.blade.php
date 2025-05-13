@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tutorials disponibles</h1>

    <form method="GET" class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="q" class="form-control" placeholder="Cerca per títol o resum" value="{{ request('q') }}">
        </div>

        <div class="col-md-3">
            <select name="difficulty" class="form-select">
                <option value="">-- Dificultat --</option>
                <option value="Easy" {{ request('difficulty') == 'Easy' ? 'selected' : '' }}>Fàcil</option>
                <option value="Moderate" {{ request('difficulty') == 'Moderate' ? 'selected' : '' }}>Moderada</option>
                <option value="Difficult" {{ request('difficulty') == 'Difficult' ? 'selected' : '' }}>Difícil</option>
            </select>
        </div>

        <div class="col-md-3">
            <select name="time" class="form-select">
                <option value="">-- Temps estimat --</option>
                <option value="short" {{ request('time') == 'short' ? 'selected' : '' }}>Menys de 15 min</option>
                <option value="medium" {{ request('time') == 'medium' ? 'selected' : '' }}>15-30 min</option>
                <option value="long" {{ request('time') == 'long' ? 'selected' : '' }}>Més de 30 min</option>
            </select>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

    @foreach($tutorials as $tutorial)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="col-md-8">
                            <a href="{{ route('tutorials.show', $tutorial->slug) }}">
                                {{ $tutorial->title }}
                            </a>
                        </h3>
                        <p>{{ $tutorial->summary }}</p>
                        <small>Categoria: {{ $tutorial->category->name ?? 'Sense categoria' }}</small>
                    </div>
    
                    <img src="{{ $tutorial->image->thumbnail }}" alt="{{ $tutorial->title }}" class="img-fluid mt-2 col-md-2"  loading="lazy">
                </div>
            </div>
        </div>
    @endforeach

    {{ $tutorials->links() }}
</div>
@endsection
