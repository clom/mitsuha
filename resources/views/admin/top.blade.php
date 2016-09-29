@extends('layouts.adminhead')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Welcome to Admin Area!
                    <hr>
                    <h2>現在時刻</h2>
                    <p id="clock">time</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
