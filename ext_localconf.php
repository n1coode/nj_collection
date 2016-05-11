<?php
if(!defined('TYPO3_MODE')) die ('Access denied.');

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY] = unserialize($_EXTCONF);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'N1coode.'.$_EXTKEY,
    'Pi1',
    array(
		'Ajax' => 'getImages,imageGallery',
		'Contact' => 'address,form,socialMeda',
		'Header' => 'index',
		'Logo' => 'svg',
		'Carousel' => 'index',
        'ImageGallery' => 'list',
		'Testimonial' => 'list,slider',
    ),
    // non-cacheable actions
    array( 
		'Ajax' => 'getImages,imageGallery',
		'Contact' => 'address,form,socialMeda',
		'Header' => 'index',
		'Logo' => 'svg',
		'Carousel' => 'index',
        'ImageGallery' => 'list',
		'Testimonial' => 'list,slider',
    )
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem'][$_EXTKEY] = 'EXT:nj_collection/Classes/Hooks/PageLayoutView.php:N1coode\NjCollection\Hooks\PageLayoutView';