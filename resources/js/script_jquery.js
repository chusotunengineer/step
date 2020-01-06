// jQuery
import $ from 'jquery';

// ページ全体の高さがウィンドウサイズより小さかったら、フッターを画面下に固定する関数を定義
function judgeBodyHeight() {
  if ($('body').height() < $(window).height()) {
    $('.js-footer_fixed').css({
      "position": "fixed",
      "left": 0,
      "right": 0,
      "bottom": 0,
    })
  } else {
    $('.js-footer_fixed').css('position', 'static')
  }
}

// DOMが生成されたらjudgeBodyHeightを実行
$(function () {
  judgeBodyHeight()
})

// DOMが変更されたらjudgeBodyHeightを実行
const target = document.getElementById('app');
const observer = new MutationObserver(records => {
  judgeBodyHeight()
})
observer.observe(target, {
  childList: true
})

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
