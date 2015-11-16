<?php
require_once 'FormWidget.class.php';

class FormWidgetPlupfile extends FormWidget {
  private $name;
  private $required;
  private $max_file_number;
  private $max_file_size;
  private $extensions;
  private $upload_dir;
  
  public function __construct($name, $conf) {
    parent::__construct($conf);
    $this->name = $name;
    $this->required = isset($conf['required']) ? $conf['required'] : 0;
    $this->max_file_number = isset($conf['max_file_number']) ? $conf['max_file_number'] : 0;
    $this->max_file_size = isset($conf['max_file_size']) ? $conf['max_file_size'] : 2; // default to 2 MB
    $this->extensions = isset($conf['extensions']) ? $conf['extensions'] : 'jpg,png,gif';
    $this->extensions_quoted = explode(',', $this->extensions);
    $this->upload_dir = isset($conf['upload_dir']) ? $conf['upload_dir'] : 'files';
    $quoted = array();
    foreach ($this->extensions_quoted as $ext) {
      $quoted[] = "'$ext'";
    }
    $this->extensions_quoted = implode(',', $quoted);
  }
  
  static function bootstrap($name) {
    // include libs
    $whichend = is_backend() ? 'backend' : 'frontend';
    // jquery-ui
    if (!Asset::checkAssetAdded('jquery-ui', 'js', $whichend)) {
      $js = "<script src='".uri('libraries/jquery-ui/jquery-ui.min.js', false)."'></script>";
      Asset::addDynamicAsset('jquery-ui', 'js', $whichend, $js);
    }
    if (!Asset::checkAssetAdded('jquery-ui', 'css', $whichend)) {
      $js = "<link rel=\"stylesheet\" href=\"".uri('libraries/jquery-ui/jquery-ui.theme.min.css', false)."\">\n";
      $js.= "  <link rel=\"stylesheet\" href=\"".uri('libraries/jquery-ui/jquery-ui.structure.min.css', false)."\">";;
      Asset::addDynamicAsset('jquery-ui', 'css', $whichend, $js);
    }
    // plupload
    if (!Asset::checkAssetAdded('plupload', 'js', $whichend)) {
      $js = "<script type='text/javascript' src='".uri('libraries/plupload/js/plupload.full.min.js', false)."'></script>";
      Asset::addDynamicAsset('plupload', 'js', $whichend, $js);
    }
    // plupload queue js
    if (!Asset::checkAssetAdded('plupload_queue', 'js', $whichend)) {
      $js = "<script type='text/javascript' src='".uri('libraries/plupload/js/jquery.plupload.queue/jquery.plupload.queue.min.js', false)."'></script>";
      Asset::addDynamicAsset('plupload_queue', 'js', $whichend, $js);
    }
    // plupload queue css
    if (!Asset::checkAssetAdded('plupload_queue', 'css', $whichend)) {
      $css = "<link type='text/css' rel='stylesheet' href='".uri('libraries/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css')."' media='screen' />";
      Asset::addDynamicAsset('plupload_queue', 'css', $whichend, $css);
    }
    // plupload language js
    if (!Asset::checkAssetAdded('plupload_i18n', 'js', $whichend)) {
      $js = "<script type='text/javascript' src='".uri('libraries/plupload')."/js/i18n/".(get_language() == 'zh' ? 'zh_CN' : 'en').".js'></script>";
      Asset::addDynamicAsset('plupload_i18n', 'js', $whichend, $js);
    }
    // plupload markup css
    if (!Asset::checkAssetAdded('plupload_markup', 'css', $whichend)) {
      $css = '<!-- plupload markup style -->
  <style>
    .file-container {height:auto;border:none;box-shadow:none;list-style:none;}
    .file-container:after {content:" ";display:table;clear:both;*zoom: 1;}
    .uploaded-file {margin-bottom:5px;margin-right:5px;float:left;padding:2px;border:1px solid #DDD;width:85px;height:110px;background-color:#FFF;}
    .uploaded-file a {display:block;width:80px;height:80px;overflow:hidden;color:#666;text-align:center;line-height:80px;}
    .uploaded-file button {display:block;width:80px;height:20px;text-align:center;margin-top:3px;}
  </style>';
      Asset::addDynamicAsset('plupload_markup', 'css', $whichend, $css);
    }
    // plupload markup js
    if (!Asset::checkAssetAdded('plupload_markup', 'js', $whichend)) {
      $js = '<!-- js functions for plupload file widget -->
<script type="text/javascript">

function textareaToFilelist(textarea, max_file_number) {
  // build the list
  textarea.hide();
  var formGroup = textarea.parents(\'.form-group\').first();
  
  var content = jQuery.trim(textarea.val());;
  var files = content.split("\n");
  
  // remove and rebuild file container
  $(\'.file-container\', formGroup).remove();
  var container = $(\'<ul class="form-control file-container"></ul>\');
  
  for (i in files) {
    var file = files[i];
    if (file == \'\') {
      break;
    }
    // get file name
    var tokens = file.split(\'/\');
    var fileName = tokens[tokens.length-1];
    
    var cell = \'\';
    tokens = fileName.split(\'.\');
    var extension = tokens[tokens.length-1];
    var extension_icon = \'\';
    switch (extension.toLowerCase()) {
      case \'doc\':
      case \'docx\':
        extension_icon = \'word\'; break;
      case \'pdf\':
        extension_icon = \'pdf\'; break;
      case \'txt\':
        extension_icon = \'text\'; break;
      case \'csv\':
      case \'xls\':
        extension_icon = \'excel\'; break;
      case \'zip\':
      case \'rar\':
        extension_icon = \'archive\'; break;
      case \'mp3\':
        extension_icon = \'audio\'; break;
      case \'mp4\':
      case \'flv\':
        extension_icon = \'video\'; break;
    }
    extension_icon = \'<i class="fa fa-file-\'+extension_icon+\'-o"></i>\';
    if (tokens[tokens.length-1].match(/(jpg|jpeg|png|gif)/i)) {
      cell = \'<a style="background:#EEE url(\'+"/"+site.settings.subroot+(site.settings.subroot == "" ? "" : "/")+file+\') center no-repeat;background-size:contain" target=_blank href="\'+"/"+site.settings.subroot+(site.settings.subroot == "" ? "" : "/")+file+\'"></a>\';
    } else {
      cell = \'<a style="background:#EEE;font-size:45px;" target=_blank href="\'+"/"+site.settings.subroot+(site.settings.subroot == "" ? "" : "/")+file+\'">\'+extension_icon+\'</a>\';
    }
    
    // build file item
    var regx = \'/\'+extension+\'/gi\'; // regx to replace extension
    container.append(
      $(\'<li id="\'+tokens[0]+\'_uploaded" class="uploaded-file">\'+cell+\'<button data-furi="\'+file+\'" class="delete btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></li>\')
    );
  }

  textarea.after(container);
  // add addMore button if not exist
  if ($(\'.addMore\', formGroup).length == 0) {
    container.after(
      $(\'<div class="form-control" style="border:none;box-shadow:none;"><button style="display:none;" class="addMore btn btn-sm btn-primary"><i class="fa fa-plus"></i> '.i18n(array("en" => "Add new file", "zh" => "添加新文件")) . '</button></div>\')
    );
    $(\'.addMore\', formGroup).on(\'click\', function(){
      $(this).fadeOut(function(){
        $(\'.uploader\', formGroup).fadeIn();
      });
      return false;
    });
  }

  container.sortable({
    update: function(event, ui){
      filelistToTextarea(container, max_file_number);
    }
  });
  container.disableSelection();
  
  checkMaxItemReached(max_file_number, textarea, $(\'.addMore\', formGroup), $(\'.uploader\', formGroup));
}

function filelistToTextarea(filelist, max_file_number) {
  var content = "";
  $(\'.delete\', filelist).each(function(){
    content += $(this).data(\'furi\') + "\n";
  });
  content = jQuery.trim(content);
  var formGroup = filelist.parents(\'.form-group\').first();
  var textarea = $(\'textarea\', formGroup);
  textarea.val(content);
  checkMaxItemReached(max_file_number, textarea, $(\'.addMore\', formGroup), $(\'.uploader\', formGroup));
}

function checkMaxItemReached(max, textarea, addButton, uploader) {
  var content = jQuery.trim(textarea.val());;
  var files = content.split("\n");
  if (max > files.length || (files.length == 1 && files[0] == "")) {
    addButton.show();
    uploader.hide();
  } else {
    addButton.fadeOut(function(){
      uploader.fadeOut();
    });
  }
}
</script>
<!-- END OF js functions for plupload file widget -->';
      Asset::addDynamicAsset('plupload_markup', 'js', $whichend, $js);
    }
  }
  
  public function render($module, $model) {
    $rtn = 
'
    <div class="form-group">
      <label for="'.$this->name.'" class="col-sm-2 control-label">'.$this->name.' '.($this->required ? '<span style="color: rgb(185,2,0); font-weight: bold;">*</span>' : '').'</label>
      <div class="col-sm-10">
        <textarea'.($this->required ? ' required=""' : '').' name="'.$this->name.'" id="'.$this->name.'" rows="5" class="form-control">[[[ echo isset($_POST["'.$this->name.'"]) ? htmlentities($_POST["'.$this->name.'"]) : htmlentities($object->get'.  format_as_class_name($this->name).'()); ]]]</textarea>

        <div id="'.$this->name.'_uploader" class="uploader" style="display: none;">
            <p>Your browser doesn\'t have Flash, Silverlight or HTML5 support.</p>
        </div>

      </div>
    </div>
    <div class="hr-line-dashed"></div>

  
<!-- js code for #'.$this->name.'_uploader -->
<script type="text/javascript">
$(function() {
  /** define var **/
  var max_file_number = '.$this->max_file_number.';
  
  /** build file list from textarea **/
  textareaToFilelist($(\'#'.$this->name.'\'), max_file_number);
  
  /** bind file delete action **/
  $(\'#'.$this->name.'\').parents(\'.form-group\').first().on(\'click\', \'.delete\', function(){
    $(this).prop(\'disabled\', true);
    var filelist = $(this).parents(\'.file-container\').first();
    $.post(\''.uri("modules/$module/controllers/backend/".$module."_form_field_".$this->name."_remove.php", false).'\', {
      fid: $(this).parents(\'li\').first().attr(\'id\'),
      furi: $(this).data(\'furi\')
    }, function(data){
      if (data.error !== undefined) {
        alert("'.i18n(array("en" => "Failed to delete file. Error: ", "zh" => "删除文件失败。错误：")).'"+data.error);
      }
      
      filelist = $(\'#\'+data.fid).parents(\'.file-container\');
      $(\'#\'+data.fid).remove();
      filelistToTextarea(filelist, max_file_number);
    }, \'json\');
    return false;
  });
  
  /** plupload Queue initialization **/
  
  $("#'.$this->name.'_uploader").pluploadQueue({
      // General settings
      runtimes : \'html5,flash,silverlight,html4\',
      url : "'.uri("modules/$module/controllers/backend/".$module."_form_field_".$this->name."_upload.php", false).'",
      chunk_size : \'1mb\',
      rename : false,
      dragdrop: true,

      filters : {
          max_file_size : \''.$this->max_file_size.'mb\',
          mime_types: [
              {title : "Allowed files", extensions : "'.$this->extensions.'"}
          ]
      },
      flash_swf_url : \''.uri('libraries/plupload/js/Moxie.swf', false).'\',
      silverlight_xap_url : \''.uri('libraries/plupload/js/Moxie.xap', false).'\',
      unique_names : true, // generate an unique file name for the uploaded file and send it as an additional argument - name, to server handling script
      multiple_queues : true // Re-activate the widget after each upload procedure.
      ,multi_selection : '.($this->max_file_size == 1 ? 'false' : 'true').'
  });
  var uploader = $(\'#'.$this->name.'_uploader\').pluploadQueue();

  // when upload complete
  uploader.bind(\'UploadComplete\', function(uploader, files){
    // append plup file list to textarea
    while (files[0] !== undefined) {
      if (files[0].status == plupload.DONE) {
        var existing_content = jQuery.trim($(\'#'.$this->name.'\').val());
        var to_be_added = (existing_content == \'\' ? \'\' : "\n") + \''.  str_replace(WEBROOT . DS, '', CACHE_DIR).'/\' + files[0].target_name.toLowerCase();
        $(\'#'.$this->name.'\').val(existing_content + to_be_added);
      }
      // and remove it from plup file list
      uploader.removeFile(files[0]);
    }
    // refresh file list
    textareaToFilelist($(\'#'.$this->name.'\'), max_file_number);
  });

  // when file(s) added
  uploader.bind(\'FilesAdded\', function(uploader, files){
    var content = jQuery.trim($(\'#'.$this->name.'\').val());
    if (content == \'\') {
      var existing_files = [];
    } else {
      var existing_files = content.split("\n");
    }
    var added_files = uploader.files;
    if (existing_files.length + added_files.length > max_file_number) {
      alert(\'[[[ echo i18n(array("en" => "Too many files selected. Max allowed upload limit is ","zh" => "您选择的文件过多了，最大允许的上传数为")) ]]] \' + max_file_number + \' [[[ echo i18n(array("en" => "files", "zh" => "")); ]]].\' + \' [[[ echo i18n(array("en" => "Only ", "zh" => "您上传的文件仅有")) ]]]\' + (max_file_number - existing_files.length) + \' [[[ echo i18n(array("en" => "of your selected files are accepted", "zh" => "个文件被接受")) ]]].\');
      for (i=uploader.files.length-1; i>(max_file_number - existing_files.length - 1); i--) {
        uploader.removeFile(uploader.files[i]);
      }
    }
  });

});
</script>
<!-- END OF js code for #'.$this->name.'_uploader -->
';

    return $rtn;
  }
  
  public function validate() {
    $rtn = "\n  // validation for $".$this->name."\n";
    $rtn .= '  $'.$this->name.' = isset($_POST["'.$this->name.'"]) ? strip_tags(trim($_POST["'.$this->name.'"])) : null;';
    if ($this->required) {
      $rtn .='
  // check not empty
  if (empty($'.$this->name.')) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "'.$this->name.' is required.", "zh" => "请填写'.$this->name.'"))));
    $error_flag = true;
  }
';
    }
    $rtn .= '
  // check upload_dir
  if (!is_dir(WEBROOT . DS . "'.$this->upload_dir.'")) {
    mkdir(WEBROOT . DS . "'.$this->upload_dir.'");
  }
  if (!is_writable(WEBROOT . DS . "'.$this->upload_dir.'")) {
    $error_flag = true;
    Message::register(new Message(Message::DANGER, i18n(array("en" => "Upload dir is not writable.", "zh" => "上传文件夹不可写"))));
  } else {
    $files = explode("\n", trim($'.$this->name.'));
    // check max_file_number
    if (sizeof($files) > '.$this->max_file_number.') {
      Message::register(new Message(Message::DANGER, i18n(array("en" => "Max file allowed to be uploed is '.$this->max_file_number.'. Please reduce uploaed files.", "zh" => "您最多可以上传'.$this->max_file_number.'个文件，请减少上传的文件数量"))));
      $error_flag = true;
    }
    // check file extension
    foreach ($files as $file) {
      $file = trim($file);
      if (sizeof($files) == 1 && $file == "") {
        break;
      }
      $tokens = explode(".", $file);
      $extension = array_pop($tokens);
      if (!in_array(strtolower($extension), array('.$this->extensions_quoted.'))) {
        Message::register(new Message(Message::DANGER, i18n(array("en" => "Only file with extension '.$this->extensions.' is allowed. Please restrict your files with these types.", "zh" => "上传文件仅支持'.$this->extensions.'，请检查您的上传文件"))));
        $error_flag = true;
        break;
      }
    }
  }
';

    return $rtn;
  }
  
  public function proceed() {
    $rtn = "\n  // proceed for $".$this->name."\n";
    $rtn .= '  $files = explode("\n", trim($'.$this->name.'));
  $rtn = array();
  foreach ($files as $file) {
    $file = trim($file);
    // for cache file, we move it to its proper location 
    if (strpos($file, str_replace(WEBROOT . DS, "", CACHE_DIR)) === 0) {
      $oldname = WEBROOT . DS . $file;
      $newname = WEBROOT . DS . "'.$this->upload_dir.'" . str_replace(CACHE_DIR, "", WEBROOT . DS . $file);
      rename($oldname, $newname);
      $file = str_replace(WEBROOT . DS, "", $newname);
    }
    $rtn[] = $file;
  }
  $object->set'.  format_as_class_name($this->name) . '(implode("\n", $rtn));
';
    return $rtn;
  }
}