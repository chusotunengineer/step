<!DOCTYPE HTML>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>STEP | @yield('title', 'STEP')</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Raleway&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,600">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <!-- Favicon -->
  <link rel="apple-touch-icon" type="image/png" href="{{asset('/apple-touch-icon-180x180.png')}}">
  <link rel="icon" type="image/png" href="{{asset('/icon-192x192.png')}}">
</head>

<body>
  <header class="l-header">
    <div class="l-header__content">
      <h1 class="l-header__logo">
        <a href="{{ route('top') }}">
          <img src="{{ asset('img/logo@3x.png') }}" alt="STEP" class="p-logo">
        </a>
      </h1>
      <div class="l-header__nav">
        <nav class="p-nav">
          <ul class="p-nav__list">
            <li class="p-nav__item u-none__mobile--xl">
              <a href="{{ route('index') }}">みんなのステップを見る</a>
            </li>
            @auth
            <li class="p-nav__item u-none__mobile--xl">
              <a href="{{ route('logout') }}">ログアウト</a>
            </li>
            <li class="p-nav__item u-none__mobile--xl">
              <button class="c-button c-button--default" onclick="location.href='{{ route('mypage') }}'">
                マイページ
              </button>
            </li>
            @endauth
            @if(auth()->guest())
            <li class="p-nav__item u-none__mobile--xl">
              <a href="{{ route('login') }}">ログイン</a>
            </li>
            <li class="p-nav__item u-none__mobile--xl">
              <button class="c-button c-button--default" onclick="location.href='{{ route('register') }}'">
                無料会員登録
              </button>
            </li>
            @endif
            <li>
              <div class="js-toggle_btn c-hamburger u-none__pc--xl">
                <span class="c-hamburger__line"></span>
                <span class="c-hamburger__line"></span>
                <span class="c-hamburger__line"></span>
              </div>
            </li>
          </ul>
          <ul class="js-slide_nav c-hamburger__nav u-none__pc--xl">
            @auth
            <li class="p-nav__item">
              <a href="{{ route('logout') }}">ログアウト</a>
            </li>
            <li class="p-nav__item">
              <a class="p-sidebar__txt" href="{{ route('mypage') }}">マイページ</a>
            </li>
            <li class="p-sidebar__item">
              <a class="p-sidebar__txt" href="{{ route('new') }}">ステップ登録</a>
            </li>
            <li class="p-sidebar__item">
              <a class="p-sidebar__txt" href="{{ route('choice') }}">ステップ編集</a>
            </li>
            <li class="p-sidebar__item">
              <a class="p-sidebar__txt" href="{{ route('profEdit') }}">プロフィール登録・編集</a>
            </li>
            @endauth
            @if(auth()->guest())
            <li class="p-nav__item">
              <a href="{{ route('login') }}">ログイン</a>
            </li>
            <li class="p-nav__item">
              <a class="p-sidebar__txt" href="{{ route('register') }}">無料会員登録</a>
            </li>
            @endif
            <li class="p-nav__item">
              <a href="{{ route('index') }}">みんなのステップを見る</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
  <div id="app">
    @yield('content')
  </div>
  @section('footer')
  <footer class="js-footer_fixed l-footer">
    <div class="l-footer__content">
      <img src="{{ asset('img/logo--white@3x.png') }}" alt="STEP" class="p-logo p-logo__footer">
      <div class="l-footer__nav">
        <nav class="p-nav">
          <ul class="p-nav__list">
            <li class="p-nav__item p-nav__item--white"><a href="{{ route('index') }}">みんなのステップを見る</a></li>
            @auth
            <li class="p-nav__item p-nav__item--white"><a href="{{ route('logout') }}">ログアウト</a></li>
            <li class="p-nav__item p-nav__item--white"><a href="{{ route('mypage') }}">マイページ</a></li>
            @endauth
            @if(auth()->guest())
            <li class="p-nav__item p-nav__item--white"><a href="{{ route('login') }}">ログイン</a></li>
            <li class="p-nav__item p-nav__item--white"><a href="{{ route('register') }}">新規会員登録</a></li>
            @endif
          </ul>
        </nav>
      </div>
    </div>
  </footer>
  <script src="{{ asset('js/app.js') }}"></script>
  @show
</body>

</html>
