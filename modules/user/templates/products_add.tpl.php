
  <div class="row body">
    <div class="col-xs-12">
      <?php echo Message::renderMessages() ?>
    </div>
    
    <div class="col-xs-12">

<form class="form-horizontal" role="form" method="POST" action="<?php echo uri('user/products/add') ?>">
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='title'><?php echo i18n(array(
      'en' => 'Product title',
      'zh' => '商品标题'
  )) ?> <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['title']) ? strip_tags($_POST['title']) : '') : $object->getTitle()))) ?>' type='text' class='form-control' id='title' name='title' required placeholder="<?php echo i18n(array(
        'en' => 'Please enter product title',
        'zh' => '请输入商品标题'
    )) ?>" />
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='description'><?php echo i18n(array(
      'en' => 'Product description',
      'zh' => '商品描述'
  )) ?> <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <textarea class='form-control' rows='5' id='description' name='description' required placeholder="<?php echo i18n(array(
        'en' => 'Please enter product description',
        'zh' => '请输入商品描述'
    )) ?>"><?php echo ($object->isNew() ? (isset($_POST['description']) ? htmlentities($_POST['description']) : '') : htmlentities($object->getDescription())) ?></textarea>
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='price'><?php echo i18n(array(
      'en' => 'Product price',
      'zh' => '商品价格'
  )) ?> <span style="color: rgb(185,2,0); font-weight: bold;">*</span></label>
  <div class='col-sm-10'>
    <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['price']) ? strip_tags($_POST['price']) : '') : $object->getPrice()))) ?>' type='text' class='form-control' id='price' name='price' required placeholder="<?php echo i18n(array(
        'en' => 'Please enter product price. e.g.  23.4',
        'zh' => '请输入商品价格。 例如： 23.4'
    )) ?>" />
  </div>
</div>
<div class='hr-line-dashed'></div>


    <div class="form-group">
      <label for="thumbnail" class="col-sm-2 control-label"><?php echo i18n(array(
          'en' => 'Product images',
          'zh' => '商品图片'
      )) ?> </label>
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
  var max_file_number = 8;
  
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
      url : "/modules/user/controllers/product_form_field_thumbnail_upload.php",
      chunk_size : '1mb',
      rename : false,
      dragdrop: true,

      filters : {
          max_file_size : '4mb',
          mime_types: [
              {title : "Allowed files", extensions : "jpg,png,gif"}
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


  <input class="hide" type="submit" name="submit" value="<?php i18n_echo(array(
      'en' => 'Create', 
      'zh' => '创建'
  )) ?>" class="btn btn-default">
</form>
      
    </div>
  </div>




<script type="text/javascript">
  jQuery(function(){
    $(".addFormSubmit").click(function(){
      $(".body form input[type=submit]").click();
    });
  });
</script>