<?php
class BaseModel {
  public function validate_is_numeric($value, $msg){
    $errors = array();
    if(!is_numeric($value)){
      $errors[] = $msg;
    }
    return $errors;
  }

  public function validate_string_max_length($value, $max_length, $msg){
    $errors = array();
    if(strlen($value) > $max_length){
      $errors[] = $msg;
    }
    return $errors;
  }

  public function validate(){
    $errors = array();
    foreach($this->validators as $validator){
      $errors = array_merge($errors, $this->{$validator}());
    }
    return $errors;
  }
}
