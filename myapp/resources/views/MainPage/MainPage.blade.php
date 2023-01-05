<html>
<head>
    <title>home</title>
</head>
    <body align = center>

        <ul>
            @php
            if (session('user_id') !== null){
                @endphp
                <h3>{{session('user_id')}}님 반갑습니다.</h3>
                <a href = '/LogOut' id = 'current'>로그아웃</a>
            @php
            } else {
                @endphp
                <h3> 로그인이 필요합니다. </h3>
                <a href = '/LoginForm' id = 'current'>로그인</a>
                @php
            }
            @endphp
        </ul>

    </body>
</html>