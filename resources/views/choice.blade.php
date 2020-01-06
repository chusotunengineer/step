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
    編集するステップを選択
  </h2>
  <div class="p-mypage">
    <div class="l-main">
      <div class="p-mypage__content">
        <edit-step />
      </div>
    </div>
    @include('layouts.sidebar')
  </div>
</section>
@endsection
@section('footer')
@parent
@endsection
