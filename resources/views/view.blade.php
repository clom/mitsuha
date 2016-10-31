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
                    <div id="attend">
                    @if(!$flag)
                        {!! Form::open(['action' => 'AttendController@register2', 'class' => 'form-horizontal', 'id'=>'class_submit']) !!}
                        学生番号 {{ Form::text('student_id', old('student_id'),[ 'class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '学生番号']) }}
                        <br>
                        名前 {{ Form::text('student_name', old('student_name'),[ 'class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => '名前']) }}
                        <br>
                        {{Form::hidden('session_code', $st_code)}}
                        {{Form::hidden('class_id', $data->id)}}
                        {{Form::submit('登録', ['class' => 'btn btn-warning'])}}
                        {!! Form::close() !!}
                    @else
                        <h2>既に登録完了しています。</h2>
                    @endif
                    </div>


                </div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>学生番号</th>
                        <th>名前</th>
                        <th>打刻時刻</th>
                    </tr>
                    @foreach($student as $row)
                        <tr>
                            <td>{{ $row->student_id }}</td>
                            <td>{{ $row->student_name }}</td>
                            <td>{{ $row->created_at }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#class_submit').submit(function (event) {
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
                        $('#attend').html('<h2>既に登録完了しています。</h2>');
                        alert('出席登録しました。');
                    },

                    // 通信失敗時の処理
                    error: function (xhr, textStatus, error) {
                        alert('出席登録に失敗しました。学生番号と名前を正しく入力してください。');
                    }
                });
            });
        });

    </script>
@endsection
