@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"></div>

                <div class="card-body text-center">
                    <h3>Check your email for verification link</h3>
               
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-info justify-content-end" href="/complete/{{ $id }}">next</a>
</div>
@endsection
