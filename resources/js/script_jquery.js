// jQuery
import $ from 'jquery';

// ハンバーガーメニュー
$(function () {
  const $btn = $(".js_toggle_btn");
  const $nav = $(".js_slide_nav");

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
