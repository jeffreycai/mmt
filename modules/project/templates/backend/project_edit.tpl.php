<div id="page-wrapper">
  <div class="row">
    <div class="col-xs-12">
      <h1 class="page-header"><?php i18n_echo(array(
        'en' => 'Project',
        'zh' => '项目',
      )); ?></h1>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading"><?php i18n_echo(array(
            'en' => 'Edit', 
            'zh' => '编辑'
        )) ?></div>
        <div class="panel-body">
          
        <?php echo Message::renderMessages(); ?>
          
<form class="form-horizontal" role="form" method="POST" action="<?php echo uri('admin/project/edit/' . $object->getId()) ?>">
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='title'>title <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['title']) ? strip_tags($_POST['title']) : '') : $object->getTitle()))) ?>' type='text' class='form-control' id='title' name='title' required size=150 />
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='password'>password <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <input type='password' class='form-control' id='password' name='password' required size=15 />
  </div>
</div>
<div class='form-group'>
  <label class='col-sm-2 control-label' for='retype_password'><?php echo i18n(array('en' => 'Retype', 'zh' => '再输一次')) ?> password <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <input type='password' class='form-control' id='retype_password' name='retype_password' required size=15 />
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='email'>email <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['email']) ? strip_tags($_POST['email']) : '') : $object->getEmail()))) ?>' type='email' class='form-control' id='email' name='email' required size=30 />
  </div>
</div>
<div class='form-group'>
  <label class='col-sm-2 control-label' for='retype_email'><?php echo i18n(array('en' => 'Retype', 'zh' => '再输一次')) ?> email <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <input value='<?php echo htmlentities(str_replace('\'', '"', (isset($_POST['retype_email']) ? strip_tags($_POST['retype_email']) : ''))) ?>' type='email' class='form-control' id='retype_email' name='retype_email' required size=30 />
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='description_en'>description_en </label>
  <div class='col-sm-10'>
    <textarea class='form-control' rows='5' id='description_en' name='description_en'><?php echo ($object->isNew() ? (isset($_POST['description_en']) ? htmlentities($_POST['description_en']) : '') : htmlentities($object->getDescriptionEn())) ?></textarea>
  </div>
</div>
<div class='hr-line-dashed'></div>

