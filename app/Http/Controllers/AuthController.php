<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\SendEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{

    public function getLogin()
    {
        return view('login');
    }
    public function getSignup()
    {
        return view('signup');
    }

    public function store(UserRequest $request)
    {
        if (DB::table('users')->where('email', $request->email)->doesntExist()) {

            $newUser = $request->validated();
            if ($request->hasFile('avatar')) {
                $file = $request->avatar;
                $fileExtension = $file->getClientOriginalExtension();
                $file->move("uploads", $request->email . "." . $fileExtension);
            }
            $newUser['password'] = bcrypt($request->password);
            $newUser['avatar'] = $request->email . "." . $fileExtension;

            User::create($newUser);
            return redirect('/dang-ky')->with('message', 'Đăng ký thành công xin mời đăng nhập');
        } else {
            return redirect('/dang-ky')->with('message', 'Tài khoản đã tồn tại xin mời đăng nhập');
        }
    }
    public function checkLogin(Request $request)
    {
        $rule = [
            'email' => 'required',
            'password' => 'required'
        ];
        $messages = [
            'required' => 'Trường bắt buộc phải nhập'
        ];
        $user = $request->validate($rule, $messages);
        $remember = $request->remember;
        if (Auth::attempt(['email' => $user['email'], 'password' => $user['password']], $remember)) {
            if ($remember == 'on') {
                $user = User::find(Auth::user()->id);
                $user->remember_token = Str::random(60);
                $user->update();
            } else {
                $user = User::find(Auth::user()->id);
                $user->remember_token = null;
                $user->update();
            }
            if (Auth::user()->role == 0) {
                return redirect('admin/index')->with('message', 'Đăng nhập thành công');
            } else if (Auth::user()->role == 2) {
                Auth::logout();
                return redirect('/')->with('message', 'Tài khoản đã bị khoá');
            } else {
                return redirect('/');
            }
        } else {
            return redirect()->route('login')->with('message', 'Tài khoản hoặc mật khẩu không chính xác');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('message', 'Đăng xuất thành công');
    }


    public function recovery()
    {
        return view('recovery');
    }
    public function viewcheckcode(Request $request)
    {
        $email = $request->email;
        return view('checkcode', [
            'email' => $email,
        ]);
    }
    public function sendEmail(Request $request)
    {
        $rule = [
            'email' => 'required|email',
        ];
        $messages = [
            'required' => 'Trường bắt buộc phải nhập',
            'email' => 'Trường là email chứa @'
        ];
        $request->validate($rule, $messages);
        if (User::where('email', $request->email)->doesntExist()) {
            return redirect('/recovery')->with('message', 'Tài khoản KHÔNG tồn tại');
        } else {
            $email = $request->email;
            $pass_code = rand(11111, 99999);
            DB::table('password_reset')->insert([
                'email' => $email,
                'token' => $pass_code,
                'created_at' => Carbon::now(),
                'expires_at' => Carbon::now()->addMinutes(15),
            ]);
            Mail::to($request->email)->send(new SendEmail($pass_code, $email));
            return redirect()->route('checkcode', ['email' => $email])->with('message', 'Đã gửi email chứa mã xác minh tới mail của bạn');
        }
    }

    public function checkcode(Request $request)
    {
        $rule = [
            'password' => 'required|confirmed',
            'code' => 'required',
        ];
        $messages = [
            'required' => 'Trường bắt buộc phải nhập',
            'confirmed' => 'Mật khẩu phải giống nhau',
        ];
        $request->validate($rule, $messages);
        $token = PasswordReset::where('email', $request->email)
            ->where('token', $request->code)
            ->first();
        
        if ($token == null) {
            return redirect()->route('checkcode', ['email' => $request->email])->with('message', 'Mã xác thực sai');
        } else {
            User::where('email', $request->email)->update(['password' =>  bcrypt($request->password)]);
            return redirect('/login')->with('message', 'Đổi mật khẩu thành công');
        }
    }
}
