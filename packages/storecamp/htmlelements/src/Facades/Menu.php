<?php

namespace storecamp\htmlelements\Facades;


use Illuminate\Support\Facades\Facade;

class Menu extends Facade
{
  public static function getFacadeAccessor() {
      return "menu";
  }
}