<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Text{

  var $textid;
  var $title;
  var $text;
  var $author;
  var $token;
  var $playmeapptoken;
  var $type;
  var $active;
  var $category;
  var $date;

  public function __construct(array $arguments = array()) {
    if (!empty($arguments)) {
        foreach ($arguments as $property => $argument) {
            $this->{$property} = $argument;
        }
    }
  }


}

?>
