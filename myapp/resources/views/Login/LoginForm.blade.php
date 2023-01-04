<h1>라라벨 로그인 폼 테스트</h1>


<html>
    <body align='center'>
    <h1>로그인 폼</h1>
        <form name="LoginForm" method="POST" action="{{route('LoginOk')}}">
            <p>
            <li>아이디 : <input type='text' name='user_id' autofocus ></li>
            </p>
            <p>
            <li>비밀번호 : <input type='password' name='user_pw'/></li>
            </p>
            <p>
            <li>
                <input type='submit' value='로그인'/>
                <input type='reset' value='다시 쓰기'/>
                <input type='button' value='회원가입' onclick="window.location = 'RegForm'"/>
                <input type='button' value='홈으로 돌아가기' onclick="window.location= 'MainPage'"/>
               <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
            </li>
            </p>
        </form>
    </body>
</html>