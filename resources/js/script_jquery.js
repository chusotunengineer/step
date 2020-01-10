// jQuery
import $ from 'jquery';

// フォームの二重送信防止
$(function () {
  $('form').on('submit', function () {
    $('#js_btn_click_hide').hide();
    $('#js_btn_click_show').show();

    // 10秒後に元に戻す
    setTimeout(function () {
      $('#js_btn_click_hide').show();
      $('#js_btn_click_show').hide();
    }, 10000);
  });
});

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
