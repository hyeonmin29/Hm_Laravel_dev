<?php

namespace App\Http\Controllers\Login;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use App\Http\Exception\Handler;
use validator;
use Exception;



/* mileage 관련 */

class LoginController extends Controller
{
    private $request;

    #포스트값 있으면 request생성
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    # 회원가입
    public function fnReg(Request $request)
    {
        $rgParams = collect($this->request->all());
        try {
            if ($rgParams->get('user_id') == null) {
                throw new exception('ID를 확인해주세요.');
            }
            if ($rgParams->get('user_name') == null) {
                throw new exception('이름을 확인해주세요');
            }
            if ($rgParams->get('user_pw') == null) {
                throw new exception(' 비밀번호를 확인해주세요.');
            }
            if ($rgParams->get('user_phone') == null) {
                throw new exception(' 핸드폰 번호를 확인해주세요.');
            }
            if ($rgParams->get('user_email') == null) {
                throw new exception(' 이메일을 확인해주세요.');
            }
            if ($rgParams->get('user_birth') == null) {
                throw new exception(' 생년월일을 확인해주세요.');
            }
            if ($rgParams->get('user_account') == null) {
                throw new exception(' 은행을 확인해주세요.');
            }
            if ($rgParams->get('user_account_num') == null) {
                throw new exception(' 은행 번호를 확인해주세요.');
            }

            $CtestConnection = DB::connection('mysql');
            if ($CtestConnection == false) {
                throw new exception('');
            }

            # 중복 아이디 체크
            $qryCehck = $CtestConnection
                ->table('user_info')
                ->select('user_id')
                ->where('user_id', '=', $rgParams->get('user_id'))
                ->first();

            if ($qryCehck !== null) {
                throw new exception('중복 아이디 있음');
            }

            $qryInsert = $CtestConnection
                ->table('user_info')
                ->insert([
                    'user_id' => $rgParams->get('user_id'),
                    'user_name' => $rgParams->get('user_name'),
                    'user_pw' => $rgParams->get('user_pw'),
                    'user_phone' => $rgParams->get('user_phone'),
                    'user_email' => $rgParams->get('user_email'),
                    'user_birth' => $rgParams->get('user_birth'),
                    'user_account' => $rgParams->get('user_account'),
                    'user_account_num' => $rgParams->get('user_account_num'),
                    'reg_day' => now()
                ]);

            dd($qryInsert);

            if ($qryInsert == false) {
                throw new exception('회원가입 실패');
            }

            return view('MainPage/MainPage', [
                'user_id' => $rgParams->get('user_id'),
            ]);

        } catch (exception $e) {
            echo $e;
        }
    }

    #유저 로그인
    public function fnUserLogin(Request $request)
    {
        try {
            # 포스트 값을 all 헬퍼 함수로 나열
            $rgParams = collect($this->request->all());

            # id 입력 체크
            if ($rgParams->get('user_id') == null) {
                throw new exception('ID를 입력해주세요');
            }

            # pw 입력 체크
            if ($rgParams->get('user_pw') == null) {
                throw new exception('PW를 입력해주세요');
            }

            # DB연결
            $CtestConnection = DB::connection('mysql');
            if ($CtestConnection == false) {
                throw new exception('DB연결 실패');
            }

            # 유저 아이디, 불러오기
            $qry = $CtestConnection
                ->table('user_info')
                ->select('*')
                ->where('user_id', '=', $rgParams->get('user_id'))
                ->where('user_pw', '=', $rgParams->get('user_pw'))
                ->where('status', '=', 'n')
                ->first();

            # 빈값이면 예외처리
            if (empty($qry)) {
                throw new exception('아이디 비밀번호 오류');
            }


            #전에 있던 세션 데이터 삭제
            session()->flush();

            # 세션 값 입력 방법 중 하나 밑 과정과 같음
            # $request->session()->put('user_id',$qry->user_id);

            session([
                'user_id' => $qry->user_id,
                'user_num' => $qry->user_num,
                'user_name' => $qry->user_name,
                'user_Email' => $qry->user_email,
                'status' => $qry->status
            ]);

            #웰컴 페이지로 전환하고 아이디 넘기기
            return view('MainPage/MainPage');

            # 예외처리
        } catch (exception $e) {
            #아이디 비밀번호 안맞으면 되돌아옴 -->>나중에 경고창 생성해야함
            return redirect()->back()->with('alert', $e);
        }
    }

    public function fnLogOut()
    {
        try {
            #  세션 데이터 존재하는지 확인 has 메소드 사용 있으면 세션 삭제
            if ($this->request->session()->has('user_id') == true) {
                # 변수 초기화 -> 로그에 입력
                $strUserID = session('user_id');

                # 모든 세션 데이터 삭제 flush메소드 사용  (forget으로 하나씩 or 멀티로 지울 수 있음)
                $this->request->session()->flush();
            } else {
                throw new exception('로그인 정보가 없습니다.');
            }
            return view('/MainPage/MainPage');
        } catch (exception $e) {
            return view('/MainPage/MainPage');
        }
    }

    public function fnPaginate()
    {
        return view('user.index', [
            'users'=>DB::table('users')->paginate(2)
        ]);
    }


}

?>