<?php
require_once 'src/controllers/basecontroller.php';
class TagController extends BaseController {
  public static function index(){
    $user = self::get_user_logged_in();
    $tags = Tag::all($user);
    include 'src/views/tags.php';
  }
}
