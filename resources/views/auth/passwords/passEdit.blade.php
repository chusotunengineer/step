@extends('layouts.app')

@section('title', 'パスワード変更')

@section('content')
@if (session('pass_not_match'))
<div class="c-flash js-fadeout">
  <p class="c-flash__txt">{{ session('pass_not_match') }}</p>
</div>
@endif

<div class="c-bread">
  <p class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">パスワード変更</span>
  </p>
</div>
<section class="l-sec">
  <h2 class="c-title">
    パスワード変更
  </h2>
  <form method="POST" action="{{ route('passChange') }}">
    @csrf
    <div class="c-form__row">
      <label for="current" class="c-form__label">現在のパスワード</label>
      <div class="c-form__inputWrap">
        <input id="current" type="password" class="c-form__input" name="current" required autofocus>
        @error('current')
        <p>
          <strong class="u-font--alert">{{ $message }}</strong>
        </p>
        @enderror
      </div>
    </div>

    <div class="c-form__row">
      <label for="password" class="c-form__label">新しいパスワード</label>
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
      確定
    </button>
  </form>
</section>
@endsection

@section('footer')
@parent
@endsection
