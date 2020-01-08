<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailChanged;

// 画像縮小のために使用
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    // マイページのviewとログインしているユーザー情報を渡す
    public function mypage(){
        $id = Auth::id();
        $user = User::find($id);
        return view('mypage', compact('user'));
    }

    // プロフィール登録・変更のviewとログインしているユーザー情報を渡す
    public function profEdit(){
        $id = Auth::id();
        $user = User::find($id);

        return view('profEdit', compact('user'));
    }

    // postで送られてきたプロフィール変更のリクエストをもとにレコードを更新する
    public function profUpdate(Request $request)
    {
        /*
        下記条件でバリデーションし、対応したエラーメッセージを返す
        ユーザー名は必須、20文字以下、string型
        メールアドレスは必須、emailの形式
        自己紹介はstring形、500文字以下
        */
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email',
            'intro' => 'max:500',
            'icon' => 'image',
        ],[
            'name.required'=>'ユーザー名は入力必須です',
            'name.max'=>'ユーザー名は20文字以下でご入力ください',
            'email.required'=>'メールアドレスは入力必須です',
            'email.email'=>'メールアドレスをご入力ください',
            'intro.max'=>'自己紹介は500文字以下でご入力ください',
            'icon.image' => '対応している拡張子は「jpg、png、bmp、gif、svg」のみです',
            'uploaded' => '不具合が発生しました。時間をおいて再度お試しください。'
        ]);

        $id = Auth::id();
        $user = User::find($id);

        // リクエストのユーザー名とメールアドレスを変数に格納
        $user_name = $request['name'];
        $email = $request['email'];

        // ユーザー名に変更があった場合、重複しないか追加でバリデーションする
        if($user['name'] !== $user_name){
          $request->validate(
            ['name'=>'unique:users'],
            ['name.unique'=>'このユーザー名は既に登録されています',]
          );
        }
        // メールアドレスに変更があった場合、重複しないか追加でバリデーションする
        if($user['email'] !== $email){
            $request->validate(
                ['email'=>'unique:users'],
                ['email.unique'=>'このメールアドレスは既に登録されています',]
            );
            // 変更があった場合、メールアドレス変更を伝えるメールを新メールアドレスと旧メールアドレスに送信。その時メール本文で使うので、viewにユーザー名を渡す
            Mail::send(['text' => 'emails.email_change_plane'],[
                'username' => $user_name
            ],
            function($message) {
                global $request;
                $id = Auth::id();
                $user = User::find($id);

                $message
                    ->to($request->email)
                    ->bcc($user['email'])
                    ->subject("【重要】ご登録のメールアドレスを変更いたしました");
            });
        }

        // アイコンとそれ以外を分けて、それぞれ変数に格納
        $post = $request->except('icon');
        $icon = $request->file('icon');

        // アイコンが送信されていれば画像を保存し、読み込みのために画像パスを書き換えて保存
        if(file_exists($icon)){
            // アップロードされた画像の横幅を取得
            $width = Image::make($icon)->width();
            // もし横幅が1080pxより大きかった場合、縦横比を維持したまま1080pxに縮小
            if($width > 1080){
                $icon = Image::make($icon)
                ->resize(1080, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            // jpg形式にエンコード
            $icon = Image::make($icon)->encode('jpg');
            // ファイル名をハッシュ化
            $hash = md5($icon->__toString());
            // 保存用パスに書き換え
            $path = "app/public/{$hash}.jpg";
            // storageフォルダに保存
            $icon->save(storage_path($path));
            // 読み込み用にパスを書き換え
            $read_path = str_replace('app/public/', 'storage/', $path);

            $post += array('icon' => $read_path);
        }

        $user->fill($post)->save();

        // 処理が終わったらマイページにリダイレクトする
        return redirect(route('mypage'));
    }

    // ログアウトして、トップにリダイレクトする
    public function logout(){
      Auth::logout();
      return redirect(route('top'));
    }
}
