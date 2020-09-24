// メニューバー表示用（スマホ）
$(function() {
  $(".nav_control").click(function() {
    $(".menuBar").toggleClass("active");
    if($(".menuBar").hasClass("active")) {
      $(".bg").css("display", "block");
    } else {
      $(".bg").css("display", "none");
    }
  });
  // 背景押してもメニュー非表示にする
  $(".bg").click(function() {
    if($(".menuBar").hasClass("active")) {
      $(".menuBar").toggleClass("active");
      $(".bg").css("display", "none");
    }
  });

  //「過去の投稿」矢印アイコン制御
  addExpandCollapse(
		'newCollapsArchWidget',
		'<div class="expand_indicator"></div>',
		'<div class="collapse_indicator"></div>',
		1
	); // id, expandSym, collapseSym, accordion
});
