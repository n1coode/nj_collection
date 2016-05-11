<?php
namespace N1coode\NjCollection\Utility;

/**
 * @author n1coode
 * @package nj_collection
 */
class Configuration
{
	/**
	 * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
	 * @return boolean
	 */
	public static function flexformSettingsExists(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager)
	{
		$flexformSettingsExists = false;
		
		$frameworkConfiguration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		
		if(array_key_exists('flexform', $frameworkConfiguration['settings']))
		{
			$flexformSettingsExists = true;
		}
		
		return $flexformSettingsExists;
	}
	
	
	/**
	 * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
	 * @return void
	 */
	public static function settings(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager)
	{
		$useTypoScript = false;
		$frameworkConfiguration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		
		if(self::flexformSettingsExists($configurationManager))
		{
			$useTypoScript = $frameworkConfiguration['settings']['flexform']['general']['typoScript'] == 1 ? true : false;
		}
		
		
		if(!$useTypoScript)
		{
			$flexform = $frameworkConfiguration['settings']['flexform'];
			
			if(array_key_exists('storagePid', $flexform))
			{
				$frameworkConfiguration['settings']['persistence']['storagePid'] = $flexform['persistence']['storagePid'];
				$frameworkConfiguration['persistence']['storagePid'] = $flexform['persistence']['storagePid'];
			}
			
			if(array_key_exists('view', $flexform))
			{
				$frameworkConfiguration['settings']['view'] = $flexform['view'];
			}
			else {
				$frameworkConfiguration['settings']['view'] = $frameworkConfiguration['view'];
			}
			
			if(array_key_exists('settings',$flexform))
			{
				if(array_key_exists('controller',$flexform['settings']))
				{
					$frameworkConfiguration['settings']['controller'] = $flexform['settings']['controller'];
				}
				
				if(array_key_exists('model',$flexform['settings']))
				{
					$frameworkConfiguration['settings']['model'] = $flexform['settings']['model'];
				}
			
				if(array_key_exists('general',$flexform['settings']))
				{
					$frameworkConfiguration['settings']['general'] = $flexform['settings']['general'];
				}
			}
		}
		else
		{
			if(array_key_exists('view',$frameworkConfiguration)) {}
		}
	
		$dataSetCollection = self::getDataSetCollection($configurationManager);
		if($dataSetCollection !== NULL)
		{
			$frameworkConfiguration['persistence']['storagePid'] = $dataSetCollection;
			$frameworkConfiguration['settings']['persistence']['storagePid'] = $dataSetCollection;
		}
		
		$configurationManager->setConfiguration($frameworkConfiguration);
		
	} //end of function getSetup
	
	
	/**
	 * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager
	 * @return string
	 */
	private static function getDataSetCollection(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager)
	{
		if(is_object($configurationManager))
		{
			$contentObject = $configurationManager->getContentObject();
			
			if(is_object($contentObject))
			{
				$pages = $contentObject->data['pages'];
				
				if($pages !== NULL && $pages !== '')
				{
					return $pages;
				}
			}
		}
		return NULL;
	}
	
	
} //end of N1coode\NjItaros\Utility\Configuration