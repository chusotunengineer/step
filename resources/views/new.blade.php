@extends('layouts.app')

@section('title', 'ステップ作成')

@section('content')
<div class="c-bread">
  <p class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">ステップ作成</span>
  </p>
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
          <p>
            <strong class="u-font--alert">{{ $message }}</strong>
          </p>
          @enderror
        </div>
      </div>
      <div class="c-form__row">
        <label for="category_id" class="c-form__label">カテゴリー</label>
        <div class="c-form__inputWrap">
          <select id="category_id" class="c-form__select" name="category_id">
            @foreach($category as $record)
            <option value="{{ $loop->iteration }}" @if($loop->iteration === 1) selected @endif>{{ $record['name'] }}</option>
            @endforeach
          </select>
          @error('category_id')
          <p>
            <strong class="u-font--alert">{{ $message }}</strong>
          </p>
          @enderror
        </div>
      </div>
      <div class="c-form__row">
        <label for="time" class="c-form__label">目安達成時間<br>（単位：時間）</label>
        <div class="c-form__inputWrap">
          <input type="number" class="c-form__input" name="time" value="{{ old('time') }}" placeholder="20">
          @error('time')
          <p>
            <strong class="u-font--alert">{{ $message }}</strong>
          </p>
          @enderror
        </div>
      </div>
      <div class="c-form__row">
        <label for="content" class="c-form__label">ステップの説明</label>
        <div class="c-form__inputWrap">
          <textarea id="content" type="text" class="c-form__textarea" name="content" required>{{ old('content') }}</textarea>
          @error('content')
          <p>
            <strong class="u-font--alert">{{ $message }}</strong>
          </p>
          @enderror
        </div>
      </div>
      <div class="c-form__row u-margin_bottom--l">
        <label for="image" class="c-form__label">イメージ画像</label>
        <div class="c-form__inputWrap">
          <input id="image" type="file" class="c-form__input" name="image" accept="image/*">
          @error('image')
          <p>
            <strong class="u-font--alert">{{ $message }}</strong>
          </p>
          @enderror
        </div>
      </div>
      <button type="submit" class="c-button c-button--wide u-margin_auto">
        登録
      </button>
    </form>
  </div>
</section>
@endsection
@section('footer')
@parent
@endsection
