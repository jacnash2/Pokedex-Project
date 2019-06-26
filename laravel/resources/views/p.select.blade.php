@extends('layouts.app')

@section('content')

<div class = "container">
    <br />
    <form action="/p" enctype="multipart/form-data" method="post">
        @csrf
        <input type="submit" value="Capture Pokemon">
    </form>
    <br /><br />
    <form action="/p" enctype="multipart/form-data" method="post">
        @csrf
        <label for="selectId" class="col-form-label"><strong>Select Individual Pokemon</strong></label>
        <br />
        Pokemon ID: <input type="text" name="selectId" maxlength="4" size="4">
        <input type="submit" value="Submit">
    </form>
    <br /><br /><br />
    <div class = "row">
        <table class="table table-hover table-bordered" border="1">
            <thead>
                <tr>
                    <th><strong>id</strong></th>
                    <th><strong>name</strong></th>
                    <th><strong>types</strong></th>
                    <th><strong>height</strong></th>
                    <th><strong>weight</strong></th>
                    <th><strong>abilities</strong></th>
                    <th><strong>egg_groups</strong></th>
                    <th><strong>stats</strong></th>
                    <th><strong>genus</strong></th>
                    <th><strong>description</strong></th>
                </tr>
            </thead>
            <tbody>
                @foreach($Pokedex as $key => $data)
                    <tr>
                        <th>{{ $data->id }}</th>
                        <th>{{ $data->name }}</th>
                        <th>{{ $data->types }}</th>
                        <th>{{ $data->height }}</th>
                        <th>{{ $data->weight }}</th>
                        <th>{{ $data->abilities }}</th>
                        <th>{{ $data->egg_groups }}</th>
                        <th>{{ $data->stats }}</th>
                        <th>{{ $data->genus }}</th>
                        <th>{{ $data->description }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
