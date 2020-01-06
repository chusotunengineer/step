@extends('layouts.app')

@section('title', 'ステップ詳細')

@section('content')
<div class="c-bread">
  <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
  <span class="c-bread__arrow">&gt;</span>
  <a href="{{ route('index') }}" class="c-bread__txt">ステップ一覧</a>
  <span class="c-bread__arrow">&gt;</span>
  <span class="c-bread__txt">{{ $step['name'] }}</span>
</div>
<section class="l-sec">
  <challenge parent_id="{{ $id }}" current="{{ (int)$current }}" />
</section>
@endsection
@section('footer')
@parent
@endsection