<script type='text/javascript' src='/libraries/ckeditor/ckeditor.js'></script>
<script type='text/javascript'>CKEDITOR.replace('description_en', {
  toolbar: [
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
    { name: 'links', items: [ 'Link', 'Unlink' ] },
    { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Iframe' ] },
    '/',
    { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
    { name: 'colors', items: [ 'TextColor' ] },
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    { name: 'tools', items: [ 'Maximize' ] }
  ]
}
);</script>  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='description_zh'>description_zh <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <textarea class='form-control' rows='5' id='description_zh' name='description_zh' required><?php echo ($object->isNew() ? (isset($_POST['description_zh']) ? htmlentities($_POST['description_zh']) : '') : htmlentities($object->getDescriptionZh())) ?></textarea>
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label'>
    active
  </label>
  <div class='col-sm-10'>
    <input type='checkbox' <?php echo ($object->isNew() ? (isset($_POST['active']) ? ($_POST['active'] ? 'checked="checked"' : '') : '') : ($object->getActive() ? "checked='checked'" : "")) ?> id='active' name='active' value='1' />
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label'>price </label>
  <div class='col-sm-10'>
    <select class='form-control' id='price' name='price'>
      <option value='0' <?php echo ($object->isNew() ? (isset($_POST['price']) ? ($_POST['price'] == '0' ? 'selected="selected"' : '') : '') : ($object->getPrice() == "0" ? "selected='selected'" : "")) ?>>-- Select --</option>
      <option value='34' <?php echo ($object->isNew() ? (isset($_POST['price']) ? ($_POST['price'] == '34' ? 'selected="selected"' : '') : '') : ($object->getPrice() == "34" ? "selected='selected'" : "")) ?>>$34</option>
      <option value='45' <?php echo ($object->isNew() ? (isset($_POST['price']) ? ($_POST['price'] == '45' ? 'selected="selected"' : '') : '') : ($object->getPrice() == "45" ? "selected='selected'" : "")) ?>>$45</option>
    </select>
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group' id='images'>
  <label class='col-sm-2 control-label'>images </label>
  <div class='col-sm-10'>
    <textarea name='images' style='display: none;'></textarea>
    <div class='file-fields' style='border: 1px solid #999; padding: 6px;'></div>
  <button style='margin-top:6px;' class='add btn btn-primary btn-sm' type='button'><?php echo i18n(array('en' => 'Add image', 'zh' => '添加图片')) ?></button>
  </div>
</div>
<div class='hr-line-dashed'></div>

<?php
  // get json string of prepopulated image links
  $prepopulate = $object->isNew() ? '' : $object->getImages();
  if ($prepopulate != '') {
    $tokens = explode("\n", trim($prepopulate));
    $prepopulate = array();
    foreach ($tokens as $token) {
      $prepopulate[] = trim($token, "\n\r");
    }
  }
?>

<script>
  $(function(){
    var container = $('#images');

    $('.file-fields', container).sortable({
      update: function(event, ui) {updateHiddenTextarea(container);}
    });

    // initial value to pop
    var initial_images = <?php echo $prepopulate == '' ? '""' : json_encode($prepopulate); ?>;
    if (initial_images != '') {
      for (var i in initial_images) {
        img = initial_images[i];
        var html = addImageRow(img, false);
        $('.file-fields', container).append(html);
      }
    } else {
      var html = addImageRow(false, true);
      $('.file-fields', container).append(html);
    }

    updateHiddenTextarea(container);
    // action when click select file button
    $(document).on('click', '#images .select', function(){
      var tr = $(this).parents('.file-field');
      $('input[type=file]', tr).click();
      $('.upload', tr).prop('disabled', false);
    });
    // action when file filed is changed (we do validation here)
    $(document).on('change', '#images input[type=file]', function(){
      var tr = $(this).parents('.file-field');
      var file = this.files[0];
      if (!file.type.match(/^image/)) {
        alert('<?php echo i18n(array('en' => 'Upload file needs to be an image file', 'zh' => '上传文件需为图片文件')) ?>');
      } else if (file.size > (4 * 1000 * 1000)) {
        alert('<?php echo i18n(array('en' => 'File size should be less than', 'zh' => '文件大小应小于')) . ' 4MB' ?>');
      } else {
        var reader = new FileReader();
        reader.onload = (function(e){
          $('.preview', tr).html('<img src="'+e.target.result+'" style="height:150px;" />');
        });
        reader.readAsDataURL(this.files[0]);
      }
    });
    // action when adding an new image row
    $(document).on('click', '#images .add', function(){
      var html = addImageRow(false, true);
      $('.file-fields', container).append(html);
    });
    // action when uploading image via ajax
    $(document).on('click', '#images .upload', function(){
      var tr = $(this).parents('.file-field');
      var file_field = $('input[type=file]', tr);
      var file = file_field[0].files[0];

      var formData = new FormData();
      formData.append('file', file, file.name);
      $('.btn', tr).prop('disabled', true);
      $('.upload i', tr).removeClass('fa-upload').addClass('fa-spin').addClass('fa-spinner');
      $.ajax({
        url: '<?php echo uri("modules/project/controllers/backend/project_form_field_images.php" ,false) ?>',
        type: 'POST',
        data: formData,
        cache: false,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function(data, textStatus, jqXHR) {
          if (typeof(data.error) !== 'undefined') {
            alert('<?php echo i18n(array('en' => 'Error: ', 'zh' => '错误: ')) ?>' + data.error);
          } else {
            tr.html(addImageRow(data.uri, false));;
            $('.remove',tr).data('uri', data.uri);
            updateHiddenTextarea(container);
          }
          $('.btn', tr).prop('disabled', false);
          $('.upload i', tr).removeClass('fa-spin').removeClass('fa-spinner').addClass('fa-upload');
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('<?php echo i18n(array('en' => 'ajax error: ', 'zh' => 'ajax失败')) ?>: ' + textStatus);
          $('.btn', tr).prop('disabled', false);
          $('.upload i', tr).removeClass('fa-spin').removeClass('fa-spinner').addClass('fa-upload');
        }
      });
    });
    // action when removing an image
    $(document).on('click', '#images .remove', function(){
      var tr = $(this).parents('.file-field');
      if (typeof($(this).data('uri')) !== 'undefined') {
        var img = $(this).data('uri');
        $('.btn', tr).prop('disabled', true);
        $('.remove i', tr).addClass('fa-spin').addClass('fa-spinner').removeClass('fa-remove');
        // ajax to remove the image
        $.ajax({
          url: '<?php echo uri("modules/project/controllers/backend/project_form_field_images"."_remove.php" ,false) ?>?path=' + encodeURIComponent(img),
          type: 'POST',
          dataType: 'json',
          success: function(data, textStatus, jqXHR) {
            if (typeof(data.error) !== 'undefined') {
              alert('<?php echo i18n(array('en' => 'Error: ', 'zh' => '错误: ')) ?>' + data.error);
tr.fadeOut(function(){tr.remove();});
              updateHiddenTextarea(container);
            } else {
tr.fadeOut(function(){tr.remove();});
              updateHiddenTextarea(container);
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('<?php echo i18n(array('en' => 'ajax error: ', 'zh' => 'ajax失败')) ?>: ' + textStatus);
            $('.btn', tr).prop('disabled', false);
            $('.remove i', tr).removeClass('fa-spin').removeClass('fa-spinner').addClass('fa-remove');
            updateHiddenTextarea(container);  
          }
        });
      } else {
tr.fadeOut();
      }
    });

    // functions
    function addImageRow(img, isnew) {
      var img_html = img ? '<img src="/<?php echo get_sub_root() ?>'+img+'" style="height:150px;" />' : '<div style="height:150px;width:200px;background-color:#AAA;"></div>';
      var upload_button = isnew ? 
        '<button type="button" class="btn btn-default btn-sm upload" disabled><i class="fa fa-upload"></i></button>' :
        '<!-- <button type="button" class="btn btn-default btn-sm upload" disabled><i class="fa fa-upload"></i></button> -->';
      var select_button = isnew ?
        '<button type="button" class="btn btn-default btn-sm select"><i class="fa fa-file"></i></button>' :
        '<!-- <button type="button" class="btn btn-default btn-sm select"><i class="fa fa-file"></i></button> -->';
      var data_uri = isnew ? '' : 'data-uri="'+img+'"';
      return ('\n\
    <div class="file-field" style="margin-bottom:6px; position:relative;">\n\
      <div class="preview">'+img_html+'</div>\n\
      <div class="btn-group" style="position:absolute; bottom:5px; left:5px; " aria-label="...">\n\
        <input type="file" class="btn btn-default btn-sm" style="display:none;" />\n\
        '+select_button+'\n\
        '+upload_button+'\n\
        <button type="button" class="btn btn-default btn-sm remove" '+data_uri+'><i class="fa fa-remove"></i></button>\n\
      </div>\n\
    </div>');
    }

    function updateHiddenTextarea(container) {
      var html = '';
      $('.preview img', container).each(function(){
        var uri = $(this).attr('src');
        // remove subroot
        var subroot = '<?php echo get_sub_root() ?>';
        uri = uri.substr(subroot.length+1, uri.length-1);
        html = html + uri + "\n";
      });
      $('textarea', container).val(html);
    }
  });
</script>
  
<div class='form-group' id='thumbnail'>
  <label class='col-sm-2 control-label'>thumbnail <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <textarea name='thumbnail' style='display: none;'></textarea>
    <div class='file-fields'></div>

  </div>
</div>
<div class='hr-line-dashed'></div>

<?php
  // get json string of prepopulated image links
  $prepopulate = $object->isNew() ? '' : $object->getThumbnail();
  if ($prepopulate != '') {
    $tokens = explode("\n", trim($prepopulate));
    $prepopulate = array();
    foreach ($tokens as $token) {
      $prepopulate[] = trim($token, "\n\r");
    }
  }
?>

<script>
  $(function(){
    var container = $('#thumbnail');

    // initial value to pop
    var initial_images = <?php echo $prepopulate == '' ? '""' : json_encode($prepopulate); ?>;
    if (initial_images != '') {
      for (var i in initial_images) {
        img = initial_images[i];
        var html = addImageRow(img, false);
        $('.file-fields', container).append(html);
      }
    } else {
      var html = addImageRow(false, true);
      $('.file-fields', container).append(html);
    }

    updateHiddenTextarea(container);
    // action when click select file button
    $(document).on('click', '#thumbnail .select', function(){
      var tr = $(this).parents('.file-field');
      $('input[type=file]', tr).click();
      $('.upload', tr).prop('disabled', false);
    });
    // action when file filed is changed (we do validation here)
    $(document).on('change', '#thumbnail input[type=file]', function(){
      var tr = $(this).parents('.file-field');
      var file = this.files[0];
      if (!file.type.match(/^image/)) {
        alert('<?php echo i18n(array('en' => 'Upload file needs to be an image file', 'zh' => '上传文件需为图片文件')) ?>');
      } else if (file.size > (4 * 1000 * 1000)) {
        alert('<?php echo i18n(array('en' => 'File size should be less than', 'zh' => '文件大小应小于')) . ' 4MB' ?>');
      } else {
        var reader = new FileReader();
        reader.onload = (function(e){
          $('.preview', tr).html('<img src="'+e.target.result+'" style="height:150px;" />');
        });
        reader.readAsDataURL(this.files[0]);
      }
    });
    // action when adding an new image row
    $(document).on('click', '#thumbnail .add', function(){
      var html = addImageRow(false, true);
      $('.file-fields', container).append(html);
    });
    // action when uploading image via ajax
    $(document).on('click', '#thumbnail .upload', function(){
      var tr = $(this).parents('.file-field');
      var file_field = $('input[type=file]', tr);
      var file = file_field[0].files[0];

      var formData = new FormData();
      formData.append('file', file, file.name);
      $('.btn', tr).prop('disabled', true);
      $('.upload i', tr).removeClass('fa-upload').addClass('fa-spin').addClass('fa-spinner');
      $.ajax({
        url: '<?php echo uri("modules/project/controllers/backend/project_form_field_thumbnail.php" ,false) ?>',
        type: 'POST',
        data: formData,
        cache: false,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function(data, textStatus, jqXHR) {
          if (typeof(data.error) !== 'undefined') {
            alert('<?php echo i18n(array('en' => 'Error: ', 'zh' => '错误: ')) ?>' + data.error);
          } else {
            tr.html(addImageRow(data.uri, false));;
            $('.remove',tr).data('uri', data.uri);
            updateHiddenTextarea(container);
          }
          $('.btn', tr).prop('disabled', false);
          $('.upload i', tr).removeClass('fa-spin').removeClass('fa-spinner').addClass('fa-upload');
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('<?php echo i18n(array('en' => 'ajax error: ', 'zh' => 'ajax失败')) ?>: ' + textStatus);
          $('.btn', tr).prop('disabled', false);
          $('.upload i', tr).removeClass('fa-spin').removeClass('fa-spinner').addClass('fa-upload');
        }
      });
    });
    // action when removing an image
    $(document).on('click', '#thumbnail .remove', function(){
      var tr = $(this).parents('.file-field');
      if (typeof($(this).data('uri')) !== 'undefined') {
        var img = $(this).data('uri');
        $('.btn', tr).prop('disabled', true);
        $('.remove i', tr).addClass('fa-spin').addClass('fa-spinner').removeClass('fa-remove');
        // ajax to remove the image
        $.ajax({
          url: '<?php echo uri("modules/project/controllers/backend/project_form_field_thumbnail"."_remove.php" ,false) ?>?path=' + encodeURIComponent(img),
          type: 'POST',
          dataType: 'json',
          success: function(data, textStatus, jqXHR) {
            if (typeof(data.error) !== 'undefined') {
              alert('<?php echo i18n(array('en' => 'Error: ', 'zh' => '错误: ')) ?>' + data.error);
tr.html(addImageRow(false, true));
              updateHiddenTextarea(container);
            } else {
tr.html(addImageRow(false, true));
              updateHiddenTextarea(container);
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('<?php echo i18n(array('en' => 'ajax error: ', 'zh' => 'ajax失败')) ?>: ' + textStatus);
            $('.btn', tr).prop('disabled', false);
            $('.remove i', tr).removeClass('fa-spin').removeClass('fa-spinner').addClass('fa-remove');
            updateHiddenTextarea(container);  
          }
        });
      } else {

      }
    });

    // functions
    function addImageRow(img, isnew) {
      var img_html = img ? '<img src="/<?php echo get_sub_root() ?>'+img+'" style="height:150px;" />' : '<div style="height:150px;width:200px;background-color:#AAA;"></div>';
      var upload_button = isnew ? 
        '<button type="button" class="btn btn-default btn-sm upload" disabled><i class="fa fa-upload"></i></button>' :
        '<!-- <button type="button" class="btn btn-default btn-sm upload" disabled><i class="fa fa-upload"></i></button> -->';
      var select_button = isnew ?
        '<button type="button" class="btn btn-default btn-sm select"><i class="fa fa-file"></i></button>' :
        '<!-- <button type="button" class="btn btn-default btn-sm select"><i class="fa fa-file"></i></button> -->';
      var data_uri = isnew ? '' : 'data-uri="'+img+'"';
      return ('\n\
    <div class="file-field" style="margin-bottom:6px; position:relative;">\n\
      <div class="preview">'+img_html+'</div>\n\
      <div class="btn-group" style="position:absolute; bottom:5px; left:5px; " aria-label="...">\n\
        <input type="file" class="btn btn-default btn-sm" style="display:none;" />\n\
        '+select_button+'\n\
        '+upload_button+'\n\
        <button type="button" class="btn btn-default btn-sm remove" '+data_uri+'><i class="fa fa-remove"></i></button>\n\
      </div>\n\
    </div>');
    }

    function updateHiddenTextarea(container) {
      var html = '';
      $('.preview img', container).each(function(){
        var uri = $(this).attr('src');
        // remove subroot
        var subroot = '<?php echo get_sub_root() ?>';
        uri = uri.substr(subroot.length+1, uri.length-1);
        html = html + uri + "\n";
      });
      $('textarea', container).val(html);
    }
  });
</script>
  
<?php
  $prepopulate = ($object->isNew() ? (isset($_POST['date']) ? strip_tags($_POST['date']) : '') : $object->getDate() * 1000);
  $alt_prepopulate = $prepopulate;
  if (preg_match('/^\d+$/', $prepopulate)) {
    $alt_prepopulate = date('Y-m-d', $prepopulate/1000);
  }
?>

<div id='OQl24' class='form-group'>
  <label class='col-sm-2 control-label' for='date'>date <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <div class='input-group'>
      <span class='input-group-addon'><i class='fa fa-calendar'></i></span>
      <input disabled='disabled' value='<?php echo htmlentities(str_replace('\'', '"', $alt_prepopulate)) ?>' type='text' class='form-control altFormat'  required />
      <input value='<?php echo htmlentities(str_replace('\'', '"', $prepopulate)) ?>' type='text' id='date' name='date' class='datepicker form-control'  required  style='position: absolute; top:0; left: 0; z-index: -1' />
    </div>
  </div>
