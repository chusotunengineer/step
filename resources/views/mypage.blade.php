@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
<div class="c-bread">
  <p class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">マイページ</span>
  </p>
</div>
<section class="l-sec">
  <h2 class="c-title">
    {{ $user['name'].' ' }}さんのマイページ
  </h2>
  <div id="wrap" class="p-mypage">
    <div class="l-main">
      <div class="p-mypage__content">
        <h3 class="c-title c-title--m">
          登録済みステップ一覧
        </h3>
        <my-step />
      </div>
      <div class="p-mypage__content">
        <h3 class="c-title c-title--m">
          挑戦中のステップ一覧
        </h3>
        <challenge-step />
      </div>
    </div>
    @include('layouts.sidebar')
  </div>
</section>
@endsection
@section('footer')
@parent
@endsection
