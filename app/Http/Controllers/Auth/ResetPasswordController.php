<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    // パスワードのバリデーションルールをオーバーライド
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ];
    }
    // パスワードリセットのバリデーションメッセージをオーバーライド
    protected function validationErrorMessages()
    {
        return [
            'token.required' => '不具合が発生しました。時間をおいて再度お試しください。',
            'email.required' => 'ご登録のメールアドレスをご入力ください',
            'email.email' => 'ご登録のメールアドレスをご入力ください',
            'password.required'=>'メールアドレスは入力必須です',
            'password.min' => 'パスワードは8文字以上でご入力ください',
            'password.confirmed' => '再入力されたパスワードが一致しません',
            'passwords.user' => 'メールアドレスが誤っています'
        ];
    }
    // ResetsPasswordsのメソッドを定義する
    protected function resetPassword($user, $password) {
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();

        return redirect(route('top'));
    }
}
