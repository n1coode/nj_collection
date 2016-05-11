<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$nj_ext_key			= 'tx_njcollection';
$nj_ext_namespace	= 'NjCollection';
$nj_ext_path		= 'nj_collection';
$nj_ext_title		= 'njs Collection';

$nj_ext_lang_file	= 'LLL:EXT:nj_collection/Resources/Private/Language/locallang_db.xlf:';

/**
 * The field to switch the types is declared in ext_tables.php
 */
$type = [];
$type['general'] =	'--div--;'.$nj_ext_lang_file.'tab.model.content.general,--palette--;;ctype,description,--palette--;;headline,';

$type['code']	=	$type['general'] . '--div--;'.$nj_ext_lang_file.'tab.model.content.code,code_lang,code,code_starting_line,--palette--;'.$nj_ext_lang_file.'label.model.content.codeHighlighting;code_highlight';
$type['text']	=	$type['general'] . 'content';
$type['text_image'] = $type['general'] . 'content,--div--;'.$nj_ext_lang_file.'tab.general.image,img,img_adjustment, img_width, img_height, img_use_thumb, img_copyright';
$type['image'] = $type['general'] . '--div--;'.$nj_ext_lang_file.'tab.general.image,img,img_adjustment, img_width, img_height, img_use_thumb, img_copyright';
$type['gallery'] = $type['general'] . '--div--;'.$nj_ext_lang_file.'tab.model.content.imageGallery,gallery';
$type['video'] = $type['general'] . '--div--;'.$nj_ext_lang_file.'tab.model.content.video,vid_type';


$type_youtube =	'--div--;LLL:EXT:nj_blog/Resources/Private/Language/locallang_db.xml:general.tabs.youtube, yt_video_id, yt_video_width, yt_ratio, yt_show_proposals, yt_allow_fullscreen, yt_additional';



$nj_domain_model = 'Content';
$nj_domain = strtolower($nj_domain_model);

