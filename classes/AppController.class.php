<?php

class AppController extends Lvc_PageController
{
	protected $layout = 'default';
  
  var $config;
	
  public function __construct()
  {
      $this->config = new IniFile('global', APP_PATH. 'config/config.ini');
  }
  
	protected function beforeAction()
	{
	  global $globalConfig;
		$this->setLayoutVar('pageTitle', $this->config->getIniDataObj('global')->site->name);
		$this->requireCss('reset.css');
		$this->requireCss('master.css');
	}
	
	public function requireCss($cssFile)
	{
		$this->layoutVars['requiredCss'][$cssFile] = true;
	}
	
	public function requireJs($jsFile)
	{
		$this->layoutVars['requiredJs'][$jsFile] = true;
	}
  
  public function newModel($name)
  {
    $class = ucfirst($name);
    $file = strtolower($anme) .'Model.php';
    
    if (file_exists(APP_PATH . 'models/' . $file))
    {
       include_once(APP_PATH . 'models/' . $file);
       return new $class;
    }
    else
    {
       throw new Exception("$class in $file does not exists.");
    }
  }
	
}

?>