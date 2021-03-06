<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');
use N1coode\NjCollection\Utility\Constants as Constants;

$nj_ext_key			= Constants::NJ_EXT_KEY;
$nj_ext_namespace	= Constants::NJ_EXT_NAMESPACE;
$nj_ext_path		= Constants::NJ_EXT_PATH;
$nj_ext_title		= Constants::NJ_EXT_TITLE;

$nj_ext_lang_file	= Constants::NJ_EXT_LANG_FILE_BACKEND;


$nj_domain_model = 'Rating';
$nj_domain = strtolower($nj_domain_model);

return array(
	'ctrl' => array(
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate ASC',
		'delete' => 'deleted',
		'dividers2tabs' => TRUE,
		'enablecolumns' => array(
			'disabled' => 'hidden'
		),
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($nj_ext_path) . 'Resources/Public/Icons/' . $nj_ext_key . '_domain_model_' . $nj_domain . '.svg',
		'label' => 'crdate',
		'requestUpdate' => '',
		'title'	=> $nj_ext_lang_file.'model.'.$nj_domain,
		'sortby' => 'sorting',
		'tstamp' => 'tstamp',
	),
	'feInterface' => array(
		'fe_admin_fieldList' => 'title',
	),
	'interface' => array(
		'always_description' => 1,
		'maxDBListItems' => 100,
		'maxSingleDBListItems' => 500,
		'showRecordFieldList' => 'title, description',
	),
	
	'columns' => array(
		'crdate' => Array (
            'exclude' => 1,
            'label' => 'Creation date',
            'config' => Array (
                'type' => 'none',
                'format' => 'date',
                'eval' => 'date',
            )
        ),  
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'voter' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file . 'label.model.'.$nj_domain.'.voter',
			'config'  => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'foreign_class' => '\N1coode\NjCollection\Domain\Model\User',
				'maxitems' => 1,
				'items' => Array (
					Array('', 0),
				),
			)
		),
		'ip' => array(
			'exclude' => 0,
			'label' => $nj_ext_lang_file . 'label.general.ipAdress',
			'config' => array(
				'type' => 'input',
				'size' => 25,
				'eval' => 'trim'
			),
		),
		
		
		'foreign_table' => array(
			'exclude' => 0,
			'label' => $nj_ext_lang_file . 'label.model.content.foreignTable',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'foreign_uid' => array(
			'exclude'	=> 1,
			'label'		=> 'foreignUid',
			'config'	=> array(
					'type' => 'input',
					'size' => 6,
					'eval' => '',
			),
		),
		'rating' => array(
			'exclude' => 0,
			'label' => $nj_ext_lang_file . 'label.model.'.$nj_domain.'.rating',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'int'
			),
		),
	),
	'types' => array(
		'0' => array('showitem' =>
			'crdate,rating,voter,ip'
		)
	),
	'palettes' => array(
		//'1' => array('showitem' => 'l18n_parent'),
	),
);