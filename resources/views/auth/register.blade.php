@extends('layouts.app')

@section('title', '会員登録')
@section('description', '挑戦を共有するサービス「STEP」の会員登録ページです。')

@section('content')
<div class="c-bread">
  <p class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">会員登録</span>
  </p>
</div>
<section class="l-sec">
  <h2 class="c-title">
    新規会員登録
  </h2>
  <form method="post" action="{{ route('register') }}" class="l-form c-form">
    @csrf
    <div class="c-form__row">
      <label for="name" class="c-form__label">ユーザー名</label>
      <div class="c-form__inputWrap">
        <input id="name" type="text" class="c-form__input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
        <p>
          <strong class="u-font--alert">{{ $message }}</strong>
        </p>
        @enderror
      </div>
    </div>
    <div class="c-form__row">
      <label for="email" class="c-form__label">メールアドレス</label>
      <div class="c-form__inputWrap">
        <input id="email" type="email" class="c-form__input" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
        <p>
          <strong class="u-font--alert">{{ $message }}</strong>
        </p>
        @enderror
      </div>
    </div>
    <div class="c-form__row">
      <label for="password" class="c-form__label">パスワード</label>
      <div class="c-form__inputWrap">
        <input id="password" type="password" class="c-form__input" name="password" required autocomplete="new-password">
        @error('password')
        <p>
          <strong class="u-font--alert">{{ $message }}</strong>
        </p>
        @enderror
      </div>
    </div>
    <div class="c-form__row u-margin_bottom--l">
      <label for="password-confirm" class="c-form__label">パスワード：再入力</label>
      <div class="c-form__inputWrap">
        <input id="password-confirm" type="password" class="c-form__input" name="password_confirmation" required autocomplete="new-password">
      </div>
    </div>
    <button type="submit" class="c-button c-button--wide u-margin_auto">
      登録
    </button>
  </form>
</section>
@endsection

@section('footer')
@parent
@endsection
