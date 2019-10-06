<?php defined('BASEPATH') OR exit('No direct script access allowed');
include 'Photo.php';
include 'Items.php';
include 'Text.php';
include 'Wordpress.php';

class Gathr{

  protected $CI;

  // We'll use a constructor, as you can't directly call a function
  // from a property definition.
  public function __construct()
  {
          // Assign the CodeIgniter super-object
          $this->CI =& get_instance();
  }

  //User Config
  public function app_config($apptoken, $apikey, $gathrurl = "http://api.gathr.me/v4"){
      $url = $gathrurl."/config/config/token/".$apptoken;
      $data = json_decode($this->api_call($apikey,$url),true);
      if (!is_null($data["config"][0])){
        foreach($data["config"][0] as $key => $value){
          $arrayData[$key] = $value;
        }
        return $arrayData;
      }
  }

  //Photos
  public function get_photos_category($apptoken, $apikey,$category = array(),$gathrurl = "http://api.gathr.me/v4"){
    $arrayData = array();
    foreach ($category as $key => $value) {
      $url = $gathrurl."/photo/find/category/".$value."/token/".$apptoken;
      $data = json_decode($this->api_call($apikey,$url),true);
      if (!is_null($data)){
        $arrayData[] = $this->mapPhotos($data);
      }
    }
      return $arrayData;
  }

  function mapPhotos($item){

    foreach ($item as $data) {
      $photos = new Photo($data);
    }
    return $photos;
  }

  public function checkPhotoCategory(Photo $photo, String $category){
      if ($photo->category === $category) {
        return $photo;
      }else{
        return FALSE;
      }
  }

  //Items
  public function get_items_category($apptoken, $apikey,$category = array(),$gathrurl = "http://api.gathr.me/v4"){
    $arrayData = array();
    foreach ($category as $key => $value) {
      $url = $gathrurl."/item/find/category/".$value."/token/".$apptoken;
      $data = json_decode($this->api_call($apikey,$url),true);
        if (!is_null($data)){
        foreach($data as $food){
          $arrayData[] = $this->mapItems($food);
        }
      }
    }
    return $arrayData;
  }

  function mapItems($item){

    $item = new Items($item);

    return $item;
  }

  public function checkItemCategory(Items $item, String $category){
      if ($item->category === $category) {
        return $item;
      }else{
        return FALSE;
      }
  }

  //Text
  public function get_text_category($apptoken, $apikey,$category = array(),$gathrurl = "http://api.gathr.me/v4"){
    $arrayData = array();
    foreach ($category as $key => $value) {
      $url = $gathrurl."/text/find/category/".$value."/token/".$apptoken;
      $data = json_decode($this->api_call($apikey,$url),true);
      if (!is_null($data)){
        $arrayData[] = $this->mapText($data);
      }
    }
      return $arrayData;
  }

  function mapText($item){

    foreach ($item as $data) {
      $text = new Text($data);
    }
    return $text;
  }

  public function checkTextCategory(Text $text, String $category){
      if ($text->category === $category) {
        return $text;
      }else{
        return FALSE;
      }
  }

//WordPress Posts
 public function get_posts($blogPosts,$apikey){
   $arrayData = array();
   $arrayDataWp = array();
   foreach ($blogPosts as $key => $value) {
     $url = base_url()."/blog/wp-json/wp/v2/media/".$value->featured_media;
     $data = json_decode($this->api_call($apikey,$url),true);

     $arrayData['image'] = $data["source_url"];
     $arrayData['title'] = $value->title->rendered;
     $arrayData['excerpt'] = $value->excerpt->rendered;
     $arrayData['link'] = $value->link;

     $arrayDataWp[] = $this->mapWordpress($arrayData);
   }
    return $arrayDataWp;
 }

 function mapWordpress($item){

   $wordpress = new Wordpress($item);

   return $wordpress;
 }
//public function
//Api CAll
 function api_call($apikey,$url = "http://api.gathr.me/v4/app"){
    // create curl resource
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'X-API-Key: '.$apikey
    ));

    // set url
    curl_setopt($ch, CURLOPT_URL, $url);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $string = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);

    return $string;
  }

}
?>
