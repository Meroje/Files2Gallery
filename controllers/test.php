<?php

class TestController extends AppController
{
  public function actionIndex()
  {
    $this->loadView('test/index');
  }
}
