<div id="page-wrapper">
  <div class="row">
    <div class="col-xs-12">
      <h1 class="page-header"><?php i18n_echo(array(
        'en' => 'Shop settings',
        'zh' => '微店设置',
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
          
<form class="form-horizontal" role="form" method="POST" action="<?php echo uri('admin/shopsettings/edit/' . $object->getId()) ?>">
  
    <div class="form-group">
      <label for="shop_logo" class="col-sm-2 control-label">shop_logo </label>
      <div class="col-sm-10">
        <textarea name="shop_logo" id="shop_logo" rows="5" class="form-control"><?php echo isset($_POST["shop_logo"]) ? htmlentities($_POST["shop_logo"]) : htmlentities($object->getShopLogo()); ?></textarea>

        <div id="shop_logo_uploader" class="uploader" style="display: none;">
            <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
        </div>

      </div>
    </div>
    <div class="hr-line-dashed"></div>

  
<!-- js code for #shop_logo_uploader -->
<script type="text/javascript">
$(function() {
  /** define var **/
  var max_file_number = 1;
  
  /** build file list from textarea **/
  textareaToFilelist($('#shop_logo'), max_file_number);
  
  /** bind file delete action **/
  $('#shop_logo').parents('.form-group').first().on('click', '.delete', function(){
    $(this).prop('disabled', true);
    var filelist = $(this).parents('.file-container').first();
    $.post('/modules/shopsettings/controllers/backend/shopsettings_form_field_shop_logo_remove.php', {
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
  
  $("#shop_logo_uploader").pluploadQueue({
      // General settings
      runtimes : 'html5,flash,silverlight,html4',
      url : "/modules/shopsettings/controllers/backend/shopsettings_form_field_shop_logo_upload.php",
      //chunk_size : '1mb',
      rename : false,
      dragdrop: true,

      filters : {
          max_file_size : '4mb',
          mime_types: [
              {title : "Allowed files", extensions : "jpg,png,gif,jpeg"}
          ]
      },
      flash_swf_url : '/libraries/plupload/js/Moxie.swf',
      silverlight_xap_url : '/libraries/plupload/js/Moxie.xap',
      unique_names : true, // generate an unique file name for the uploaded file and send it as an additional argument - name, to server handling script
      multiple_queues : true // Re-activate the widget after each upload procedure.
      ,multi_selection : true
  });
  var uploader = $('#shop_logo_uploader').pluploadQueue();

  // when upload complete
  uploader.bind('UploadComplete', function(uploader, files){
    // append plup file list to textarea
    while (files[0] !== undefined) {
      if (files[0].status == plupload.DONE) {
        var existing_content = jQuery.trim($('#shop_logo').val());
        var to_be_added = (existing_content == '' ? '' : "\n") + 'files/cache/' + files[0].target_name.toLowerCase();
        $('#shop_logo').val(existing_content + to_be_added);
      }
      // and remove it from plup file list
      uploader.removeFile(files[0]);
    }
    // refresh file list
    textareaToFilelist($('#shop_logo'), max_file_number);
  });

  // when file(s) added
  uploader.bind('FilesAdded', function(uploader, files){
    var content = jQuery.trim($('#shop_logo').val());
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
<!-- END OF js code for #shop_logo_uploader -->
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='shop_wechat'>shop_wechat </label>
  <div class='col-sm-10'>
    <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['shop_wechat']) ? strip_tags($_POST['shop_wechat']) : '') : $object->getShopWechat()))) ?>' type='text' class='form-control' id='shop_wechat' name='shop_wechat' />
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='shop_phone'>shop_phone </label>
  <div class='col-sm-10'>
    <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['shop_phone']) ? strip_tags($_POST['shop_phone']) : '') : $object->getShopPhone()))) ?>' type='text' class='form-control' id='shop_phone' name='shop_phone' />
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='shop_address'>shop_address </label>
  <div class='col-sm-10'>
    <textarea class='form-control' rows='5' id='shop_address' name='shop_address'><?php echo ($object->isNew() ? (isset($_POST['shop_address']) ? htmlentities($_POST['shop_address']) : '') : htmlentities($object->getShopAddress())) ?></textarea>
  </div>
</div>
<div class='hr-line-dashed'></div>
  
<div class='form-group'>
  <label class='col-sm-2 control-label' for='shop_email'>shop_email </label>
  <div class='col-sm-10'>
    <input value='<?php echo htmlentities(str_replace('\'', '"', ($object->isNew() ? (isset($_POST['shop_email']) ? strip_tags($_POST['shop_email']) : '') : $object->getShopEmail()))) ?>' type='text' class='form-control' id='shop_email' name='shop_email' />
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

