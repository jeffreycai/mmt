<?php
require_once 'FormWidget.class.php';

class FormWidgetDatepicker extends FormWidget {
  private $name;
  private $required;
  private $options;
  
  public function __construct($name, $conf) {
    parent::__construct($conf);
    $this->name = $name;
    $this->required = isset($conf['required']) ? $conf['required'] : 0;
    $this->options = $conf['options'];
  }
  
  static function bootstrap() {
    // include libs
    $whichend = is_backend() ? 'backend' : 'frontend';
    // jquery-ui
    if (!Asset::checkAssetAdded('jquery-ui', 'js', $whichend)) {
      $js = "<script src='".uri('libraries/jquery-ui/jquery-ui.min.js', false)."'></script>";
      Asset::addDynamicAsset('jquery-ui', 'js', $whichend, $js);
    }
    if (!Asset::checkAssetAdded('jquery-ui', 'css', $whichend)) {
      $js = "<link rel=\"stylesheet\" href=\"".uri('libraries/jquery-ui/jquery-ui.theme.min.css', false)."\">";
      $js.= "\n<link rel=\"stylesheet\" href=\"".uri('libraries/jquery-ui/jquery-ui.structure.min.css', false)."\">";;
      Asset::addDynamicAsset('jquery-ui', 'css', $whichend, $js);
    }
  }
  
  public function render($module, $model) {
    $rtn = 
"\n[[[
  \$prepopulate = (\$object->isNew() ? (isset(\$_POST['".$this->name."']) ? strip_tags(\$_POST['".$this->name."']) : '') : \$object->get".DBObject::tableNameToClassName($this->name)."() * 1000);
  \$alt_prepopulate = \$prepopulate;
  if (preg_match('/^\d+$/', \$prepopulate)) {
    \$alt_prepopulate = date('Y-m-d', \$prepopulate/1000);
  }
]]]\n";


    $id = get_random_string(5);
    $rtn .=
"\n<div id='$id' class='form-group'>
  <label class='col-sm-2 control-label' for='$this->name'>$this->name ".($this->required ? $this->mandatory_field : '')."</label>
  <div class='col-sm-10'>
    <div class='input-group'>
      <span class='input-group-addon'><i class='fa fa-calendar'></i></span>
      <input disabled='disabled' value='[[[ echo htmlentities(str_replace('\'', '\"', \$alt_prepopulate)) ]]]' type='text' class='form-control altFormat' ".($this->required ? ' required' : '')." />
      <input value='[[[ echo htmlentities(str_replace('\'', '\"', \$prepopulate)) ]]]' type='text' id='$this->name' name='$this->name' class='datepicker form-control' ".($this->required ? ' required' : '')."  style='position: absolute; top:0; left: 0; z-index: -1' />
    </div>
  </div>
</div>
<div class='hr-line-dashed'></div>
";
    
    $rtn .= "
    <script type='text/javascript'>
      $('#$id .datepicker').datepicker({
        ".(isset($this->options['dateFormat']) ? 'dateFormat: ' . "'".$this->options['dateFormat']."'" : '')."
        ".(isset($this->options['altFormat']) ? ',altField: "#'.$id.' .altFormat", altFormat: "'.$this->options['altFormat'].'"' : '')."
        ".(isset($this->options['changeMonth']) ? ',changeMonth: ' . $this->options['changeMonth'] : '')."
        ".(isset($this->options['changeYear']) ? ',changeYear: ' . $this->options['changeYear'] : '')."
        ".(isset($this->options['yearRange']) ? ',yearRange: ' . "'". $this->options['yearRange'] . "'" : '')."
      });
      $('#$id .input-group-addon').css('cursor', 'pointer').on('click', function(){
        $('#$id .datepicker').datepicker('show');
      });
    </script>
";
    
    return $rtn;
  }
  
  public function validate() {
    $rtn = "\n  // validation for $".$this->name."\n";
    $rtn .= '  $'.$this->name.' = isset($_POST["'.$this->name.'"]) ? strip_tags($_POST["'.$this->name.'"]) : null;';
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
    $rtn .= '  $object->set'.format_as_class_name($this->name).'($'.$this->name.'/1000);
';
    return $rtn;
  }
}