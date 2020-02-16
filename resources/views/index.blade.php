@extends('layouts.app')

@section('title', 'ステップ一覧')
@section('description', '挑戦を共有するサービス「STEP」のステップ一覧ページです。あなたに最適なステップを見つけましょう！')

@section('content')
<div class="c-bread">
  <p class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">ステップ一覧</span>
  </p>
</div>
<section class="l-sec">
  <h2 class="c-title">
    みんなのステップ一覧
  </h2>
  <show-step :categories="{{ $category }}" />
</section>
@endsection
@section('footer')
@parent
@endsection
