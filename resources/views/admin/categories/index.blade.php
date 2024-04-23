@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h1>Tutte le categorie</h1>

    <table class="table mt-4">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">Descrizione</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$type->title}}</td>
                <td>{{$type->content}}</td>
                <td><a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-warning">Modifica</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection