<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

// MustVerifyEmailに別名を設定、Illuminate\Auth配下のMustVerifyEmailを設定
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail;

// 通知クラス
// パスワードリセット用
use App\Notifications\CustomPasswordReset;
// Email認証用
use App\Notifications\CustomVerifyEmail;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmail, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'intro', 'icon'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  // パスワードリセット用のメールアドレスを通知クラスに紐付ける
  public function sendPasswordResetNotification($token){
    $this->notify(new CustomPasswordReset($token));
  }

  // Emai認証用のメールアドレスを通知クラスに紐付ける
  public function sendEmailVerificationNotification()
  {
    $this->notify(new CustomVerifyEmail());
  }
}
