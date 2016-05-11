<?php
namespace N1coode\NjCollection\Controller;

/**
 * @author n1coode
 * @package nj_collection
 */
class HeaderController extends \N1coode\NjCollection\Controller\AbstractController
{
	
	/**
     * @var array
     */
    protected $ajaxConstants = array();
	
	/**
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction()
    {
        parent::init('Header');
    }
	
	public function indexAction()
	{
		$this->assignAjaxConstants();
	}
	
	
	/**
	 * Sets the settings especially needed for the ajax controller
	 */
	private function assignAjaxConstants()
	{
		$this->ajaxConstants = array();
		$this->ajaxConstants['lang']['id']		= $GLOBALS['TSFE']->sys_language_uid;
		$this->ajaxConstants['page']['id']		= $GLOBALS['TSFE']->page['uid'];
		$this->ajaxConstants['page']['type']	= $this->nj_ajax_pageType;
		$this->ajaxConstants['var']['name']		= $this->nj_ext_key.'_ajaxConstants';
		
		
		$plugin = explode("\\",get_class());
	
		$this->ajaxConstants['plugin']['domain']		= $this->nj_ext_domain;
		$this->ajaxConstants['plugin']['namespace']		= $this->nj_ext_namespace;
		$this->ajaxConstants['plugin']['controller']	= $this->nj_domain_model;
		$callers=debug_backtrace();
		$this->ajaxConstants['plugin']['action']		= explode("Action",$callers[1]['function'])[0];
//		$this->njSettings['ajax']['lang']['id'] = $GLOBALS['TSFE']->sys_language_uid;
//		$this->njSettings['ajax']['lang']['iso'] = strtolower($GLOBALS['TSFE']->sys_language_isocode);
//
//		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
//
//		$this->njSettings['ajax']['path']['partial'] = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['partialRootPath']);
//		$this->njSettings['ajax']['path']['template'] = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
//
//		$this->njSettings['ajax']['typeNum'] = $this->settings['general']['ajax']['typeNum'];
//		
//		$this->njSettings['pids']['leaflet'] = $this->settings['model']['internship']['leafletPid'];
//		$this->njSettings['pids']['list'] = $this->settings['model']['internship']['listPid'];
//		$this->njSettings['pids']['registration'] = $this->settings['model']['internship']['registrationPid'];

		$this->view->assign('ajaxConstants', $this->ajaxConstants);
	}
}
?>