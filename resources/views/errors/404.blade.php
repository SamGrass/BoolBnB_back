
@extends('layouts.app')

@section('title', 'Pagina non trovata')

@section('content')
    <div class="error-page">
        <h1>404</h1>
        <p>Spiacente, la pagina che stai cercando non esiste.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Torna alla home</a>
    </div>
@endsection
