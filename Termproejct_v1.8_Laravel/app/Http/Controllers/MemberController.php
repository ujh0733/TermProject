<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class MemberController extends Controller
{
	function login_page(Request $request){
		$board_num = $request->board_num;
		$page = $request->page;
		
		return view('login_page')->with('board_num', $board_num)
								->with('page', $page);
	}

	function closeLoginPage(Request $request){
	?>
		<script>
			alert('로그인 성공!');
			window.opener.parent.location.reload();
			window.close();
		</script>
	<?php
	}

    public function signUp_page(){
    	return view('signUp_page');
    }

    public function signUpSuccess(){
    	return redirect('/')->with('alert', '회원가입을 축하드립니다!\n로그인해 주세요!');
    }

	public function updateInformation_page(){

		$user_Information = User::where('user_id', Auth::user()->user_id)->first();

		$birth = (int)preg_replace("/[^0-9.]/", "", $user_Information->user_birth);	//특수문자 제외
	  	$postcode = explode("-", $user_Information->user_postcode);
	  	$addr = explode("~", $user_Information->user_addr);

	  	return view('updateInformation_page')->with('user_Information', $user_Information)
	  										->with('birth', $birth)
	  										->with('postcode', $postcode)
	  										->with('addr', $addr);
	}

	public function updateInformation(Request $request){

		$user_id = $request->user_id;
		$user_pwd = $request->user_pwd;
		$user_name = $request->user_name;
		$user_email = $request->user_email;
		$user_phone = $request->user_phone;
		$user_profile = "user_profile";

		$year = $request->year;
		$month = $request->month;
		$day = $request->day;
		$user_birth = $year."-".$month."-".$day;

		$postcode1 = $request->postcode1;
		$postcode2 = $request->postcode2;
		$postcode = $postcode1."-".$postcode2;

		$addr = $request->addr;
		$addr_etc = $request->addr_etc;
		$user_addr = $addr."~".$addr_etc;

		//$user_profile = saveImg($user_profile);

		if($user_profile == ""){
			$user_profile = $request->no_select;
		}

		$user = new User();

		$user->updateInformation($user_id, $user_pwd, $user_name, $user_email, $user_phone, $user_birth, $postcode, $user_addr, $user_profile);

		return redirect('/')->with('alert', '회원정보 변경이 완료되었습니다.');
	}

	public function id_check(Request $request){
		$input_id = $request->user_id;

		$check = User::where('user_id', $input_id)->first();

		if($check){
			return redirect('signUp_page')->with('alert', '중복된 아이디 입니다.');
		}else{
			return redirect('signUp_page')->withs('alert', '사용가능한 아이디입니다.');
		}
	}

	public function myPage(Request $request){
		return view('myPage');
	}
}
?>