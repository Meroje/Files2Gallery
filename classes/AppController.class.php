<?php

class AppController extends Lvc_PageController
{
	protected $layout = 'default';
	
	protected function beforeAction()
	{
	  global $globalConfig;
		$this->setLayoutVar('pageTitle', $globalConfig->getIniDataObj('global')->site->name);
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
	
}

?>