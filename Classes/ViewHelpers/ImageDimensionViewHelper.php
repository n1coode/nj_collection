<?php
namespace N1coode\NjCollection\ViewHelpers;

/**
 * @author n1coode
 * @package nj_collection
 */
class ImageDimensionViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 *	Description
	 *
	 * @param int $width
	 * @param string $ratio 
	 * @return string
	 */
	public function render($width, $ratio = '16:9')
	{	
		$tmp;
 		switch($ratio)
		{
			case '4:3':
				$tmp = ($width * 3) / 4;
			default:
				$tmp = ($width * 9) / 16;
		}
 	
		return $tmp;
	}
} //end of class \N1coode\NjCollection\ViewHelpers\ImageDimensionViewHelper
?>