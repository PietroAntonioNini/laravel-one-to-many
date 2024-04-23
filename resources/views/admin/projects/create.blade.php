@extends('layouts.app')

@section('content')
<div class="container py-5">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Titolo:</label>
            <input type="text" class="form-control @error('name') is-invalid  @enderror" id="name" name="name" value="{{old('name')}}">
            @error('name') <span class="text-danger">{{$message}}</span> @enderror
        </div>
        <div class="form-group mb-3">
            <label for="description">Descrizione:</label>
            <textarea class="form-control @error('description') is-invalid  @enderror" id="description" name="description" rows="4">{{old('description')}}</textarea>
            @error('description') <span class="text-danger">{{$message}}</span> @enderror
        </div>
        <div class="form-group mb-3">
            <label for="cover_image">Immagine di copertina:</label>
            <input type="file" class="form-control @error('cover_image') is-invalid  @enderror" id="cover_image" name="cover_image">
            @error('cover_image') <span class="text-danger">{{$message}}</span> @enderror
        </div>
        <div class="form-group mb-3">
            <label for="technologies_used">Linguaggi usati:</label>
            <input type="text" class="form-control @error('technologies_used') is-invalid  @enderror" id="technologies_used" name="technologies_used" value="{{old('technologies_used')}}">
            @error('technologies_used') <span class="text-danger">{{$message}}</span> @enderror
        </div>
        <div class="form-group mb-3">
            <label for="type_id">Tipologia:</label>
            <select class="form-select" name="type_id" id="type_id">
            
                <option value=""></option>

                @foreach ($types as $type)
                <option value="{{$type->id}}" {{ $type->id == old('type_id') ? 'selected' : '' }}>{{ $type->title }}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group mb-3">
            <label for="github_link">Link alla repo GitHub:</label>
            <input type="text" class="form-control @error('github_link') is-invalid  @enderror" id="github_link" name="github_link" value="{{old('github_link')}}">
            @error('github_link') <span class="text-danger">{{$message}}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary py-3 px-4">Salva</button>
    </form>
</div>
@endsection