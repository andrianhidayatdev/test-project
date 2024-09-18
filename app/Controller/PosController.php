<?php

require_once __DIR__ . '/../../library/View.php';
require_once __DIR__ . '/../Model/PosModel.php';
class PosController
{
  private PosModel $posModel;

  function __construct()
  {
    $this->posModel = new PosModel();
  }
  function index()
  {
    View::render('pos_view');
  }

  function save()
  {
    $this->posModel->save($_POST['time']);
  }
}
