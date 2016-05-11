<?php
namespace N1coode\NjCollection\ViewHelpers;

/**
 * @author n1coode
 * @package nj_collection
 */
class ArrayViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 * @param array $inputArray
	 * @param string $key
	 * @return string
	 */
	public function render($inputArray = NULL, $key = NULL) 
	{
		if (is_array($inputArray)) 
		{
			if(is_string($key))
			{
				return $inputArray[$key];
			}	
		}
		return ''; 
	}
}