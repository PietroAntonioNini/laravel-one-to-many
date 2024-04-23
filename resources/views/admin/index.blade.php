@extends('layouts.app')

@section('content')
<div class="container alert alert-success alert-dismissible fade show w-25" role="alert">

    <div class="card-header">{{ Auth::user()->name }}</div>

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
    
        {{ __('You are logged in!') }}
    </div>
        
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

</div>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Benvenuto {{ Auth::user()->name }}</h1>  
        <a href="{{ route('admin.projects.create') }}" class="btn btn-outline-primary">Aggiungi nuovo progetto</a>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">

        @foreach ($projects as $project)
        <div class="col">
            <div class="card text-bg-dark">
                <img src="{{ asset('storage/' . $project->cover_image) }}" class="card-img" alt="..." style="min-height: 200px;">
    
                <div class="card-img-overlay">
                  <h5 class="card-title">{{$project->name}}</h5>
                  <p class="card-text">{{$project->description}}</p>
                  <p class="card-text"><small>{{$project->technologies_used}}</small></p>
                  <p class="card-text"><small>{{$project->type?->title}}</small></p>

                  {{-- button  --}}
                  <div class="d-flex justify-content-between align-items-center">
                        <a href="#" class="btn btn-primary">Link GitHub</a>

                        <div class="d-flex">
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-outline-warning btn-sm me-2">Modifica</a>

                            <!-- Modal button -->
                            <button type="button" class="btn btn-outline-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#delete-project">
                                Elimina Progetto
                            </button>

                            <!-- Modal Body -->
                            <div class="modal fade" id="delete-project" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="delete-project" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete-project">Elimina Progetto</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Sei sicuro che vuoi eliminare questo progetto?') }}
                                            </h2>
                                            <p class="mt-1 text-sm text-gray-600">
                                                {{ __('Una volta che il tuo progetto viene eliminato, tutte le risorse e i dati verranno eliminati definitivamente. Perfavore inserisci la tua password per confermare che vuoi eliminare definitivamente questo progetto.') }}
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

                                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="p-6">
                                                @csrf
                                                @method('DELETE')

                                                <div class="input-group">
                                                    <button type="submit" class="btn btn-danger">
                                                        {{ __('Elimina Progetto') }}
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                  </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
<div>
@endsection