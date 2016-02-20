<div id="page-wrapper">
  <div class="row">
    <div class="col-xs-12">
      <h1 class="page-header"><?php i18n_echo(array(
        'en' => 'Product',
        'zh' => '产品',
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
          
<form class="form-horizontal" role="form" method="POST" action="<?php echo uri('admin/product/edit/' . $object->getId()) ?>">
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='title'>title <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['title']) ? strip_tags($_POST['title']) : '') : $object->getTitle()))) ?>' type='text' class='form-control' id='title' name='title' required />
  </div>
</div>
<div class='hr-line-dashed'></div>
  
    <div class="form-group">
      <label for="thumbnail" class="col-sm-2 control-label">thumbnail </label>
      <div class="col-sm-10">
        <textarea name="thumbnail" id="thumbnail" rows="5" class="form-control"><?php echo isset($_POST["thumbnail"]) ? htmlentities($_POST["thumbnail"]) : htmlentities($object->getThumbnail()); ?></textarea>

        <div id="thumbnail_uploader" class="uploader" style="display: none;">
            <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
        </div>

      </div>
    </div>
    <div class="hr-line-dashed"></div>

  
<!-- js code for #thumbnail_uploader -->
<script type="text/javascript">
$(function() {
  /** define var **/
  var max_file_number = 1;
  
  /** build file list from textarea **/
  textareaToFilelist($('#thumbnail'), max_file_number);
  
  /** bind file delete action **/
  $('#thumbnail').parents('.form-group').first().on('click', '.delete', function(){
    $(this).prop('disabled', true);
    var filelist = $(this).parents('.file-container').first();
    $.post('/modules/product/controllers/backend/product_form_field_thumbnail_remove.php', {
      fid: $(this).parents('li').first().attr('id'),
      furi: $(this).data('furi')
    }, function(data){
      if (data.error !== undefined) {
        alert("删除文件失败。错误："+data.error);
      }
      
      filelist = $('#'+data.fid).parents('.file-container');
      $('#'+data.fid).remove();
      filelistToTextarea(filelist, max_file_number);
    }, 'json');
    return false;
  });
  
  /** plupload Queue initialization **/
  
  $("#thumbnail_uploader").pluploadQueue({
      // General settings
      runtimes : 'html5,flash,silverlight,html4',
      url : "/modules/product/controllers/backend/product_form_field_thumbnail_upload.php",
      //chunk_size : '1mb',
      rename : false,
      dragdrop: true,

      filters : {
          max_file_size : '4mb',
          mime_types: [
              {title : "Allowed files", extensions : "jpg,jpeg,png,gif"}
          ]
      },
      flash_swf_url : '/libraries/plupload/js/Moxie.swf',
      silverlight_xap_url : '/libraries/plupload/js/Moxie.xap',
      unique_names : true, // generate an unique file name for the uploaded file and send it as an additional argument - name, to server handling script
      multiple_queues : true // Re-activate the widget after each upload procedure.
      ,multi_selection : true
  });
  var uploader = $('#thumbnail_uploader').pluploadQueue();

  // when upload complete
  uploader.bind('UploadComplete', function(uploader, files){
    // append plup file list to textarea
    while (files[0] !== undefined) {
      if (files[0].status == plupload.DONE) {
        var existing_content = jQuery.trim($('#thumbnail').val());
        var to_be_added = (existing_content == '' ? '' : "\n") + 'files/cache/' + files[0].target_name.toLowerCase();
        $('#thumbnail').val(existing_content + to_be_added);
      }
      // and remove it from plup file list
      uploader.removeFile(files[0]);
    }
    // refresh file list
    textareaToFilelist($('#thumbnail'), max_file_number);
  });

  // when file(s) added
  uploader.bind('FilesAdded', function(uploader, files){
    var content = jQuery.trim($('#thumbnail').val());
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
<!-- END OF js code for #thumbnail_uploader -->
  
    <div class="form-group">
      <label for="images" class="col-sm-2 control-label">images </label>
      <div class="col-sm-10">
        <textarea name="images" id="images" rows="5" class="form-control"><?php echo isset($_POST["images"]) ? htmlentities($_POST["images"]) : htmlentities($object->getImages()); ?></textarea>

        <div id="images_uploader" class="uploader" style="display: none;">
            <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
        </div>

      </div>
    </div>
    <div class="hr-line-dashed"></div>

  
<!-- js code for #images_uploader -->
<script type="text/javascript">
$(function() {
  /** define var **/
  var max_file_number = 8;
  
  /** build file list from textarea **/
  textareaToFilelist($('#images'), max_file_number);
  
  /** bind file delete action **/
  $('#images').parents('.form-group').first().on('click', '.delete', function(){
    $(this).prop('disabled', true);
    var filelist = $(this).parents('.file-container').first();
    $.post('/modules/product/controllers/backend/product_form_field_images_remove.php', {
      fid: $(this).parents('li').first().attr('id'),
      furi: $(this).data('furi')
    }, function(data){
      if (data.error !== undefined) {
        alert("删除文件失败。错误："+data.error);
      }
      
      filelist = $('#'+data.fid).parents('.file-container');
      $('#'+data.fid).remove();
      filelistToTextarea(filelist, max_file_number);
    }, 'json');
    return false;
  });
  
  /** plupload Queue initialization **/
  
  $("#images_uploader").pluploadQueue({
      // General settings
      runtimes : 'html5,flash,silverlight,html4',
      url : "/modules/product/controllers/backend/product_form_field_images_upload.php",
      //chunk_size : '1mb',
      rename : false,
      dragdrop: true,

      filters : {
          max_file_size : '4mb',
          mime_types: [
              {title : "Allowed files", extensions : "jpg,jpeg,png,gif"}
          ]
      },
      flash_swf_url : '/libraries/plupload/js/Moxie.swf',
      silverlight_xap_url : '/libraries/plupload/js/Moxie.xap',
      unique_names : true, // generate an unique file name for the uploaded file and send it as an additional argument - name, to server handling script
      multiple_queues : true // Re-activate the widget after each upload procedure.
      ,multi_selection : true
  });
  var uploader = $('#images_uploader').pluploadQueue();

  // when upload complete
  uploader.bind('UploadComplete', function(uploader, files){
    // append plup file list to textarea
    while (files[0] !== undefined) {
      if (files[0].status == plupload.DONE) {
        var existing_content = jQuery.trim($('#images').val());
        var to_be_added = (existing_content == '' ? '' : "\n") + 'files/cache/' + files[0].target_name.toLowerCase();
        $('#images').val(existing_content + to_be_added);
      }
      // and remove it from plup file list
      uploader.removeFile(files[0]);
    }
    // refresh file list
    textareaToFilelist($('#images'), max_file_number);
  });

  // when file(s) added
  uploader.bind('FilesAdded', function(uploader, files){
    var content = jQuery.trim($('#images').val());
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
<!-- END OF js code for #images_uploader -->
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='description'>description <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <textarea class='form-control' rows='5' id='description' name='description' required><?php echo ($object->isNew() ? (isset($_POST['description']) ? htmlentities($_POST['description']) : '') : htmlentities($object->getDescription())) ?></textarea>
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='price'>price <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['price']) ? strip_tags($_POST['price']) : '') : $object->getPrice()))) ?>' type='text' class='form-control' id='price' name='price' required />
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='original_price'>original_price </label>
  <div class='col-sm-10'>
    <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['original_price']) ? strip_tags($_POST['original_price']) : '') : $object->getOriginalPrice()))) ?>' type='text' class='form-control' id='original_price' name='original_price' />
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='stock'>stock </label>
  <div class='col-sm-10'>
    <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['stock']) ? strip_tags($_POST['stock']) : '') : $object->getStock()))) ?>' type='text' class='form-control' id='stock' name='stock' />
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label'>
    onshelf
  </label>
  <div class='col-sm-10'>
    <input type='checkbox' <?php echo ($object->isNew() ? (isset($_POST['onshelf']) ? ($_POST['onshelf'] ? 'checked="checked"' : '') : '') : ($object->getOnshelf() ? "checked='checked'" : "")) ?> id='onshelf' name='onshelf' value='1' />
  </div>
</div>
<div class='hr-line-dashed'></div>

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

