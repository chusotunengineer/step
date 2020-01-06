@extends('layouts.app')

@section('title', 'ステップ編集')

@section('content')
<div class="c-bread">
  <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
  <span class="c-bread__arrow">&gt;</span>
  <span class="c-bread__txt">ステップ編集</span>
</div>
<section class="l-sec">
  <h2 class="c-title">
    ステップ編集
  </h2>
  <div class="p-mypage">
    <form method="post" action="{{ route('update') }}" class="c-form" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" value="{{ $id }}">
      <div class="c-form__row">
        <label for="name" class="c-form__label">タイトル</label>
        <div class="c-form__inputWrap">
          <input id="name" type="text" class="c-form__input" name="name" value="{{ $step['name'] }}" required autofocus>
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
            <option value="1" {{ ($step['category_id'] === 1) ? 'selected' : ''  }}>語学</option>
            <option value="2" {{ ($step['category_id'] === 2) ? 'selected' : ''  }}>プログラミング</option>
            <option value="3" {{ ($step['category_id'] === 3) ? 'selected' : ''  }}>デザイン</option>
            <option value="4" {{ ($step['category_id'] === 4) ? 'selected' : ''  }}>創作</option>
            <option value="5" {{ ($step['category_id'] === 5) ? 'selected' : ''  }}>文系資格</option>
            <option value="6" {{ ($step['category_id'] === 6) ? 'selected' : ''  }}>理系資格</option>
            <option value="7" {{ ($step['category_id'] === 7) ? 'selected' : ''  }}>その他</option>
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
          <textarea id="content" type="text" class="c-form__textarea" name="content" required>{{ $step['content'] }}</textarea>
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
          <input id="image" type="file" class="c-form__input u-mb_xs" name="image" accept="image/*">
          @error('image')
          <span>
            <strong class="u-font--alert">{{ $message }}</strong>
          </span>
          @enderror
          <span>現在の画像 *変更しない場合はこのまま保存してください</span><br>
          <img class="c-form__previewImg" src="{{ empty($step['image']) ? asset('img/no_image.png') : $step['image'] }}" alt="">
        </div>
      </div>
      <button type="submit" class="c-button c-button--wide u-mx_auto">
        保存
      </button>
    </form>
  </div>
</section>
@endsection
@section('footer')
@parent
@endsection
