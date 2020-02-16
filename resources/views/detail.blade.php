@extends('layouts.app')

@section('title', $step['name'])
@section('description', '挑戦を共有するサービス「STEP」で、【'.$step['name'].'】に挑戦しましょう！')

@section('og_title', $step['name'].' - STEP')
@section('og_type', 'article')
@section('og_description', $step['content'])
@section('og_img', $step['image'])

@section('content')
<div class="c-bread">
  <div class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <a href="{{ route('index') }}" class="c-bread__txt">ステップ一覧</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">ステップ詳細</span>
  </div>
</div>
<section class="l-sec">
  <h2 class="c-title">
    {{ $step['name'] }}
  </h2>
  <p class="c-time">
    目安達成時間： {{ $step['time'] ? $step['time'].'時間' : '未設定' }}
  </p>
  <div class="p-detail">
    <div class="p-detail__content">
      <p class="p-detail__txt">
        {!! nl2br($step['content']) !!}
      </p>
      <img class="p-detail__img" src="{{ asset($step['image']) }}" alt="step_image">
    </div>
    <div>
      <show-child parent_id="{{ $step['id'] }}" />
    </div>
    <div class="p-detail__author">
      <div class="p-detail__authorIcon">
        <span class="p-detail__authorName u-weight--bold">{{ $author['name'] }}</span>
        <div class="p-detail__authorIcon__imgWrap">
          <img class="p-detail__authorIcon__img" src="{{ empty($author['icon']) ? asset('img/no_image.png') : asset($author['icon']) }}" alt="author_icon">
        </div>
      </div>
      <div class="p-detail__authorIntro">
        <span class="u-weight--bold">プロフィール</span>
        <p class="p-detail__authorIntro__txt">
          {{ empty($author['intro']) ? '未記入' : $author['intro'] }}
        </p>
      </div>
    </div>
    <a href="steps/challenge?id={{ $step['id'] }}" class="c-button c-button--wide u-margin_auto u-margin_bottom--xl">
      チャレンジ！
    </a>
    <div class="c-share">
      <a href="http://twitter.com/share?text=挑戦を共有するサービス【STEP】で、『{{ $step['name'] }}』に挑戦しよう！&url=http://step-webukatu.sakuraweb.com/steps%3fid%3D{{ $step['id'] }}&hashtags=step,挑戦" rel="nofollow" target="_blank" class="c-share__button">
        <img src="{{ asset('img/logo__twitter@4x.png') }}" alt="twitter" class="c-share__img">
        <span class="c-share__txt u-none__mobile--sm">
          このステップをTwitterでシェアしよう！
        </span>
        <span class="c-share__txt u-none__pc--sm">
          Twitterでシェア！
        </span>
      </a>
    </div>
  </div>
</section>
@endsection
@section('footer')
@parent
@endsection
