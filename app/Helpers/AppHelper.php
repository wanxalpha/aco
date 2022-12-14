<?php
namespace App\Helpers;
use DateTime;

class AppHelper
{
  public static function randomString($length = 10)
  {
    $date = new Datetime();
    $current_timestamp = $date->format('YmdHis');

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $randomString = $randomString.'_'.$current_timestamp;
    return $randomString;
  }

  function getMonthNo(){
    return ['1','2','3','4','5','6','7','8','9','10','11','12'];
  }

     public function showQueries()
     {
          dd(\DB::getQueryLog());
     }

     public static function instance()
     {
         return new AppHelper();
     }
}