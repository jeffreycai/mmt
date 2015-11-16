$(function() {
  /** backend menu effect **/
  $('#side-menu').metisMenu();
  $('#inner-side-menu').metisMenu();

  /** CKEditor initialize **/
  if (typeof CKEDITOR != 'undefined' && $('.ckeditor').length) {
    for (i = 0; i < $('.ckeditor').length; i++) {
      CKEDITOR.replace($('.ckeditor').get(i));
    }
  }
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
$(function() {
    $(window).bind("load resize", function() {
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.sidebar-collapse').addClass('collapse')
        } else {
            $('div.sidebar-collapse').removeClass('collapse')
        }
    })
})

// funciton to ask for confirm
function ask(question) {
  var answer = confirm(question);
  if (answer) {
    return true;
  }
  return false;
}

function goback() {
  window.history.back();
  return false;
}

// function to dynamicly load css
function loadCSS(filename) {

  var file = document.createElement("link")
  file.setAttribute("rel", "stylesheet")
  file.setAttribute("type", "text/css")
  file.setAttribute("href", filename)

  if (typeof file !== "undefined")
    document.head.appendChild(file)
}


function htmlEntities(str) {
  return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}