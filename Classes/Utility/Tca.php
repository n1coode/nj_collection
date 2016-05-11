<?php
namespace N1coode\NjCollection\Utility;

/**
 * @author n1coode
 * @package nj_collection
 */
class Tca
{
	var $nj_ext_key			= \N1coode\NjCollection\Utility\Constants::NJ_EXT_KEY;
	var $nj_ext_namespace	= \N1coode\NjCollection\Utility\Constants::NJ_EXT_NAMESPACE;
	var $nj_ext_path 		= \N1coode\NjCollection\Utility\Constants::NJ_EXT_PATH;
	var $nj_ext_title 		= \N1coode\NjCollection\Utility\Constants::NJ_EXT_TITLE;
	var $nj_ext_lang_file	= \N1coode\NjCollection\Utility\Constants::NJ_EXT_LANG_FILE_BACKEND;
	
	var $contentUid;
	

	const DEVICE_DESKTOP = 'desktop';
	const DEVICE_TABLET = 'tablet';
	const DEVICE_MOBILE = 'mobile';
	
	const ORIENTATION_PORTRAIT = 'portrait';
	const ORIENTATION_LANDSCAPE = 'landscape';
	
	
	public function getCodeLanguages($config)
	{
		$enabledLangStr = '';
		$enabledLangArr = array();
		$rejectLanguages = FALSE;
		
		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['nj_collection']);
		
		if(isset($extConf['codeLangEnabled']))
		{
			$enabledLangStr = $extConf['codeLangEnabled'];
			
			if($enabledLangStr !== '')
			{
				if(strpos($enabledLangStr, '*') === FALSE)
				{
					$rejectLanguages = TRUE;
					$enabledLangArr = explode(',',$enabledLangStr);
				}
			}
		}
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($enabledLangArr);
		$langTmp = array();
		 
		try 
		{
			$geshi = new \N1coode\NjCollection\Lib\GeSHi\GeSHi();
			$langList = $geshi->get_supported_languages(TRUE);
	
			foreach($langList as $langKey => $langName) 
			{
				$add = FALSE;
				if($rejectLanguages === TRUE)
				{
					if(in_array(strtolower($langKey), $enabledLangArr))
					{
						$add = TRUE;
					}
				}
				else 
				{
					$add = TRUE;
				}
				if($add) $langTmp[ucfirst($langName)] = array(0 => $langName, 1 => $langKey);
			}
		}
		catch(Exception $e)
		{
			$config['items'] = array(0 => 'Error Itemproc', 1 => 'Error');
		}
		
		//array_multisort($jahrgang, SORT_DESC, $nachname, SORT_ASC, SORT_STRING, $config);
		
		ksort($langTmp);
		foreach($langTmp as $key => $value)
		{
			$config['items'][] = $value;
		}
		
		//$config['items']
		
