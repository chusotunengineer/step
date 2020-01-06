@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
<div class="c-bread">
  <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
  <span class="c-bread__arrow">&gt;</span>
  <span class="c-bread__txt">ステップ一覧</span>
</div>
<section class="l-sec">
  <h2 class="c-title">
    みんなのステップ一覧
  </h2>
  <show-step />
</section>
@endsection
@section('footer')
@parent
@endsection