</div>
<div class='hr-line-dashed'></div>

    <script type='text/javascript'>
      $('#OQl24 .datepicker').datepicker({
        dateFormat: '@'
        ,altField: "#OQl24 .altFormat", altFormat: "yy-mm-dd"
        ,changeMonth: 1
        ,changeYear: 1
        ,yearRange: 'c-5:c+10'
      });
      $('#OQl24 .input-group-addon').css('cursor', 'pointer').on('click', function(){
        $('#OQl24 .datepicker').datepicker('show');
      });
    </script>
  
    <div class="form-group">
      <label for="attachment" class="col-sm-2 control-label">attachment <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
      <div class="col-sm-10">
        <textarea required="" name="attachment" id="attachment" rows="5" class="form-control"><?php echo isset($_POST["attachment"]) ? htmlentities($_POST["attachment"]) : htmlentities($object->getAttachment()); ?></textarea>

        <div id="attachment_uploader" class="uploader" style="display: none;">
            <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
        </div>

      </div>
    </div>
    <div class="hr-line-dashed"></div>

  
<!-- js code for #attachment_uploader -->
<script type="text/javascript">
$(function() {
  /** define var **/
  var max_file_number = 3;
  
  /** build file list from textarea **/
  textareaToFilelist($('#attachment'), max_file_number);
  
  /** bind file delete action **/
  $('#attachment').parents('.form-group').first().on('click', '.delete', function(){
    $(this).prop('disabled', true);
    var filelist = $(this).parents('.file-container').first();
    $.post('/modules/project/controllers/backend/project_form_field_attachment_remove.php', {
      fid: $(this).parents('li').first().attr('id'),
      furi: $(this).data('furi')
    }, function(data){
      if (data.error !== undefined) {
        alert("Failed to delete file. Error: "+data.error);
      }
      
      filelist = $('#'+data.fid).parents('.file-container');
      $('#'+data.fid).remove();
      filelistToTextarea(filelist, max_file_number);
    }, 'json');
    return false;
  });
  
  /** plupload Queue initialization **/
  
  $("#attachment_uploader").pluploadQueue({
      // General settings
      runtimes : 'html5,flash,silverlight,html4',
      url : "/modules/project/controllers/backend/project_form_field_attachment_upload.php",
      chunk_size : '1mb',
      rename : false,
      dragdrop: true,

      filters : {
          max_file_size : '4mb',
          mime_types: [
              {title : "Allowed files", extensions : "jpg,png,gif,zip"}
          ]
      },
      flash_swf_url : '/libraries/plupload/js/Moxie.swf',
      silverlight_xap_url : '/libraries/plupload/js/Moxie.xap',
      unique_names : true, // generate an unique file name for the uploaded file and send it as an additional argument - name, to server handling script
      multiple_queues : true // Re-activate the widget after each upload procedure.
      ,multi_selection : true
  });
  var uploader = $('#attachment_uploader').pluploadQueue();

  // when upload complete
  uploader.bind('UploadComplete', function(uploader, files){
    // append plup file list to textarea
    while (files[0] !== undefined) {
      if (files[0].status == plupload.DONE) {
        var existing_content = jQuery.trim($('#attachment').val());
        var to_be_added = (existing_content == '' ? '' : "\n") + 'files/cache/' + files[0].target_name.toLowerCase();
        $('#attachment').val(existing_content + to_be_added);
      }
      // and remove it from plup file list
      uploader.removeFile(files[0]);
    }
    // refresh file list
    textareaToFilelist($('#attachment'), max_file_number);
  });

  // when file(s) added
  uploader.bind('FilesAdded', function(uploader, files){
    var content = jQuery.trim($('#attachment').val());
    if (content == '') {
      var existing_files = [];
    } else {
      var existing_files = content.split("\n");
    }
    var added_files = uploader.files;
    if (existing_files.length + added_files.length > max_file_number) {
      alert('<?php echo i18n(array("en" => "Too many files selected. Max allowed upload limit is ","zh" => "您选择的文件过多了，最大允许的上传数为")) ?> ' + max_file_number + ' <?php echo i18n(array("en" => "files", "zh" => "")); ?>.' + ' <?php echo i18n(array("en" => "Only ", "zh" => "您上传的文件仅有")) ?>' + (max_file_number - existing_files.length) + ' <?php echo i18n(array("en" => "of your selected files are accepted", "zh" => "个文件被接受")) ?>.');
      for (i=uploader.files.length-1; i>(max_file_number - existing_files.length - 1); i--) {
        uploader.removeFile(uploader.files[i]);
      }
    }
  });

});
</script>
<!-- END OF js code for #attachment_uploader -->
  
    <div class="form-group">
      <label for="application" class="col-sm-2 control-label">application <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
      <div class="col-sm-10">
        <textarea required="" name="application" id="application" rows="5" class="form-control"><?php echo isset($_POST["application"]) ? htmlentities($_POST["application"]) : htmlentities($object->getApplication()); ?></textarea>

        <div id="application_uploader" class="uploader" style="display: none;">
            <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
        </div>

      </div>
    </div>
    <div class="hr-line-dashed"></div>

  
