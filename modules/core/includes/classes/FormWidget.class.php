<?php

class FormWidget {
  private $confs;
  protected $mandatory_field;

  public function __construct($conf) {
    $this->conf = $conf;
    $this->mandatory_field = '<span style="color: rgb(185,2,0); font-weight: bold;">*</span>';
  }
  
  public function render($module, $model) {}
  public function validate() {}
  public function proceed() {}
}