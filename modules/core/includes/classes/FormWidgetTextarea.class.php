<?php
require_once 'FormWidget.class.php';

class FormWidgetTextarea extends FormWidget {
  private $name;
  private $required;
  private $wysiwyg;
  
  const TOOLBAR_STANDARD = "{
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
";


  public function __construct($name, $conf) {
    parent::__construct($conf);
    $this->name = $name;
    $this->required = isset($conf['required']) ? $conf['required'] : 0;
    $this->wysiwyg = isset($conf['wysiwyg']) ? $conf['wysiwyg'] : 0;
    $this->wysiwyg_toolbar = isset($conf['wysiwyg_toolbar']) ? $conf['wysiwyg_toolbar'] : 0;
  }
  
  public function render($module, $model) {
    $rtn = "";
    $prepopulate = '($object->isNew() ? ' . "(isset(\$_POST['$this->name']) ? htmlentities(\$_POST['$this->name']) : '')" . ' : htmlentities($object->get' . format_as_class_name($this->name) . '()))';
    $rtn .=
"\n<div class='form-group'>
  <label class='col-sm-2 control-label' for='$this->name'>$this->name ".($this->required ? $this->mandatory_field : '')."</label>
  <div class='col-sm-10'>
    <textarea class='form-control' rows='5' id='$this->name' name='$this->name'".($this->required ? ' required' : '').">[[[ echo $prepopulate ]]]</textarea>
  </div>
</div>
<div class='hr-line-dashed'></div>
";

    // ckeditor
    if ($this->wysiwyg) {
      if (!Asset::checkAssetAdded('ckeditor', 'js', 'backend')) {
        $js = "\n<script type='text/javascript' src='".uri('libraries/ckeditor/ckeditor.js', false)."'></script>\n";
        Asset::addDynamicAsset('ckeditor', 'js', 'backend', $js);
        $rtn .= $js;
      }
      $toolbar = false;
      if ($this->wysiwyg_toolbar) {
        $toolbar_name = "TOOLBAR_" . strtoupper($this->wysiwyg_toolbar);
        $toolbar = constant("self::$toolbar_name");
      }
      $rtn .= "<script type='text/javascript'>CKEDITOR.replace('$this->name'".($toolbar ? ", $toolbar" : "").");</script>";
    }
    
    return $rtn;
  }
  
  public function validate() {
    $rtn = "\n  // validation for $".$this->name."\n";
    $rtn .= '  $'.$this->name.' = isset($_POST["'.$this->name.'"]) ? $_POST["'.$this->name.'"] : null;';
    if ($this->required) {
      $rtn .= '
  if (empty($'.$this->name.')) {
    Message::register(new Message(Message::DANGER, i18n(array("en" => "'.$this->name.' is required.", "zh" => "请填写'.$this->name.'"))));
    $error_flag = true;
  }
';
    }
    return $rtn;
  }
  
  public function proceed() {
    $rtn = "\n  // proceed for $".$this->name."\n";
    $rtn .= '  $object->set'.format_as_class_name($this->name).'($'.$this->name.');
';
    return $rtn;
  }
}