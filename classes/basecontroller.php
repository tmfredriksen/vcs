<?php
/**
 * 
 * Parent to all controllers, and has two sentral methods, ExecuteAction and ReturnView and a constructor.
 * This class is used every time you change page in this application.
 * 
 * @author Eivind Skreddernes, Tommy Langhelle, Tord-Marius Fredriksen
 *
 */
abstract class BaseController {
	protected $urlvalues;
	protected $action;

	public function __construct($action, $urlvalues) {
		$this->action = $action;
		$this->urlvalues = $urlvalues;
	}
	/**
	 * Return which action to run in model.
	 */
	public function ExecuteAction() {
		return $this->{$this->action}();
	}
	/**
	 * Viewmodel contains data we want to send to front end via smarty assign. This method 
	 * displays a view to the screen.
	 * Viewlocation can be used to show a page in a page. This is not in use right now.
	 * @param unknown $viewmodel
	 * @param unknown $fullview
	 */
	protected function ReturnView($viewmodel, $fullview) {
		$viewlocation = 'views/' . get_class($this) . '/' . $this->action . '.tpl';
		if ($fullview) {
			$smarty = new Smarty();
			$smarty->assign('viewmodel', $viewmodel);
				
			$smarty->display($viewlocation);
		} else {
			require($viewlocation);
		}
	}
}
?>