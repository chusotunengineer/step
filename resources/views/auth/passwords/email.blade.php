@extends('layouts.app')

@section('title', 'パスワード再設定')

@section('content')

@if (session('email_sent'))
<div class="c-flash js-fadeout">
  <p class="c-flash__txt">{{ session('email_sent') }}</p>
</div>
@endif
<div class="c-bread">
  <p class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">パスワード再設定</span>
  </p>
</div>
<section class="l-sec">
  <h2 class="c-title">
    パスワード再設定
  </h2>
  <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="c-form__row u-margin_bottom--l">
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
    <button type="submit" class="c-button c-button--wide u-margin_auto">
      パスワード再設定用のメールを送信
    </button>
  </form>
</section>

@endsection

@section('footer')
@parent
@endsection
