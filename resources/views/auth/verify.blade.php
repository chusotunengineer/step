@extends('layouts.app')

@section('title', 'email認証')

@section('content')
@if (session('resent'))
<div class="alert alert-success" role="alert">
  確認用のURLをご入力いただいたメールアドレス宛に送信しました
</div>
@endif
<div class="c-bread">
  <div class="c-bread__content">
    <a href="{{ route('top') }}" class="c-bread__txt">HOME</a>
    <span class="c-bread__arrow">&gt;</span>
    <span class="c-bread__txt">会員登録</span>
  </div>
</div>
<section class="l-sec">
  <h2 class="c-title">
    メールアドレスの確認
  </h2>
  <div class="p-verify">
    <p class="p-verify__txt u-mb_s">
      ご入力いただいたメールアドレスに送信されたSTEPからのメールをご確認ください。<br>
      もし届いていない場合はメールアドレスを間違って入力されたか、迷惑メールとして分類されている可能性があります。<br>
    </p>
    <a class="c-button c-button--wide u-mx_auto" href="{{ route('verification.resend') }}">メールを再送信する</a>
  </div>
</section>

@endsection

@section('footer')
@parent
@endsection
