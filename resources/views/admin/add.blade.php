@extends('layouts.adminhead')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Attend</div>

                <div class="panel-body">
                    <p>出席対象科目の登録が行えます。</p>
                </div>
            </div>
            {!! Form::open(['action' => 'AdminController@add', 'class' => 'form-horizontal']) !!}
            科目名 {{ Form::text('name', old('name'),[ 'class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '科目名']) }}<br>
            有効化 {{ Form::checkbox('available', old('available'),[ 'class' => 'form-control', 'autofocus' => 'autofocus' ]) }}<br><br>
            {{Form::submit('追加', ['class' => 'btn btn-info'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
