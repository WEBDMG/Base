<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Items{

  var $id;
  var $name;
  var $desc;
  var $price;
  var $image;
  var $status;
  var $inventory;
  var $token;
  var $active;
  var $category;
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
