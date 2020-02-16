@extends('layouts.app')

@section('title', 'トップ')

@section('ogp')
<meta property="og:url" content="http://step-webukatu.sakuraweb.com/" />
<meta property="og:title" content="STEP" />
<meta property="og:type" content="website">
<meta property="og:description" content="あなたの人生のSTEPを共有しよう！挑戦を共有するサービス『STEP』" />
<meta property="og:image" content="{{ asset('img/twitter_card.png') }}" />
@endsection

@section('content')
<div class="p-hero">
  <div class="p-hero__copyWrap">
    <span class="p-hero__copy">
      WE HAVE A <span class="p-hero__copy--accent"><br class="u-none__pc--xl">DREAM</span> TODAY!
    </span>
    <span class="p-hero__copy p-hero__copy--small">
      あなたの挑戦を誰かと共に
    </span>
  </div>
  <button class="c-button c-button--transparent p-hero__button" onclick="location.href='{{ route('register') }}'">
    無料で会員登録！
  </button>
  <img src="{{ asset('img/top_hero@2x.jpg') }}" alt="dream" class="p-hero__img">
</div>
<section class="l-sec">
  <h2 class="c-title">
    挑戦したいことはあるけれど・・・
  </h2>
  <div class="p-target">
    <div class="p-target__item">
      <div class="p-target__imgWrap">
        <img src="{{ asset('img/top01@2x.png') }}" alt="target" class="p-target__img">
      </div>
      <span class="p-target__txt">何から始めるべきか<br>分からない</span>
    </div>
    <div class="p-target__item">
      <div class="p-target__imgWrap">
        <img src="{{ asset('img/top02@2x.png') }}" alt="target" class="p-target__img">
      </div>
      <span class="p-target__txt">長く続かない</span>
    </div>
    <div class="p-target__item">
      <div class="p-target__imgWrap">
        <img src="{{ asset('img/top03@2x.png') }}" alt="target" class="p-target__img">
      </div>
      <span class="p-target__txt">なんとなく不安</span>
    </div>
  </div>
</section>
<section class="l-sec">
  <h2 class="c-title">
    あなたの人生のSTEPを共有しよう<br>
    挑戦を共有するサービス『STEP』
  </h2>
  <div class="p-concept">
    <p class="p-concept__txt">
      STEPは夢に挑戦する手順を共有するサービスです。<br>
      あなたの挑戦を記録することで、それが誰かの夢への道しるべになったり、<br>
      あなたの叶えたい夢への地図を手に入れることもできます。<br>
      叶えたい夢はありませんか。ずっと空想していた未来はありませんか。<br>
      小さなことでも大きなことでも、それはとても尊い物です。<br>
      STEPはそんなあなたのために生まれました。<br>
      夢を叶えるのに必要なのは適切なステップだけです。<br>
      誰かが用意してくれたステップを使うのも、<br>
      あなた自身で誰かのためにステップを作るのも自由です。<br>
      さあ、挑戦しましょう。
    </p>
    <img src="{{  asset('img/concept@2x.jpg') }}" alt="concept" class="p-concept__img">
  </div>
</section>
<section class="l-sec">
  <h2 class="c-title">
    誰かのステップに挑戦する
  </h2>
  <div class="p-manual">
    <div class="c-card">
      <span class="c-card__num">1</span>
      <div class="c-card__imgWrap">
        <img src="{{ asset('img/card01@4x.jpg') }}" alt="howto" class="c-card__img c-card__img--numList">
      </div>
      <span class="c-card__txt">ユーザー登録</span>
    </div>
    <div class="c-card">
      <span class="c-card__num">2</span>
      <div class="c-card__imgWrap">
        <img src="{{ asset('img/card02@4x.jpg') }}" alt="howto" class="c-card__img c-card__img--numList">
      </div>
      <span class="c-card__txt">挑戦するステップを選ぶ</span>
    </div>
    <div class="c-card">
      <span class="c-card__num">3</span>
      <div class="c-card__imgWrap">
        <img src="{{ asset('img/card03@4x.jpg') }}" alt="howto" class="c-card__img c-card__img--numList">
      </div>
      <span class="c-card__txt">1つずつステップをクリア</span>
    </div>
    <div class="c-card">
      <span class="c-card__num">4</span>
      <div class="c-card__imgWrap">
        <img src="{{ asset('img/card04@4x.jpg') }}" alt="howto" class="c-card__img c-card__img--numList">
      </div>
      <span class="c-card__txt">全ステップ達成を目指そう！</span>
    </div>
  </div>
</section>
@endsection

@section('footer')
@parent
@endsection
