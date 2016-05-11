<?php
namespace N1coode\NjCollection\Domain\Repository;

/**
 * @author n1coode
 * @package nj_collection
 */
class AbstractRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 * @inject
	 */
	protected $configurationManager;
	
	
	protected $defaultOrderings = array(
            'crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
	);
	
	
	/**
	 * @param string $model
	 * @throws Exception
	 */
	protected function init($model)
	{
		$this->configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface');
	
		if(\N1coode\NjCollection\Utility\Configuration::flexformSettingsExists($this->configurationManager))
		{
			\N1coode\NjCollection\Utility\Configuration::settings($this->configurationManager);
		}

		$configuration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);

		$this->settings = $configuration['settings'];

		unset($this->settings['flexform']);
		
		$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		$querySettings->setRespectStoragePage(TRUE);
		$querySettings->setStoragePageIds(array($configuration['persistence']['storagePid']));
		$querySettings->setRespectSysLanguage(TRUE);
		
		$this->setDefaultQuerySettings($querySettings);
	}
	
	/**
	 * @param array $storagePageIds
	 * @return  void
	 */
	public function setQuerySettings(array $storagePageIds)
	{
		$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		
		if(!empty($storagePageIds))
		{
			$querySettings->setStoragePageIds($storagePageIds);
			$querySettings->setRespectStoragePage(TRUE);
		}
		else 
		{
			$querySettings->setRespectStoragePage(FALSE);
		}
		$querySettings->setRespectSysLanguage(TRUE);
		$this->setDefaultQuerySettings($querySettings);
	}
	
	
} //end of class