$(function() {

$yt_img = $(".view-youtube-videos img");
$iframe = $('<div class="video"><iframe id="yt"></iframe></div>');
$iframe.appendTo(".player");

$yt_img.click(function(){
  $yt_src = $(this).attr("name");
  $('.video iframe').attr("src", $yt_src);
  $(".video").slideDown();
});






});
