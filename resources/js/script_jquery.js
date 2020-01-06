// jQuery
import $ from 'jquery';

// ハンバーガーメニュー
$(function () {
  var $btn = $(".js_toggle_btn");
  var $nav = $(".js_slide_nav");

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
