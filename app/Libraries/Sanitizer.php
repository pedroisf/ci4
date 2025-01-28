<?php

namespace App\Libraries;
class Sanitizer
{
  public function chars($input)
  {
    
    $find = ['(', ')', '.', '-', ' '];
    return str_replace($find, [''], $input);
  }

  public function post($numero)
  {
    $data = [];
    foreach ($numero as $indice => $value) {
      $data[$indice] = trim(htmlspecialchars(strip_tags($value), ENT_QUOTES, 'UTF-8'));
    }
    return $data;
  }
}
