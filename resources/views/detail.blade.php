@extends('layouts.app')

@section('title', 'ステップ詳細')

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
    目安達成時間： {{ $step['time'] ? $step['time'] : '未入力' }}
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
        <span class="p-detail__authorName u-weight_bold">{{ $author['name'] }}</span>
        <div class="p-detail__authorIcon__imgWrap">
          <img class="p-detail__authorIcon__img" src="{{ empty($author['icon']) ? asset('img/no_image.png') : asset($author['icon']) }}" alt="author_icon">
        </div>
      </div>
      <div class="p-detail__authorIntro">
        <span class="u-weight_bold">プロフィール</span>
        <p class="p-detail__authorIntro__txt">
          {{ empty($author['intro']) ? '未記入' : $author['intro'] }}
        </p>
      </div>
    </div>
    <a href="steps/challenge?id={{ $step['id'] }}" class="c-button c-button--wide u-mx_auto">
      チャレンジ！
    </a>
    <!-- シェアボタン用 -->
    <a href="https://twitter.com/intent/tweet?ref_src=twsrc%5Etfw&url=http://step-webukatu.sakura.ne.jp/step/public/steps%3fid%3D{{ $step['id'] }}&text=挑戦を共有するサービス『STEP』で、「{{ $step['name'] }}」に挑戦しよう！" class="twitter-hashtag-button" data-show-count="false"></a>
  </div>
</section>
@endsection
@section('footer')
@parent
<!-- シェアボタン用 -->
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
@endsection
