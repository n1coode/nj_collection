<?php
namespace N1coode\NjCollection\Controller;
use N1coode\NjCollection\Utility\Constants as Constants;

/**
 * Abstract base controller for the extension Tx_NjCollection
 * @author n1coode
 * @package nj_collection
 */
class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{	
	/**
	 * @var array 
	 */
	protected $error = [];
	
	/**
	 * @var array 
	 */
	protected $exceptions = [];
	
	/**
	 * @var string
	 */
	protected $nj_action = '';
	
	/**
	 * @var string
	 */
	protected $nj_ajax_pageType = Constants::NJ_AJAX_PAGETYPE;
	
	/**
	 * @var string
	 */
	protected  $nj_domain = '';
	
	/**
	 * @var string
	 */
	protected $nj_domain_model = '';
	
	/**
	 * @var string
	 */
	protected $nj_ext_domain = Constants::NJ_EXT_DOMAIN;
	
	/**
	 * @var string
	 */
	protected $nj_ext_key = Constants::NJ_EXT_KEY;
	
	
	
	/**
	 * @var string
	 */
	protected $nj_ext_namespace = Constants::NJ_EXT_NAMESPACE;
	
	/**
	 * @var string
	 */
	protected $nj_ext_path = Constants::NJ_EXT_PATH;

	/**
	 * @var array
	 */
	protected $nj_settings = [];
	
	/**
	 * @var Integer
	 */
	protected $storagePid;
	
	/**
	 * @var boolean
	 */
	protected $useTyposcript = false;
	
	
	//
	// Repositories
	//
	
	/**
	 * @var \TYPO3\CMS\Core\Resource\FileCollectionRepository
	 * @inject
	 */
	protected $collectionRepository;
	
	/**
	 * @var \TYPO3\CMS\Core\Resource\FileRepository
	 * @inject
	 */
	protected $fileRepository;
	
	/**
	 * @var \N1coode\NjCollection\Domain\Repository\FormRepository
	 * @inject
	 */
	protected $formRepository = NULL;
	
	/**
	 * @var \N1coode\NjCollection\Domain\Repository\TestimonialRepository
	 * @inject
	 */
	protected $testimonialRepository = NULL;
	
	
	//
	// Manager, Renderer & Services
	//
	
	/**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     * @inject
     */
    protected $configurationManager;
	
	/**
     * File Collection Service
     *
     * @var \N1coode\NjCollection\Service\FileCollectionService
     * @inject
     */
    protected $fileCollectionService;
	
	/**
	 * @var \TYPO3\CMS\Core\Page\PageRenderer
	 * @inject
	 */
	protected $pageRenderer;
	
	/**
	 * Holds an instance of persistence manager
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;
	
    
    /**
	 * @param string $model
	 * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
	 * @throws \TYPO3\CMS\Extbase\Configuration\Exception
	 */
    protected function init($model)
    {	
		if($model !== null)
		{
			$this->nj_domain_model = $model;
			$this->nj_domain = strtolower($this->nj_domain_model);
			$this->nj_action = $this->request->getControllerActionName();
			
			$this->configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
			
			if(\N1coode\NjCollection\Utility\Configuration::flexformSettingsExists($this->configurationManager))
			{
				\N1coode\NjCollection\Utility\Configuration::settings($this->configurationManager);
			}
			
			$configuration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
			
			$this->settings = $configuration['settings'];
                        
			unset($this->settings['flexform']);
			
		} //end of if model
		else
		{
			throw new \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
				('Kein Model angegeben. Überprüfe die Controller-Klasse.',48246892768209576);
		}
		
		if(!isset($this->settings))
			throw new \TYPO3\CMS\Extbase\Configuration\Exception('Please include typoscript to enable the extension.', 48246892768209576 );
		
		//if(isset($configuration['persistence']['storagePid']))
		//	$this->storagePid = intval($configuration['persistence']['storagePid']);		
		$this->includeCss();
		$this->includeJavaScript();
    }
	
	protected function callActionMethod() 
	{
		try 
		{
			parent::callActionMethod();
		} 
		catch(\TYPO3\CMS\Fluid\Core\ViewHelper\Exception $exception) 
		{
			throw new
			\TYPO3\CMS\Fluid\Core\ViewHelper\Exception($exception->getMessage());
		}
	}
	
	private function includeJavaScript()
	{
		if(!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('nj_page'))
		{}
		$this->getPageRenderer()
			->addJsFooterFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/JavaScript/'.$this->nj_ext_key.'_frontend.js');
	}
	
	private function includeCss()
	{
		switch($this->nj_domain)
		{
			case 'contact':
				$this->getPageRenderer()
					->addCssFile(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->nj_ext_path) . 'Resources/Public/Css/form.css');
				break;
			default:
				//nothing to do
			;
		}
	}
	
	private function setNjSettings()
	{
		//TODO
	}
	
	protected function getConfiguration()
	{
		$this->configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
		return  $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
	}
	
	
	protected function getCaller() 
	{
		$trace = debug_backtrace();
		$name = $trace[2]['function'];
		return empty($name) ? 'global' : $name;
	}
	
	
	protected function getExtSettings()
	{
		$data = $this->configurationManager->getContentObject()->data;
		
		$extSettings = [];
		$extSettings['key']			= $this->nj_ext_key;
		$extSettings['name']		= strtolower($this->nj_ext_namespace);
		$extSettings['controller']	= $this->nj_domain_model;		
		$extSettings['domain']		= $this->nj_domain;
		$extSettings['action']		= explode('Action',self::getCaller())[0];
		$extSettings['langFile']	= 'LLL:EXT:'.$this->nj_ext_path.'/Resources/Private/Language/locallang.xlf:';
		$extSettings['language']	= $GLOBALS['TSFE']->sys_language_uid;
		$extSettings['uid']			= $data['uid'];
		
		return $extSettings;
	}
	
	
	protected function storagePidIsset()
	{
		if(isset($this->settings['persistence']['storagePid']))
		{
			return true;
		}
		else {
			return false;
		}
	}
	
	protected function getStoragePid()
	{
		$configuration = $this->getConfiguration();
		return array($configuration['settings']['persistence']['storagePid']);
	}
	
	/**
	 * Provides a shared (singleton) instance of PageRenderer
	 *
	 * @return \TYPO3\CMS\Core\Page\PageRenderer
	 */
	protected function getPageRenderer() {
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
	}
	
} //end of N1coode\NjCollection\Controller\AbstractController
