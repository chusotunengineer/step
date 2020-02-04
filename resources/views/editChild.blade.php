@extends('layouts.app')

@section('title', 'ステップ編集')

@section('content')
<div class="c-bread">
  <div class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">ステップ編集</span>
  </div>
</div>
<section class="l-sec">
  <h2 class="c-title">
    ステップ編集
  </h2>
  <div class="p-mypage">
    <form method="post" action="{{ route('updateChild') }}" class="c-form">
      @csrf
      <input type="hidden" name="parent_id" value="{{ $_GET['id'] }}">
      <edit-child parent_id="{{$id}}" />
    </form>
  </div>
</section>
@endsection
@section('footer')
@parent
@endsection
