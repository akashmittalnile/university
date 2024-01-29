$(".login-btn").click(function(){
    $(this).toggleClass("toggled");
    $(".login-panel").toggleClass("open");
  });
  
  CKEDITOR.replace("post_text", {
    language: "en",
    uiColor: "#dddddd",
    height: 500,
    resize_dir: 'vertical'
  });