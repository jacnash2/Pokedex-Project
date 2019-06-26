@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <br/>
                    Upload the pokedex.csv file, then click the "Upload File" button. If the pokedex is already in the database, just click the "Upload File" button to be redirected.
                </div>

                
                <form action="/home" enctype="multipart/form-data" method="post">
                    @csrf
                    <label for="csvfile" class="col-md-4 col-form-label">Select File</label>
                    <input type="file" class="form-control-file" id="text/csv" name="csvfile">
                    @if ($errors->has('text/csv'))
                        <strong>{{ $errors->first('text/csv')}}</strong>
                    @endif
                    <br />
                    <button class="btn">Upload File</button>
                </form>
                <br /><br />

            </div>
        </div>
    </div>
</div>
@endsection
