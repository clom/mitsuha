@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Attend System</div>

                <div class="panel-body">
                    対象授業を選択してください。
                </div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>科目名</th>
                        <th>アクション</th>
                    </tr>
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $row->name }}</td>
                            <td><input type="button" class="btn btn-info" onclick="location.href='{{url('/attend/'.$row->id)}}'"value="登録"></td>
                        </tr>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
