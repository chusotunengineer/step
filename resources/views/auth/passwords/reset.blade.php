@extends('layouts.app')

@section('title', 'パスワード再設定')

@section('content')

<div class="c-bread">
  <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
  <span class="c-bread__arrow">&gt;</span>
  <span class="c-bread__txt">パスワード再設定</span>
</div>
<section class="l-sec">
  <h2 class="c-title">
    パスワード再設定
  </h2>
  <form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="c-form__row">
      <label for="email" class="c-form__label">メールアドレス</label>

      <input id="email" type="email" class="c-form__input" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

      @error('email')
      <span>
        <strong class="u-font--alert">{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="c-form__row">
      <label for="password" class="c-form__label">新しいパスワード</label>

      <input id="password" type="password" class="c-form__input" name="password" required autocomplete="new-password">

      @error('password')
      <span>
        <strong class="u-font--alert">{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="c-form__row u-mb_s">
      <label for="password-confirm" class="c-form__label">パスワード：再入力</label>

      <input id="password-confirm" type="password" class="c-form__input" name="password_confirmation" required autocomplete="new-password">
    </div>

    <button type="submit" class="c-button c-button--wide u-mx_auto">
      確定
    </button>
  </form>
</section>
@endsection

@section('footer')
@parent
@endsection
