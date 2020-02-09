// jQuery
import $ from 'jquery';

// ハンバーガーメニュー
$(function () {
  const $btn = $(".js-toggle_btn");
  const $nav = $(".js-slide_nav");

  // $btnがクリックされたら.activeをつけ外しする
  $btn.on("click", function () {
    $(this).toggleClass("active");
    $nav.toggleClass("active");
  });

  // $navがクリックされたら.activeを外す
  $nav.on("click", function () {
    $btn.removeClass("active");
    $nav.removeClass("active");
  });
});

// パスワードリマインダーのメール送信時メッセージ
$(function () {
  const $flash = $('.js-fadeout');
  // $flashが存在した場合、$flashを3秒表示した後に0.4秒かけて画面外へ移動させる
  if ($flash[0]) {
    setTimeout(function () {
      $flash.css({
        transform: 'translateY(-100%)',
        transition: 'transform 0.4s'
      });
    }, 3000);
  }
});