		return ksort($config);
	}
	
	
    public function getL18nParent($config)
    {	
        $optionList = array();

        if($config['row']['l18n_parent'] > 0)
        {
            $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                'uid',
                $config['table'],
                'pid IN ('.$config['row']['pid'].') AND uid IN ('.$config['row']['l18n_parent'].')',
                '',
                '',
                ''
            );
            while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))
            {
                $optionList[] = array(0 => $row['title'], 1 => $row['uid']);
            }
        }

        $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
            'uid',
            $config['table'],
            'pid IN ('.$config['row']['pid'].') AND sys_language_uid IN (0,-1)',
            '',
            '',
            ''
        );

        $items = array();
        while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) 
        {
            $items[] = array('title' => $row['title'], 'uid' => $row['uid']);
        }

        foreach($items as $item)
        {
            $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                'uid',
                $config['table'],
                'pid IN ('.$config['row']['pid'].') AND l18n_parent IN ('.$item['uid'].')',
                '',
                '',
                ''
            );

            if($GLOBALS['TYPO3_DB']->sql_num_rows($res) < 1)
            {
                $optionList[] = array(0 => $item['title'], 1 => $item['uid']);
            }
        }
        $config['items'] = array_merge($config['items'], $optionList);
        
        return $config;

    } //end of function getL18nParent
	
    
    public function infoText($PA, $fObj)
    {
        $formField  =	'<div class="typo3-message message-information">';
        $formField .= 	\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($PA['parameters']['text'], 'nj_collection');
        $formField .=	'</div>';

        return $formField;

    } //end of function infoText
	 
	 
    public function isMultiLingual($PA, $fObj) 
    {
        $tmp = 0;

        $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
            'uid',
            'sys_language',
            'hidden IN (0)',
            '',
            '',
            ''
        );

        if($GLOBALS['TYPO3_DB']->sql_num_rows($res) > 0) $tmp = 1;

        return $tmp;
    }
	 
    /**
     * 
     * @param type $PA
     * @param type $fObj
     */
    public function selectOptionsIcons($config)
    {
        $icons = array(
            'adjust',
            'archive',
            'area-chart',
            'arrows',
            'arrows-h',
            'arrows-v',
            'asterisk',
            'at',
            'automobile',
            'ban',
            'bank',
            'bar-chart',
            'bar-chart-o',
            'barcode',
            'bars',
            'bed',
            'beer',
            'bell',
            'bell-o',
            'bell-slash',
            'bell-slash-o',
            'bicycle',
            'binoculars',
            'birthday-cake',
            'bolt',
            'bomb',
            'book',
            'bookmark',
            'bookmark-o',
            'briefcase',
            'bug',
            'building',
            'building-o',
            'bullhorn',
            'bullseye',
            'bus',
            'cab',
        );
        
        $optionList = array();
        foreach($icons as $icon)
        {
            $optionList[] = array(0 => ucfirst($icon), 1 => 'fa fa-'.$icon);
        }
        
        $config['items'] = array_merge($config['items'], $optionList);
        return $config;  
         
    } //end of function selectOptionsIcons
    
	
    function fontAwesomeIconList($PA, $fObj) 
    {
		//TODO still bound to nj_internship
		
		
		
       // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($PA['row']['icon']);
        $icons = array(
            'adjust',
            'ambulance',
            'archive',
            'area-chart',
            'arrows',
            'arrows-h',
            'arrows-v',
            'asterisk',
            'at',
            'automobile',
            'ban',
            'bank',
            'bar-chart',
            'barcode',
            'bars',
            'bed',
            'beer',
            'bell',
            'bell-slash',
            'bicycle',
            'binoculars',
            'birthday-cake',
            'bolt',
            'bomb',
            'book',
            'bookmark',
            'briefcase',
            'bug',
            'building',
            'bullhorn',
            'bullseye',
            'bus',
            'cab',
            'calculator',
            'calendar',
            'camera',
            'camera-retro',
            'car',
            'cart-arrow-down',
            'cart-plus',
            'cc',
            'certificate',
            'check',
            'check-circle',
            'check-square',
            'child',
            'circle',
            'circle-thin',
            'close',
            'cloud',
            'cloud-download',
            'cloud-upload',
            'code',
            'code-fork',
            'coffee',
            'cog',
            'cogs',
            'comment',
            'comments',
            'compass',
            'copyright',
            'credit-card',
            'crop',
            'crosshairs',
            'cube',
            'cubes',
            'cutlery',
            'dashboard',
            'database',
            'desktop',
            'diamond',
            'download',
            'edit',
            'ellipsis-h',
            'ellipsis-v',
            'envelope',
            'envelope-square',
            'eraser',
            'exchange',
            'exclamation',
            'exclamation-circle',
            'exclamation-triangle',
            'external-link',
            'external-link-square',
            'eye',
            'eye-slash',
            'eyedropper',
            'fax',
            'female',
            'fighter-jet',
            'file',
            'file-text',
            'film',
            'filter',
            'fire',
            'fire-extinguisher',
            'flag',
            'flag-checkered',
            'flash',
            'flask',
            'folder-open',
            'gamepad',
            'gavel',
            'gear',
            'gears',
            'genderless',
            'gift',
            'glass',
            'globe',
            'graduation-cap',
            'group',
            'headphones',
            'heart',
            'heartbeat',
            'history',
            'home',
            'hotel',
            'image',
            'inbox',
            'info',
            'info-circle',
            'institution',
            'key',
            'language',
            'laptop',
            'leaf',
            'legal',
            'level-down',
            'level-up',
            'life-bouy',
            'life-buoy',
            'life-ring',
            'life-saver',
            'line-chart',
            'location-arrow',
            'lock',
            'magic',
            'magnet',
            'mail-forward',
            'mail-reply',
            'mail-reply-all',
            'male',
            'map-marker',
            'microphone',
            'microphone-slash',
            'minus',
            'minus-circle',
            'minus-square',
            'mobile',
            'mobile-phone',
            'money',
            'mortar-board',
            'motorcycle',
            'music',
            'navicon',
            'paint-brush',
            'paper-plane',
            'paw',
            'pencil',
            'pencil-square',
            'phone',
            'phone-square',
            'photo',
            'pie-chart',
            'plane',
            'plug',
            'plus',
            'plus-circle',
            'plus-square',
            'power-off',
            'print',
            'puzzle-piece',
            'qrcode',
            'question',
            'question-circle',
            'quote-left',
            'quote-right',
            'random',
            'recycle',
            'refresh',
            'remove',
            'reorder',
            'reply',
            'reply-all',
            'retweet',
            'road',
            'rocket',
            'rss',
            'rss-square',
            'search',
            'search-minus',
            'search-plus',
            'send',
            'server',
            'share',
            'share-alt',
            'share-alt-square',
            'share-square',
            'shield',
            'ship',
            'shopping-cart',
            'sign-in',
            'sign-out',
            'signal',
            'sitemap',
            'sliders',
            'sort',
            'sort-alpha-asc',
            'sort-alpha-desc',
            'sort-amount-asc',
            'sort-amount-desc',
            'sort-asc',
            'sort-desc',
            'sort-down',
            'sort-numeric-asc',
            'sort-numeric-desc',
            'sort-up',
            'space-shuttle',
            'spinner',
            'spoon',
            'square',
            'star',
            'star-half',
            'star-half-empty',
            'star-half-full',
            'street-view',
            'subway',
            'suitcase',
            'support',
            'tablet',
            'tachometer',
            'tag',
            'tags',
            'tasks',
            'taxi',
            'terminal',
            'thumb-tack',
            'thumbs-down',
            'thumbs-up',
            'ticket',
            'times',
            'times-circle',
            'tint',
            'toggle-down',
            'toggle-left',
            'toggle-off',
            'toggle-on',
            'toggle-right',
            'toggle-up',
            'train',
            'trash',
            'tree',
            'trophy',
            'truck',
            'tty',
            'umbrella',
            'university',
            'unlock',
            'unlock-alt',
            'unsorted',
            'user',
            'user-plus',
            'user-secret',
            'users',
            'video-camera',
            'volume-down',
            'volume-off',
            'volume-up',
            'warning',
            'wheelchair',
            'wifi',
            'wrench',
        );
        
        $formField  = '<div id="n1iconList" class="clearfix">';
       
        //$formField .= 	\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($PA['parameters']['text'], 'nj_internship');
       
        foreach($icons as $icon)
        {
            $formField .= '<div name="'.$icon.'"';
            
            if('fa-'.$icon === $PA['row']['icon'])
            {
                $formField .= ' class="selected"';
            }
            
            $formField .= '><i class="fa fa-'.$icon.' fa-3x';

            $formField .= '"></i>'.$icon.'</div>';
        }
        
        $formField .=	'</div>';
       
        $formField .= '<script>';
        $formField .= '
            (function($) 
            {
                $(function() 
                {
                    $(document).ready(function()
                    {
                        $("#n1iconList > DIV").click(function()
                        {
                            if(!$(this).hasClass("selected"))
                            {
                                $("input[name*=icon]").val("fa-"+$(this).attr("name")); 

                                typo3form.fieldGet("data[tx_njinternship_domain_model_direction][1][icon]","trim","",0,"");
                                TBE_EDITOR.fieldChanged("tx_njinternship_domain_model_direction","1","icon","data[tx_njinternship_domain_model_direction][1][icon]");

                                $("#n1iconList > DIV").each(function() {
                                    $(this).removeClass("selected");
                                });
                                $(this).addClass("selected");
                            }
                        });

                    });
                });
            })(TYPO3.jQuery);
        ';
        $formField .= '</script>';
        
        $formField .= '<link rel="stylesheet" type="text/css" href="../typo3conf/ext/nj_internship/Resources/Public/Css/Lib/font-awesome/4.3.0/css/font-awesome.min.css"></link>';
        $formField .= '<style>'
            . '#n1iconList > DIV { font-size: 10px; float: left; margin-right: 10px; text-align: center; width: 100px; margin-bottom: 10px; padding: 5px; } '
            . '#n1iconList > DIV:hover { background-color: #999999; color:black; cursor: pointer; } '
            . '.selected, .selected:hover { background-color: #222222 !important; color:#efefef !important; } '
            . '.selected, #n1iconList > DIV:hover { -webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px; } '
            . '.selected:hover { cursor:default !important; }'
            . '.fa{display:block; text-align:center; }'
            . '</style>';
        
        return $formField;
    }
    
	
	public function deviceSelection($PA, $fObj)
    {
		$this->contentUid = $PA['row']['uid'];
		
		$devices = [
			0 => self::DEVICE_DESKTOP,
			1 => self::DEVICE_TABLET,
			2 => self::DEVICE_MOBILE
		];
		
		$container = 'n1deviceList';
		
		$selectorContainter = '#'.$container;
		$selectorDevice = $selectorContainter.' .device';
		$selectorInputDevice = '\'input[name*="data[tt_content]['.$this->contentUid.'][tx_njcollection_device]"]\'';
		$selectorInputOrientation = '\'input[name*="data[tt_content]['.$this->contentUid.'][tx_njcollection_orientation]"]\'';
		$selectorCheckboxOrientation = '\'input:hidden[name="data[tt_content]['.$this->contentUid.'][tx_njcollection_orientation_enable]"]\'';
        $formField  = '<div id="'.$container.'" class="clearfix" style="display:block;">';
		$selectorOrientation = $selectorDevice.' .orientation';
		$selectorOrientationOption = $selectorOrientation.' .option';
		
		function createIcon($icon,$size=1, $round=0)
		{
			$return .= '<i class="fa fa-'.$icon;
			if ($size > 1) {
				$return .= ' fa-' . $size . 'x';
			}
			if($round > 0)
			{
				$return .= ' round';
			}
			$return .= '"></i>';
			return $return;
		}
		
		
		function createOrientation($device,$orientation,$label)
		{
			$return .= '<span class="option '.$orientation.'" name="'.$device.'-'.$orientation.'" title="'.$label.'">';
			$return .= createIcon($device,2,1);
			$return .= '</span>';
			return $return;
		}
		
		
		$i = 0;
		foreach($devices as $device)
        {
			$formField .= '<div class="device" name="'.$device.'">';
            $formField .= '<div class="selection">';
            $formField .= '<div class="icon" style="text-align:center;">';
			
			$formField .= createIcon($device,3,1);
			
			$formField .= '</div>';
			$formField .= '<div class="label" style="text-align:center;">'. \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($this->nj_ext_lang_file.'tt_content.device.select.'.$device,$this->nj_ext_path).createIcon("check").'</div>';
			
			$formField .= '</div>'; //end of div.selection
			
			if($device !== self::DEVICE_DESKTOP)
			{
				//start orientation			
				$formField .= '<div class="orientation">';
			
				//$formField .= '<div class="toggle clearfix">'.createIcon("toggle-off",2).createIcon("toggle-on",2).'<span style="font-size: 10px;">'.\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($this->nj_ext_lang_file.'tt_content.device.orientation.toggle',$this->nj_ext_path).'</span><span class="status"><i class="fa fa-check"></i></span></div>';
				
				$formField .= createOrientation($device,self::ORIENTATION_PORTRAIT,\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($this->nj_ext_lang_file.'tt_content.device.orientation.select.'.self::ORIENTATION_PORTRAIT,$this->nj_ext_path));
				$formField .= createOrientation($device,self::ORIENTATION_LANDSCAPE,\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($this->nj_ext_lang_file.'tt_content.device.orientation.select.'.self::ORIENTATION_LANDSCAPE,$this->nj_ext_path));
			
				$formField .= '</div>'; //end of class orientation
				//end orientation
			}
			
			$formField .= '</div>'; //end of div.device
			$i++;
        }
		$formField .= '<link rel="stylesheet" type="text/css" href="../typo3conf/ext/'.$this->nj_ext_path.'/Resources/Public/Css/Lib/font-awesome/4.4.0/css/font-awesome.min.css"></link>';
		
		$formField .= '<style>'
			.'.clearfix:after {content: "";display: block;height: 0;clear: both;visibility: hidden;}'
			.$selectorDevice.' { float: left; width: 125px; margin-right: 9px; white-space: normal; }'
			.$selectorDevice.' .selection .icon { padding: 0 15px; }'
			.$selectorDevice.' .selection .label { padding: 7.5px 0 0; }'
			.$selectorDevice.' .icon I { width:75px;height:75px;line-height:75px; background-color:white; color:silver; }'
			.$selectorDevice.' .label I { display: none; color: #36bd33; margin-left: 5px; }'
			.$selectorDevice.'.selected .selection .icon I { background-color: #5ABC55; color: #D6EED5; }'
			.$selectorDevice.'.selected .selection .label { font-weight: bold; } '.$selectorDevice.'.selected .label I { display: initial; }'
			.$selectorDevice.' .selection .icon:hover I, '.$selectorDevice.' .orientation .option:hover I { background-color: black; color: white; cursor: pointer; }'
			.$selectorDevice.' .orientation { display: none; margin-top: 12.5px; padding-top: 12.5px; border-top: 1px solid silver; text-align: center; }'
			.$selectorDevice.' .orientation .option {}'
			.$selectorDevice.' .orientation .option:last-child { margin-left: 5px; }'
			.$selectorDevice.' .orientation .option I { width:37.5px;height:37.5px;line-height:37.5px; background-color: white; color: silver; }'
			.$selectorDevice.' .orientation .option.landscape I { -webkit-transform: rotate(90deg);-moz-transform: rotate(90deg);-ms-transform: rotate(90deg);-transform: rotate(90deg); }'
			.$selectorDevice.' .orientation .option.selected I { background-color: #9BC4ED; color: #658FBE; }'
			.$selectorDevice.'.selected .selection .icon:hover I { background-color: black; color: white; }'
			.$selectorDevice.' .round { -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; }'
			. '</style>';
		
		 
		$formField .= '<script>';
        $formField .= '
            (function($) 
            {
                $(function() 
                {

                    

            })(TYPO3.jQuery);
        ';
        $formField .= '</script>';
		
		
		$formField .= '</div>';

        return $formField;

    }
	
} //end of class Tca     