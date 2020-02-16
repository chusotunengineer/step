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
    <form method="post" action="{{ route('createChild') }}" class="c-form">
      @csrf
      <input type="hidden" name="parent_id" value="{{ $id }}">
      @error('name')
      <p v-if="" class="u-color--red">
        <strong>{{ $message }}</strong>
      </p>
      @enderror
      <new-child />
    </form>
  </div>
</section>
@endsection
@section('footer')
@parent
@endsection
