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
            <table class="table table-striped table-bordered sortable-theme-bootstrap" data-sortable>
                <thead>
                <tr>
                    <th>学生番号</th>
                    <th>名前</th>
                    <th>打刻時刻</th>
                </tr>
                </thead>
                <tbody id="attendee">

                </tbody>
            </table>
        </div>
    </div>
</div>

    <script>
        function getAttendee() {
            $.ajax({
                type: 'get',
                url: '/get/attend/order/{{$data->id}}',
                dataType: 'json',
                success: function (data) {
                    var attend_table = '';
                    data.forEach(function(student){
                        attend_table = attend_table + '<tr><td>'+student.student_id+'</td><td>'+student.student_name+'</td><td>'+student.created_at+'</td></tr>';
                        $('#attendee').html(attend_table);
                    });
                }
            });
        }

        //setInterval('getAttendee()', 1000);

    </script>
@endsection
