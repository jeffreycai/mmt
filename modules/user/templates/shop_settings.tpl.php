<div class="body">
  <div class="row section">
    <form action="<?php echo uri('user/shop/settings') ?>" method="POST">
    <div class="col-xs-12">
      <br />
      
      <?php echo Message::renderMessages(); ?>
      
      
        <div class="form-group">
          <label for="name" class="control-label"><?php echo i18n(array(
            'en' => 'Shop name',
            'zh' => '微店名称'
          )) ?> <span style="color:red">*</span></label>
          <input type="text" name="name" id="thumbnail" required class="form-control" placeholder="<?php echo i18n(array(
            'en' => 'Your shop\'s name that is shown to public',
            'zh' => '买家看到的微店名称'
          )) ?>" value="<?php echo (isset($_POST['name']) ? $_POST['name'] : ($settings ? $settings->getShopName() : '')) ?>" />
        </div>
        <div class="form-group">
          <label for="introduction" class="control-label"><?php echo i18n(array(
            'en' => 'Shop introduction',
            'zh' => '微店简介'
          )) ?></label>
          <textarea name="introduction" id="introduction" class="form-control" placeholder="<?php echo i18n(array(
            'en' => 'Your shop\'s introduction that is shown to public',
            'zh' => '买家看到的微店简介'
          )) ?>" rows="10"><?php echo (isset($_POST['introduction']) ? htmlentities($_POST['introduction']) : (($settings && !empty(trim($settings->getShopIntroduction()))) ? htmlentities($settings->getShopIntroduction()) : '')) ?></textarea>
        </div>
        <div class="form-group">
          <label for="shop_logo" class="control-label"><?php echo i18n(array(
              'en' => 'Shop logo',
              'zh' => '微店logo'
          )); ?><small>&nbsp;&nbsp;(建议上传图片尺寸350x350)</small></label>
          <textarea name="shop_logo" id="shop_logo" rows="5" class="form-control"><?php echo isset($_POST["shop_logo"]) ? htmlentities($_POST["shop_logo"]) : htmlentities($settings->getShopLogo()); ?></textarea>
          <div id="shop_logo_uploader" class="uploader" style="display: none;">
              <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
          </div>
        </div>
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
    $.post("<?php echo uri('modules/user/controllers/shopsettings_form_field_shop_logo_remove.php', false) ?>", {
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
      url : "<?php echo uri('modules/user/controllers/shopsettings_form_field_shop_logo_upload.php', false); ?>",
//      chunk_size : '1mb',
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
    </div>
    
    <div class="col-xs-12">
      <input class="btn btn-success" style="float: right; margin-bottom: 20px;" type="submit" name="submit" value="<?php echo i18n(array(
        'en' => 'Submit',
        'zh' => '提交'
      )) ?>" />
      <div class="clearfix"></div>
    </div>
      </form>
  </div>

</div>