return array(
	'ctrl' => array(
        'crdate' => 'crdate',
		//'default_sortby' => 'ORDER BY headline ASC',
		'delete' => 'deleted',
        'dividers2tabs' => TRUE,
		'enablecolumns' => array(
            'disabled' => 'hidden'
        ),
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($nj_ext_path) . 'Resources/Public/Icons/' . $nj_ext_key . '_domain_model_' . $nj_domain . '.svg',
		'l10n_mode' => 'mergeIfNotBlank',
        'label' => 'headline',
        'languageField' => 'sys_language_uid',
		'origUid' => 't3_origuid',
		'requestUpdate' => 'sys_language_uid,headline_hidden,content_type',
		'sortby' => 'sorting',
		'title' => $nj_ext_lang_file.'model.'.$nj_domain,
        'transOrigPointerField' => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
		'tstamp' => 'tstamp',
		'type' => 'ctype',
		'versioning_followPages' => TRUE,
		'versioningWS' => 2,        
    ),
	'feInterface' => array(
        'fe_admin_fieldList' => 'headline',
    ),
	'interface' => array(
		'always_description' => 1,
		'maxDBListItems' => 100,
		'maxSingleDBListItems' => 500,
        'showRecordFieldList' => 'sorting',
    ),
    
    'columns' => array(
        'code' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.model.content.code',
			'config' => array(
				'type' => 'text',
		        'cols' => '100',
				'format' => 'html',
				'renderType' => 't3editor',
		        'rows' => '20',
		        'wrap' => 'off',
			)
		),
		'code_highlight_class' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.model.content.codeHighlightClass',
			'config'  => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim',
				'max'  => 256
			),
		),
		'code_highlight_lines' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.model.content.codeHighlightLines',
			'config'  => array(
				'type' => 'input',
				'size' => 80,
				'eval' => 'trim',
				'max'  => 256
			),
				
		),
		'code_highlight_style' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.model.content.codeHighlightStyle',
			'config'  => array(
				'type' => 'input',
				'size' => 80,
				'eval' => 'trim',
				'max'  => 256
			),
		),
		'code_lang' => Array (
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.model.content.codeLanguage',
			'config' => array (
			'type' => 'select',
			'itemsProcFunc' => 'N1coode\\'.$nj_ext_namespace.'\\Utility\\Tca->getCodeLanguages',
			'items' => Array (
				Array('---', ''),
			),
			'maxitems' => '1',
			'minitems' => '0'
			),
		),
		'code_starting_line' => array(
			'exclude' => 0,
			'label' => $nj_ext_lang_file.'label.model.content.codeStartingLine',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'trim,int+',
				'default' => 1,
			)
		),
		'content' => array(
			'exclude' => 1,
			'label'   => $nj_ext_lang_file.'general.content',
			'defaultExtras' => 'richtext[]',
            'config'  => array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 6,
				'defaultExtras' => 'richtext[]',
			)
		),
		'ctype' => Array (
			'label'   => $nj_ext_lang_file.'label.model.'.$nj_domain.'.contentType',
			'config' => Array (
				'type' => 'select',
				'items' => array(
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.ctype.text', 'text'),
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.ctype.textImage', 'textImage'),
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.ctype.image', 'image'),
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.ctype.imageGallery', 'gallery'),
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.ctype.video', 'video'),
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.ctype.code', 'code'),
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.ctype.html', 'html'),
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.ctype.message', 'message'),
				),
				'maxitems' => 1,
				'default' => 'text',
			)
		),
		'description' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.general.description',
			'config'  => array(
				'type' => 'text',
				'eval' => 'trim',
				'cols' => 80,
				'rows' => 5
			)
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
		'gallery' => array(
			'exclude' => 0,
			'label' => $nj_collection_lang_file.'label.general.images',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('files', array(
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
				),
			), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),	
		),
		'headline' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.general.headline',
			'config'  => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
				'max'  => 256
			),
		),
		'headline_hidden' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.model.'.$nj_domain.'.headlineHide',
			'config'  => array(
					'type' => 'check'
			)
		),
		'headline_style' => Array (
			'displayCond' => 'FIELD:headline_hidden:<:1',
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.$nj_ext_key.'_domain_model_'.$nj_domain.'.headlineStyle',
			'config' => Array (
				'type' => 'select',
				'items' => array(
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.headlineStyle.3', 'h3'),
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.headlineStyle.4', 'h4'),
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.headlineStyle.5', 'h5'),
				),
				'maxitems' => 1,
				'default' => 'h3',
			)
		),
		'hidden' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type' => 'check'
            )
        ),
		'html' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.$nj_ext_key.'_domain_model_'.$nj_domain.'.html',
			'config' => array(
		        'type' => 'text',
		        'cols' => '100',
		        'rows' => '20',
		        'wrap' => 'off',
				
			),
		),
		'img' => array(
			'exclude' => 0,
			'label' => $nj_ext_lang_file.'label.general.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('files', array(
				'appearance' => array(
					'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
				),
				'maxitems' => 1
			), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),	
		),
		'img_adjustment' => Array (
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.model.content.imageAdjustment',
			'config' => Array (
				'type' => 'select',
				'items' => array(
					array($nj_ext_lang_file.'select.model.content.imageAdjustment.center', 'center'),
					array($nj_ext_lang_file.'select.model.content.imageAdjustment.left', 'left'),
					array($nj_ext_lang_file.'select.model.content.imageAdjustment.right', 'right'),
				),
				'default' => 'center',
				'maxitems' => 1,
			)
		),
		'img_copyright' => array(
			'exclude' => 0,
			'label' => $nj_ext_lang_file.'label.model.content.imageCopyright',
			'config' => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
			)
		),
		'img_height' => array(
			'exclude' => 0,
			'label' => $nj_ext_lang_file.'label.model.content.imageHeight',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'int,trim',
				'max' => 5
			)
		),
		'img_width' => array(
			'exclude' => 0,
			'label' => $nj_ext_lang_file.'label.model.content.imageWidth',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'int,trim',
				'max' => 5
			)
		),
		'img_use_thumb' => array(
			'exclude' => 0,
			'label' => $nj_ext_lang_file.'label.model.content.imageThumbnail',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'l18n_diffsource' => Array(
            'config'=>array(
                'type'=>'passthrough'
            )
        ),
        'l18n_parent' => Array (
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
            'config' => array (
                'type' => 'select',
                'multiple' => '1',
                'itemsProcFunc' => 'N1coode\\NjCollection\\Utility\\Tca->getL18nParent',
                'items' => Array (
                    Array('', 0),
                ),
                'maxitems' => '1',
                'minitems' => '0'
            ),
        ),
		'message' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.$nj_ext_key.'_domain_model_'.$nj_domain.'.message',
			'config' => array(
				'type' => 'text',
				'cols' => 100,
				'rows' => 7,
			)
		),
		'message_type' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.$nj_ext_key.'_domain_model_'.$nj_domain.'.messageType',
			'config' => Array (
				'type' => 'select',
				'items' => array(
					array($nj_ext_lang_file.$nj_ext_key.'_domain_model_'.$nj_domain.'.messageType.info', 'info'),
					array($nj_ext_lang_file.$nj_ext_key.'_domain_model_'.$nj_domain.'.messageType.error', 'error'),
					array($nj_ext_lang_file.$nj_ext_key.'_domain_model_'.$nj_domain.'.messageType.notice', 'notice'),
					array($nj_ext_lang_file.$nj_ext_key.'_domain_model_'.$nj_domain.'.messageType.success', 'success'),
					array($nj_ext_lang_file.$nj_ext_key.'_domain_model_'.$nj_domain.'.messageType.warning', 'warning'),
				),
				'maxitems' => 1,
				'default' => 'text',
			)
		),
		'sorting' => array(
			'exclude'	=> 1,
			'label'		=> 'sorting',
			'config'	=> array(
				'type' => 'input',
				'size' => 6,
				'eval' => '',
			),
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
		'tstamp' => Array (
            'exclude' => 1,
            'label' => 'Creation date',
            'config' => Array (
                'type' => 'none',
                'format' => 'date',
                'eval' => 'date',
            )
        ),
		'vid_type' => array(
			'exclude' => 0,
			'label'   => $nj_ext_lang_file.'label.model.'.$nj_domain.'.videoType',
			'config' => Array (
				'type' => 'select',
				'items' => array(
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.videoType.html5', 'html5'),
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.videoType.youtube', 'youtube'),
					array($nj_ext_lang_file.'select.model.'.$nj_domain.'.videoType.vimeo', 'vimeo'),
				),
				'maxitems' => 1,
				'default' => 'youtube',
			)
		),
		
    ),
   'types' => array(
		'0' => array('showitem' => $type['text']),
		'text' => array('showitem' => $type['text']),
		'textImage' => array('showitem' => $type['text_image']),
		'image' => array('showitem' => $type['image']),
		'gallery' => array('showitem' => $type['gallery']),
		'video' => array('showitem' => $type['video']),
		'code' => array('showitem' => $type['code']),
		'html' => array('showitem' => $type['html']),
		'message' => array('showitem' => $type['message'])
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
		'copyright' => array('showitem' => 'copyright, copyright_link,','canNotCollapse' => 1), 
		'ctype' => array('showitem' => 'ctype, hidden','canNotCollapse' => 1),
		'headline' => array('showitem' => 'headline, headline_style, headline_hidden','canNotCollapse' => 1),
		'code_highlight' => array('showitem' => 'code_highlight_lines, code_highlight_class, code_highlight_style', 'canNotCollapse' => 1)
	),
);