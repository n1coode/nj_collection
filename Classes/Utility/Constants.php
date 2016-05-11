<?php
namespace N1coode\NjCollection\Utility;

/**
 * @author n1coode
 * @package nj_collection
 */
class Constants
{ 
	const NJ_AJAX_PAGETYPE	= '652655328';
	const NJ_EXT_DOMAIN		= 'N1coode';
	const NJ_EXT_KEY        = 'tx_njcollection';
	const NJ_EXT_NAMESPACE	= 'NjCollection';
	const NJ_EXT_PATH       = 'nj_collection';
    const NJ_EXT_TITLE      = 'njs Collection';
	const NJ_EXT_LANG_FILE_FRONTEND	= 'LLL:EXT:nj_collection/Resources/Private/Language/locallang.xlf:';
	const NJ_EXT_LANG_FILE_BACKEND	= 'LLL:EXT:nj_collection/Resources/Private/Language/locallang_db.xlf:';
	
	
    public static function getNjExtkeyLang()
    {
        return self::NJ_EXTKEY_LANG;
    }

    public static function getNjExtNamespace()
    {
        return self::NJ_EXT_NAMESPACE;
    }

    public static function getNjExtTitle()
    {
        return self::NJ_EXT_TITLE;
    }

    public static function getNjExtKey()
    {
        return self::NJ_EXT_KEY;
    }

    public static function getNjExtPath()
    {
        return self::NJ_EXT_PATH;
    }
	
} //end of class constants