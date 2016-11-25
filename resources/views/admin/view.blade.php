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
                    <h4>出席者数: <span id="attendCount"></span></h4>
                    <button onclick="getAttendee()" class="btn btn-default">更新</button>
                </div>
                <table class="table table-striped table-bordered sortable-theme-bootstrap" data-sortable>
                    <thead>
                    <tr>
                        <th>学生番号</th>
                        <th>名前</th>
                        <th>打刻時刻</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="attendee">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="attendModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titlelabel">Edit Attendee</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method'=>'post', 'class' => 'form-horizontal', 'id'=>'form_submit']) !!}
                        学生番号 {{ Form::text('student_id', old('student_id'),[ 'id' => 'student_id', 'class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '学生番号']) }}
                        名前 {{ Form::text('student_name', old('student_name'),[ 'id' => 'student_name', 'class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '名前']) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {{Form::submit('登録', ['class' => 'btn btn-warning'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        getAttendee();
        function getAttendee() {
            $.ajax({
                type: 'get',
                url: '/get/attend/order/{{$data->id}}',
                dataType: 'json',
                success: function (data) {
                    var attend_table = '';
                    data.forEach(function(student){
                        attend_table = attend_table + '<tr><td>'+student.student_id+'</td><td>'+student.student_name+'</td><td>'+student.created_at+'</td><td><button class="btn btn-default" onclick="showUserModal('+student.id+')">編集</button></td></tr>';
                        $('#attendee').html(attend_table);
                    });
                }
            });
            $.ajax({
                type: 'get',
                url: '/get/attend/count/{{$data->id}}',
                dataType: 'json',
                success: function (data) {
                        $('#attendCount').text(data + '人');
                }
            });
        }

        function showUserModal(id){
            $('#attendModal').modal('show');
            getUserData(id);
        }

        function getUserData(id){
            $.ajax({
                type: 'get',
                url: '/get/attendee/edit/'+id ,
                dataType: 'json',
                success: function (student) {
                        $('#form_submit').attr({action: '/admin/attendee/edit/'+id});
                        $('#student_id').val(student.student_id);
                        $('#student_name').val(student.student_name);
                }
            });
        }

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#form_submit').submit(function (event) {
                // HTMLでの送信をキャンセル
                event.preventDefault();

                // 操作対象のフォーム要素を取得
                var $form = $(this);

                // 送信ボタンを取得
                // （後で使う: 二重送信を防止する。）
                var $button = $form.find('button');
                // 送信
                $.ajax({
                    url: $form.attr('action'),
                    type: $form.attr('method'),
                    dataType: 'json',
                    data: $form.serializeArray(),
                    timeout: 10000,  // 単位はミリ秒

                    // 送信前
                    beforeSend: function (xhr, settings) {
                        // ボタンを無効化し、二重送信を防止
                        $button.attr('disabled', true);
                    },
                    // 応答後
                    complete: function (xhr, textStatus) {
                        // ボタンを有効化し、再送信を許可
                        $button.attr('disabled', false);
                    },

                    // 通信成功時の処理
                    success: function (result, textStatus, xhr) {
                        alert('出席を修正しました。');
                        $('#attendModal').modal('hide');
                        getAttendee();
                    },

                    // 通信失敗時の処理
                    error: function (xhr, textStatus, error) {
                        alert('出席の修正に失敗しました。学生番号と名前を正しく入力してください。');
                    }
                });
            });
        });

        //setInterval('getAttendee()', 1000);

    </script>
@endsection
