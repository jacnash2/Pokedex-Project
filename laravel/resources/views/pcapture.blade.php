@extends('layouts.app')

@section('content')

<div class = "container">

    <form action="/p/capture/capture" enctype="multipart/form-data" method="get">
        <label for="captureId" class="col-md-4 col-form-label"><strong>Mark a Pokemon as Captured</strong></label><br>
        Select Pokemon ID: <input type="text" name="captureId" maxlength="4" size="4">
        <input type="submit" value="Submit">
    </form>
    <br /><br />
    <input id="inp" type="button" value="View All Pokemon" onclick="location.href='/p/';" />
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
            @foreach($Pokedex as $data)
                <tbody>
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
                        <br>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</div>

@endsection
