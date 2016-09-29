@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Attend</div>

                <div class="panel-body">
                    <p>必要事項を入力してください</p>
                </div>
                <hr>
                <h2>情報</h2>
                <h4>科目名: {{$data->name}}</h4>
                {!! Form::open(['action' => 'AttendController@register', 'class' => 'form-horizontal']) !!}
                学生番号 {{ Form::text('student_id', old('student_id'),[ 'class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '学生番号']) }}<br>
                名前 {{ Form::text('student_name', old('student_name'),[ 'class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '名前']) }}<br>
                キーワード {{ Form::text('keyword', old('keyword'),[ 'class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'キーワード' ]) }}<br>
                {{Form::hidden('session_code', $st_code)}}
                {{Form::hidden('class_id', $data->id)}}
                {{Form::submit('登録', ['class' => 'btn btn-warning'])}}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection
