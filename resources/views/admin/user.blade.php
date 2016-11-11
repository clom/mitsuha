@extends('layouts.adminhead')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">UserData</div>

                    <div class="panel-body">
                        <p>登録されているユーザを確認できます。</p>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>id</th>
                            <th>name</th>
                            <th>email</th>
                            <th>Admin</th>
                            <th>create</th>
                            <th>アクション</th>
                        </thead>
                        <tbody id="userdata">
                        </tbody>
                </div>
            </div>
        </div>
    </div>
    <script>
        getUserdata();
        function getUserdata() {
            $.ajax({
                type: 'get',
                url: '/admin/userdata',
                dataType: 'json',
                success: function (data) {
                    var user_table = '';
                    data.forEach(function(user){
                        user_table = user_table + '<tr><td>'+user.id+'</td><td>'+user.name+'</td><td>'+user.email+'</td><td>'+(user.is_admin == 1? "管理者" : "非管理者")+'</td><td>'+user.created_at+'</td><td><button class="btn btn-default" onclick="changeAdmin('+user.id+')">change</button></td></tr>';
                        $('#userdata').html(user_table);
                    });
                }
            });
        }

        function changeAdmin(id) {
            $.ajax({
                type: 'get',
                url: '/admin/user/change/'+id,
                dataType: 'json',
                success: function (data) {
                    alert('管理者：変更処理完了');
                    getUserdata();
                }
            });
        }

    </script>

@endsection
