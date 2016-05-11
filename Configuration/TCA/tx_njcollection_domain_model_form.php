<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

$nj_ext_key			= 'tx_njcollection';
$nj_ext_namespace	= 'NjCollection';
$nj_ext_path		= 'nj_collection';
$nj_ext_title		= 'njs Collection';

$nj_ext_lang_file	= 'LLL:EXT:nj_collection/Resources/Private/Language/locallang_db.xlf:';

$nj_domain_model = 'Form';
$nj_domain = strtolower($nj_domain_model);

return array(
	'ctrl' => array(
        'title' => $nj_ext_lang_file.'model.'.$nj_domain,
        'label' => 'sender',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'dividers2tabs' => TRUE,
		'type' => '',
        'default_sortby' => 'ORDER BY crdate ASC',
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'enablecolumns' => array(),
        'requestUpdate' => '',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($nj_ext_path) . 'Resources/Public/Icons/' . $nj_ext_key . '_domain_model_' . $nj_domain . '.png',
    ),
	'interface' => array(
        'showRecordFieldList' => 'sorting',
		'maxDBListItems' => 100,
		'maxSingleDBListItems' => 500,
		'always_description' => 1,
    ),
	'feInterface' => array(
        'fe_admin_fieldList' => 'sender',
    ),
	'columns' => array(
        'tstamp' => Array (
            'exclude' => 1,
            'label' => 'Creation date',
            'config' => Array (
                'type' => 'none',
                'format' => 'date',
                'eval' => 'date',
            )
        ),
        'ftype' => array(
            'exclude' => 0,
            'label' => $nj_ext_lang_file.'label.model.'.$nj_domain.'.type',
            'config'  => array(
                'type' => 'input',
                'size' => 25,
                'eval' => 'trim',
                'max'  => 256
            )
        ),
        'fdata' => array(
            'exclude' => 0,
            'label' => $nj_ext_lang_file.'label.model.'.$nj_domain.'.data',
            'config'  => array(
                'type' => 'text',
                'cols' => 60,
                'rows' => 15,
            )
        ),
        'sender' => array(
            'exclude' => 0,
            'label' => $nj_ext_lang_file.'label.model.'.$nj_domain.'.sender',
            'config'  => array(
                'type' => 'input',
                'size' => 25,
                'eval' => 'trim',
                'max'  => 256
            )
        ),
    ),
	'types' => array(
        '0' => array('showitem' => 'sender,ftype,fdata' )
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
);