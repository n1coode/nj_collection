<?php
namespace N1coode\NjCollection\Utility;

/**
 * @author n1coode
 * @package nj_collection
 */
class General
{
	const CLASS_TYPE_CONTROLLER = 'controller';

	/**
	 * @param string $string
	 * @param string $expansion
	 * @param boolean $prependEmptySpace
	 * @return string
	 */
	public static function concatString($string,$expansion,$prependEmptySpace = FALSE)
	{
		$concatenation = $string;
		if($prependEmptySpace) { $concatenation .= ' '; }
		return $concatenation . $expansion;
	}
	
	/**
	 * @param array $settingsExtension
	 * @param array $settingsFluid
	 */
	public static function getActionVersion($settingsExtension = NULL,$settingsFluid = NULL)
	{
		if(isset($settingsExtension['model'][$settingsFluid['domain']][$settingsFluid['action']]['version']))
		{
			$settingsFluid['version'] = $settingsExtension['model'][$settingsFluid['domain']][$settingsFluid['action']]['version'];
		}
		return $settingsFluid;
	} 
	
	/**
	 * 
	 * @param string $classNamespace
	 * @param string $type
	 * @return string
	 */
	public static function getShortClassName($classNamespace, $type=self::CLASS_TYPE_CONTROLLER) 
	{
		switch ($type)
		{
			case self::CLASS_TYPE_CONTROLLER:
			
				$classExplode = explode('\\',$classNamespace);
		
				if(!empty($classExplode))
				{
					$classFull=$classExplode[count($classExplode)-1];
					$class=explode('Controller',$classFull)[0];


				}
				return $class;
			default:;
		}
		return '';
	}
	
	/**
	 * @param string $functionData
	 */
	public static function getActionName($functionData)
	{
		return explode("Action", $functionData)[0];
	}
	
	
	public static function stringIsEmpty($string)
	{
		return strlen($string) > 0 ? TRUE : FALSE;
	}
}