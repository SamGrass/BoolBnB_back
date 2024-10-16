@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h2>Dettagli appartamento</h2>
                    </div>

                    {{-- IMMAGINE APPARTAMENTO --}}
                    @if ($apartment->img)
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <h4>Immagini dell'appartamento</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @php
                                        $images = explode(', ', $apartment->img);
                                    @endphp

                                    @foreach ($images as $image)
                                        <div class="col-md-4 mb-3">
                                            <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded"
                                                alt="Immagine appartamento">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="/img/no-image.jpg" class="img-fluid" alt="Immagine non disponibile">
                            </div>
                        </div>
                    @endif


                    {{-- INIZIO CARD PER I DETTAGLI --}}


                    <div class="card-body">
                        <h3 class="card-title"></h3>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>
                                        <i class="fas fa-door-open"></i>
                                        Stanze:
                                    </strong> {{ $apartment->rooms }}</p>
                                <p><strong>
                                        <li class="fas fa-bed"></li>
                                        Letti:
                                    </strong> {{ $apartment->beds }}</p>
                                <p><strong>
                                        <li class="fas fa-toilet"></li>
                                        Bagni:
                                    </strong>{{ $apartment->bathrooms }}</p>
                                <p><strong>
                                        Metri quadrati: </strong>{{ $apartment->mq }} <strong>m²</strong></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>
                                        <i class="fa-solid fa-city"></i>
                                        Città: </strong> {{ $apartment->city }}</p>
                                <p><strong>
                                        <i class="fa-solid fa-street-view"></i>
                                        Indirizzo: </strong> {{ $apartment->address }} {{ $apartment->civic_number }}</p>
                                <p><strong>Visibile:</strong>
                                    @if ($apartment->is_visible)
                                        <i class="fa-solid fa-eye"></i> Si
                                    @else
                                        <i class="fa-solid fa-eye-slash"></i> No
                                    @endif
                                </p>

                                {{-- Sezione Servizi --}}
                                <div class="mb-3">
                                    <h4>Servizi dell'appartamento</h4>
                                    @if ($apartment->services)
                                        @foreach ($apartment->services as $service)
                                            <span class="badge bg-warning">{{ $service->name }}</span>
                                        @endforeach
                                    @else
                                        <p>Nessun servizio disponibile</p>
                                    @endif
                                </div>

                                <div class="text-muted">
                                    <p><strong>Data Pubblicazione:</strong> {{ $apartment->created_at->format('d F Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        {{-- prova mappa --}}
                        <div id="map" class="mb-3"></div>



                        {{-- BTN PER TORNARE ALL' ELENCO APPARTAMENTI --}}
                        <div class="mt-4">
                            <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary">Torna all'elenco</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- script per far funzionare la mappa di tom tom --}}
    <script>
        // creo una constante dove inserisco la apiKey che prendo dal file config
        const apiKey = "{{ config('app.tomtomApiKey') }}";
        const latitude = "{{ $apartment->latitude }}"
        const longitude = "{{ $apartment->longitude }}"
        // Inizializza la mappa con tt.map che sono comandi della libreria tomtom
        var map = tt.map({
            key: apiKey, // Sostituisci con la tua chiave API
            container: 'map', // l'id del contenitore html in cui deve essere inserita la mappa
            center: [longitude, latitude], // Coordinate iniziali del centro della visualizzazione della mappa
            zoom: 14 // livello di zoom iniziale della mappa, più è alto più è zoommato
        });

        // Aggiungi un marker sulla mappa con tt.maker
        var marker = new tt.Marker()
            .setLngLat([longitude, latitude]) // Passo le coordinate della posizione del maker
            .addTo(map); // comando per aggiungere il maker alla mappa
    </script>

@endsection