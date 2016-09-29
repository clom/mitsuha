@extends('layouts.adminhead')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Attend</div>

                <div class="panel-body">
                    <p>出席対象科目の一覧と出席チェックの有効化が出来ます。</p>
                </div>
                <hr>
                <h2>情報</h2>
                <h4>科目名: {{$data->name}}</h4>
                <h4>キーワード: {{$data->keyword}}</h4>
                @if($data->available)
                    <h4>ステータス: 有効</h4>
                @else
                    <h4>ステータス: 無効</h4>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
