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

  public function validate_string_min_length($value, $min_length, $msg){
    $errors = array();
    if(strlen($value) < $min_length){
      $errors[] = $msg;
    }
    return $errors;
  }

  public function validate(){
    $errors = array();
    if(isset($this->validators)){
      foreach($this->validators as $validator){
        $errors = array_merge($errors, $this->{$validator}());
      }
    }
    return $errors;
  }
}