<!-- js code for #application_uploader -->
<script type="text/javascript">
$(function() {
  /** define var **/
  var max_file_number = 1;
  
  /** build file list from textarea **/
  textareaToFilelist($('#application'), max_file_number);
  
  /** bind file delete action **/
  $('#application').parents('.form-group').first().on('click', '.delete', function(){
    $(this).prop('disabled', true);
    var filelist = $(this).parents('.file-container').first();
    $.post('/modules/project/controllers/backend/project_form_field_application_remove.php', {
      fid: $(this).parents('li').first().attr('id'),
      furi: $(this).data('furi')
    }, function(data){
      if (data.error !== undefined) {
        alert("Failed to delete file. Error: "+data.error);
      }
      
      filelist = $('#'+data.fid).parents('.file-container');
      $('#'+data.fid).remove();
      filelistToTextarea(filelist, max_file_number);
    }, 'json');
    return false;
  });
  
  /** plupload Queue initialization **/
  
  $("#application_uploader").pluploadQueue({
      // General settings
      runtimes : 'html5,flash,silverlight,html4',
      url : "/modules/project/controllers/backend/project_form_field_application_upload.php",
      chunk_size : '1mb',
      rename : false,
      dragdrop: true,

      filters : {
          max_file_size : '4mb',
          mime_types: [
              {title : "Allowed files", extensions : "jpg,png,gif,zip"}
          ]
      },
      flash_swf_url : '/libraries/plupload/js/Moxie.swf',
      silverlight_xap_url : '/libraries/plupload/js/Moxie.xap',
      unique_names : true, // generate an unique file name for the uploaded file and send it as an additional argument - name, to server handling script
      multiple_queues : true // Re-activate the widget after each upload procedure.
      ,multi_selection : true
  });
  var uploader = $('#application_uploader').pluploadQueue();

  // when upload complete
  uploader.bind('UploadComplete', function(uploader, files){
    // append plup file list to textarea
    while (files[0] !== undefined) {
      if (files[0].status == plupload.DONE) {
        var existing_content = jQuery.trim($('#application').val());
        var to_be_added = (existing_content == '' ? '' : "\n") + 'files/cache/' + files[0].target_name.toLowerCase();
        $('#application').val(existing_content + to_be_added);
      }
      // and remove it from plup file list
      uploader.removeFile(files[0]);
    }
    // refresh file list
    textareaToFilelist($('#application'), max_file_number);
  });

  // when file(s) added
  uploader.bind('FilesAdded', function(uploader, files){
    var content = jQuery.trim($('#application').val());
    if (content == '') {
      var existing_files = [];
    } else {
      var existing_files = content.split("\n");
    }
    var added_files = uploader.files;
    if (existing_files.length + added_files.length > max_file_number) {
      alert('<?php echo i18n(array("en" => "Too many files selected. Max allowed upload limit is ","zh" => "您选择的文件过多了，最大允许的上传数为")) ?> ' + max_file_number + ' <?php echo i18n(array("en" => "files", "zh" => "")); ?>.' + ' <?php echo i18n(array("en" => "Only ", "zh" => "您上传的文件仅有")) ?>' + (max_file_number - existing_files.length) + ' <?php echo i18n(array("en" => "of your selected files are accepted", "zh" => "个文件被接受")) ?>.');
      for (i=uploader.files.length-1; i>(max_file_number - existing_files.length - 1); i--) {
        uploader.removeFile(uploader.files[i]);
      }
    }
  });

});
</script>
<!-- END OF js code for #application_uploader -->

  <input type="submit" name="submit" value="<?php i18n_echo(array(
      'en' => 'Edit', 
      'zh' => '编辑'
  )) ?>" class="btn btn-default">
</form>
          
        </div>
      </div>
    </div>
  </div>
</div>

