@extends('layouts.app')

@section('content')

<div class = "container">
    <form action="/p/capture" enctype="multipart/form-data" method="get">
        <label for="captureId" class="col-form-label"><strong>Capture Pokemon</strong></label>
        <br />
        Pokemon ID: <input type="text" name="captureId" maxlength="4" size="4">
        <input type="submit" value="Capture Pokemon">
    </form>
    <br />
    <input id="inp" type="button" value="View Captured Pokemon" onclick="location.href='/p/capture/view';" />
    <br /><br />
    <form action="/p/select" enctype="multipart/form-data" method="get">
        <label for="selectId" class="col-form-label"><strong>View Individual Pokemon</strong></label>
        <br />
        Pokemon ID: <input type="text" name="selectId" maxlength="4" size="4">
        <input type="submit" value="View Pokemon">
    </form>
    <br /><br />
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
                @foreach($Pokedex as $data)
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
    {{ $Pokedex->links() }}
</div>

@endsection
