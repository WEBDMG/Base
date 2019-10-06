<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Photo{

  var $photoid;
  var $title;
  var $url;
  var $active;
  var $category;
  var $source;
  var $token ;
  var $playmeapptoken;

  public function __construct(array $arguments = array()) {
    if (!empty($arguments)) {
        foreach ($arguments as $property => $argument) {
            $this->{$property} = $argument;
        }
    }
  }


}

?>
