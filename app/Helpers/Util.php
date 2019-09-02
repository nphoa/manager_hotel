<?php
namespace App\Helpers;

class Util {

    const status  = array(
        '0'   => 'Empty',
        '1'   => 'Check In',
        '2'   =>  'Check Out',
    );
    public  static function getStatusName($idStatus){
      return  (self::status)[$idStatus];

    }

}