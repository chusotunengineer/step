@extends('layouts.app')

@section('title', 'ステップ作成')

@section('content')
<div class="c-bread">
  <div class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">ステップ作成</span>
  </div>
</div>
<section class="l-sec">
  <h2 class="c-title">
    ステップ作成
  </h2>
  <div class="p-mypage">
    <form method="post" action="{{ route('create') }}" class="c-form" enctype="multipart/form-data">
      @csrf
      <div class="c-form__row">
        <label for="name" class="c-form__label">タイトル</label>
        <div class="c-form__inputWrap">
          <input id="name" type="text" class="c-form__input" name="name" value="{{ old('name') }}" required autofocus>
          @error('name')
          <span>
            <strong class="u-font--alert">{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="c-form__row">
        <label for="category_id" class="c-form__label">カテゴリー</label>
        <div class="c-form__inputWrap">
          <select id="category_id" class="c-form__select" name="category_id">
            <option value="1" selected>語学</option>
            <option value="2">プログラミング</option>
            <option value="3">デザイン</option>
            <option value="4">創作</option>
            <option value="5">文系資格</option>
            <option value="6">理系資格</option>
            <option value="7">その他</option>
          </select>
          @error('category_id')
          <span>
            <strong class="u-font--alert">{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="c-form__row">
        <label for="content" class="c-form__label">ステップの説明</label>
        <div class="c-form__inputWrap">
          <textarea id="content" type="text" class="c-form__textarea" name="content" required>{{ old('content') }}</textarea>
          @error('content')
          <span>
            <strong class="u-font--alert">{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="c-form__row u-mb_s">
        <label for="image" class="c-form__label">イメージ画像</label>
        <div class="c-form__inputWrap">
          <input id="image" type="file" class="c-form__input" name="image" accept="image/*">
          @error('image')
          <span>
            <strong class="u-font--alert">{{ $message }}</strong>
          </span><br>
          @enderror
        </div>
      </div>
      <button type="submit" class="c-button c-button--wide u-mx_auto">
        登録
      </button>
    </form>
  </div>
</section>
@endsection
@section('footer')
@parent
@endsection
