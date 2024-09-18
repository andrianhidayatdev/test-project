<?php

class View
{
  static function render(string $view, array $model = null)
  {
    require_once __DIR__ . '/../base_url.php';
    require_once __DIR__ . '/../app/View/' . $view . '.php';
  }
}
