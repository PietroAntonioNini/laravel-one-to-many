@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-center">Progetti</h1>

        <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">

            @foreach ($projects as $project)
            <div class="col">
                <div class="card text-bg-dark">
                    <img src="..." class="card-img" alt="..." style="min-height: 200px;">
        
                    <div class="card-img-overlay">
                      <h5 class="card-title">{{$project->name}}</h5>
                      <p class="card-text">{{$project->description}}</p>
                      <p class="card-text"><small>{{$project->technologies_used}}</small></p>
                      <a href="#" class="btn btn-primary">Link GitHub</a>
                    </div>
                </div>
            </div>
            @endforeach
    
        </div>
    </div>
@endsection