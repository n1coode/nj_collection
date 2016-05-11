<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

$nj_ext_key			= 'tx_njcollection';
$nj_ext_namespace	= 'NjCollection';
$nj_ext_path		= 'nj_collection';
$nj_ext_title		= 'njs Collection';

$nj_ext_lang_file	= 'LLL:EXT:nj_collection/Resources/Private/Language/locallang_db.xlf:';

$nj_domain_model = 'Testimonial';
$nj_domain = strtolower($nj_domain_model);

return array(
	'ctrl' => array(
        'title' => $nj_ext_lang_file.'model.'.$nj_domain,
        'label' => 'title',
        //'l10n_mode' => 'mergeIfNotBlank',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'dividers2tabs' => TRUE,
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
		'type' => 'content_type',
        //'default_sortby' => 'ORDER BY title ASC',
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden'
        ),
        'requestUpdate' => 'sys_language_uid',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($nj_ext_path) . 'Resources/Public/Icons/' . $nj_ext_key . '_domain_model_' . $nj_domain . '.png',
    ),
	'interface' => array(
        'showRecordFieldList' => 'sorting',
		'maxDBListItems' => 100,
		'maxSingleDBListItems' => 500,
		'always_description' => 1,
    ),
	'feInterface' => array(
        'fe_admin_fieldList' => 'title',
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
        'sys_language_uid' => Array (
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
            'change' => 'reload',
            'config' => Array (
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => Array(
                    Array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
                    Array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
                )
            )
        ),

        'l18n_parent' => Array (
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
            'config' => array (
                'type' => 'select',
                'multiple' => '1',
                'itemsProcFunc' => 'N1coode\\'.$nj_ext_namespace.'\\Utility\\Tca->getL18nParent',
                'items' => Array (
                    Array('', 0),
                ),
                'maxitems' => '1',
                'minitems' => '0'
            ),
        ),
        'l18n_diffsource' => Array(
            'config'=>array(
                'type'=>'passthrough'
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type' => 'check'
            )
        ),
        'author' => array(
            'displayCond' => 'FIELD:sys_language_uid:<=:0',
            'l10n_mode' => 'exclude',
            'l10n_display' => 'hideDiff,defaultAsReadonly',
            'exclude' => 0,
            'label' => $nj_ext_lang_file.'label.model.'.$nj_domain.'.author',
            'config'  => array(
                'type' => 'input',
                'size' => 25,
                'eval' => 'trim,required',
                'max'  => 256
            )
        ),
        'firm' => array(
            'displayCond' => 'FIELD:sys_language_uid:<=:0',
            'l10n_mode' => 'exclude',
            'l10n_display' => 'hideDiff,defaultAsReadonly',
            'exclude' => 0,
            'label' => $nj_ext_lang_file.'label.model.'.$nj_domain.'.firm',
            'config'  => array(
                'type' => 'input',
                'size' => 25,
                'eval' => 'trim',
                'max'  => 256
            )
        ),
        'image' => array(
            'exclude' => 1,
            'label' => $nj_ext_lang_file.'label.general.image',
            //'l10n_mode' => 'mergeIfNotBlank',
            'l10n_mode' => 'exclude',
            'l10n_display' => 'hideDiff,defaultAsReadonly',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image', 
                array(
                    'appearance' => array(
                        'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
                    ),
                    'minitems' => 0,
                    'maxitems' => 1,
                    'foreign_match_fields' => array(
                        'fieldname' => 'image'
                    ),
            ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        ),
		'position' => array(
            'displayCond' => 'FIELD:sys_language_uid:<=:0',
            'l10n_mode' => 'exclude',
            'l10n_display' => 'hideDiff,defaultAsReadonly',
            'exclude' => 0,
            'label' => $nj_ext_lang_file.'label.model.'.$nj_domain.'.position',
            'config'  => array(
                'type' => 'input',
                'size' => 25,
                'eval' => 'trim',
                'max'  => 256
            )
        ),
        'testimonial' => array(
            'exclude' => 1,
            'label' => $nj_ext_lang_file.'label.model.'.$nj_domain.'.testimonial',
            'defaultExtras' => 'richtext[*]',
            'config'  => array(
                'type' => 'text',
                'cols' => 60,
                'rows' => 6,
                'wizards' => array(
                    '_PADDING' => 4,
                    'RTE' => array(
                        'notNewRecords'	=> 1,
                        'RTEonly'	=> 1,
                        'type' 		=> 'script',
                        'title' 	=> 'LLL:EXT:cms/locallang_ttc.php:bodytext.W.RTE',
                        'icon' 		=> 'wizard_rte2.gif',
                        'script' 	=> 'wizard_rte.php'
                    )
                )
            )
        ),
        'title' => array(
            'exclude' => 0,
            'label' => $nj_ext_lang_file.'label.general.title',
            'config'  => array(
                'type' => 'input',
                'size' => 25,
                'eval' => 'trim',
                'max'  => 256
            )
        ),
    ),
	'types' => array(
        '0' => array('showitem' => 'hidden,sys_language_uid;;1,title,author,position,firm,testimonial,image' )
    ),
    'palettes' => array(
        '1' => array('showitem' => 'l18n_parent'),
    ),
);