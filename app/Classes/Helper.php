<?php

namespace App\Classes;

class Helper
{
  public function alt_caps($string){
    $result = "";
    for ($i=0; $i < strlen($string) ; $i++) {
      if($i%2 == 0) {
        $result .= strtolower($string[$i]);    //to make lower case
      } else {
        $result .= strtoupper($string[$i]);    //to make upper case
      }
    }
    return $result;
  }

  public function convertString($string, $capitalize_flag)
  {
    if($capitalize_flag == 'CAPS'){
      $response = strtoupper($string);
    } else if($capitalize_flag == 'ALTCAPS'){
      $response = self::alt_caps($string);
    } else {
      $response = strtoupper($string);       //by default/else return Upper Case
    }
    return $response;
  }

  public function generateCSV($string){
    $stringArray = [];
    for ($i=0; $i < strlen($string) ; $i++){
     $stringArray[] = $string[$i];
    }
    $fp = fopen('string.csv', 'wb');
    fputcsv($fp, $stringArray);
    fclose($fp);
    return true;
  }
}