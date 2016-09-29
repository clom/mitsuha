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
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>id</th>
                        <th>科目名</th>
                        <th>キーワード</th>
                        <th>有効化</th>
                        <th>作成日時</th>
                        <th>アクション</th>
                    </tr>
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->keyword }}</td>
                            @if($row->available)
                                <td>有効</td>
                            @else
                                <td>無効</td>
                            @endif

                            <td>{{ $row->created_at }}</td>
                            <td><input type="button" class="btn btn-default" onclick="location.href='{{url('/admin/view/'.$row->id)}}'"value="確認">
                                {!! Form::open(['action' => 'AdminController@available', 'class' => 'form-horizontal']) !!}
                                {{Form::hidden('nameid', $row->id)}}
                                {{Form::submit('変更', ['class' => 'btn btn-info'])}}
                                {!! Form::close() !!}
                                </td>
                        </tr>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
