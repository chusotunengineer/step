@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="c-bread">
  <div class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">ログイン</span>
  </div>
</div>
<section class="l-sec">
  <h2 class="c-title">
    ログイン
  </h2>
  <form method="post" action="{{ route('login') }}" class="l-form c-form">
    @csrf
    <div class="c-form__row">
      <label for="email" class="c-form__label">メールアドレス</label>
      <div class="c-form__inputWrap">
        <input id="email" type="email" class="c-form__input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <span>
          <strong class="u-font--alert">{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="c-form__row u-mb_s">
      <label for="password" class="c-form__label">パスワード</label>
      <div class="c-form__inputWrap">
        <input id="password" type="password" class="c-form__input" name="password" required autocomplete="new-password">
        @error('password')
        <span>
          <strong class="u-font--alert">{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    @if (Route::has('password.request'))
    <div class="c-form__linkWrap">
      <a class="c-form__link" href="{{ route('password.request') }}">
        パスワードをお忘れですか？
      </a>
    </div>
    @endif
    <div class="c-form__checkWrap">
      <input class="c-form__check" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
      <label class="" for="remember">
        自動でログイン
      </label>
    </div>
    <button type="submit" class="c-button c-button--wide u-mx_auto">
      ログイン
    </button>
  </form>
</section>
@endsection

@section('footer')
@parent
@endsection
