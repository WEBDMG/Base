<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Wordpress{

  var $title;
  var $image;
  var $excerpt;
  var $link;


  public function __construct(array $arguments = array()) {
    if (!empty($arguments)) {
        foreach ($arguments as $property => $argument) {
            $this->{$property} = $argument;
        }
    }
  }


}

?>
