<?php
if(!defined('TYPO3_MODE')) die ('Access denied.');
 
$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';


$nj_ext_key			= 'tx_njcollection';
$nj_ext_namespace	= 'NjCollection';
$nj_ext_path		= 'nj_collection';
$nj_ext_title		= 'njs Collection';

$nj_ext_lang_file	= 'LLL:EXT:nj_collection/Resources/Private/Language/locallang_db.xlf:';


/**
 * Registers a Plugin to be listed in the Backend. You also have to configure the Dispatcher in ext_localconf.php.
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Pi1',
    $nj_ext_lang_file.'plugin.title'
);


/**
 * TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', $nj_ext_title.' setup');


/**
 * Flexform
 */
// Clean up the Flexform fields in the backend a bit
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,splash_layout';
// Add own flexform stuff.
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_'.$nj_ext_key.'.xml');



$GLOBALS['TCA']['tx_njcollection_domain_model_content']['ctrl']['hideTable'] = TRUE;