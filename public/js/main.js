


$('.vert').mCustomScrollbar({
theme:"rounded",

callbacks:{
  onScrollStart:function(){
  $('.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar').addClass('active');
  },
  
onScroll:function(){
  $('.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar').removeClass('active');
  }
  }
});

$('.upss-aroww').click(function(event) {
event.preventDefault(event);
console.log('top');
  $('.vert').mCustomScrollbar("scrollTo","+=100",{scrollInertia:600, scrollEasing:"linear"});
});
$('.dowm-aroww').click(function(event) {
event.preventDefault(event);

  
console.log('bottom');
  $('.vert').mCustomScrollbar("scrollTo","-=100",{scrollInertia:600, scrollEasing:"linear"});
});