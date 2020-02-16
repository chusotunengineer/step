@extends('layouts.app')

@section('title', $step['name'])
@section('description', '挑戦を共有するサービス「STEP」で、【'.$step['name'].'】に挑戦しましょう！')

@section('content')
<div class="c-bread">
  <p class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <a href="{{ route('index') }}" class="c-bread__txt">ステップ一覧</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">{{ $step['name'] }}</span>
  </p>
</div>
<section class="l-sec">
  <challenge parent_id="{{ $id }}" current="{{ (int)$current }}" />
</section>
@endsection
@section('footer')
@parent
@endsection
