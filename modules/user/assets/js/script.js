jQuery(function(){
  /** product click area **/
  $('.product .upper').click(function(event){
    event.stopPropagation();
    event.preventDefault();
    var href = $('.title a', this).attr('href');
    window.location.href = href;
  });
  
  /** header nav form submit link action **/
  jQuery(function(){
    $(".addFormSubmit").click(function(){
      $(".body form input[type=submit]").click();
      return false;
    });
  });
});