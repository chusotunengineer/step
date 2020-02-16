@extends('layouts.app')

@section('title', 'ステップ削除')

@section('content')

<div class="c-bread">
  <p class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">ステップ削除</span>
  </p>
</div>
<section class="l-sec">
  <h2 class="c-title">
    削除するステップを選択
  </h2>
  <div class="p-mypage">
    <div class="l-main">
      <div class="p-mypage__content">
        <delete-step />
      </div>
    </div>
    @include('layouts.sidebar')
  </div>
</section>
@endsection
@section('footer')
@parent
@endsection
