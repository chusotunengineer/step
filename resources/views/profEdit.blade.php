@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
<div class="c-bread">
  <p class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">プロフィール編集</span>
  </p>
</div>
<section class="l-sec">
  <h2 class="c-title">
    プロフィール編集
  </h2>
  <div class="p-mypage">
    <form method="post" action="{{ route('profUpdate') }}" class="c-form" enctype="multipart/form-data">
      @csrf
      <div class="c-form__row">
        <label for="name" class="c-form__label">ニックネーム</label>
        <div class="c-form__inputWrap">
          <input id="name" type="text" class="c-form__input" name="name" value="{{ old('name') ? old('name') : $user['name'] }}" required autofocus>
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
          <input id="email" type="text" class="c-form__input" name="email" value="{{ old('email') ? old('email') : $user['email'] }}" required>
          @error('email')
          <p>
            <strong class="u-font--alert">{{ $message }}</strong>
          </p>
          @enderror
        </div>
      </div>
      <div class="c-form__row">
        <label for="intro" class="c-form__label">自己紹介</label>
        <div class="c-form__inputWrap">
          <textarea id="intro" class="c-form__input" name="intro">{{ old('intro') ? old('intro') : $user->intro }}</textarea>
          @error('intro')
          <p>
            <strong class="u-font--alert">{{ $message }}</strong>
          </p>
          @enderror
        </div>
      </div>
      <div class="c-form__row u-margin_bottom--l">
        <label for="icon" class="c-form__label">現在のアイコン</label>
        <div class="c-form__inputWrap">
          <input id="icon" type="file" class="c-form__input u-margin_bottom--m" name="icon" accept="image/*">
          @error('icon')
          <p>
            <strong class="u-font--alert">{{ $message }}</strong>
          </p>
          @enderror
          <p>現在のアイコン *変更しない場合はこのまま保存してください</p>
          <img class="c-form__previewImg" src="{{ empty($user['icon']) ? asset('img/no_image.png') : asset($user['icon']) }}" alt="">
        </div>
      </div>
      <button type="submit" class="c-button c-button--wide u-margin_auto">
        保存
      </button>
    </form>
  </div>
</section>
@endsection
@section('footer')
@parent
@endsection
