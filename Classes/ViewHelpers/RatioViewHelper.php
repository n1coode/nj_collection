<?php
namespace N1coode\NjCollection\ViewHelpers;

/**
 * @author n1coode
 * @package nj_collection
 */
class RatioViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 *	Description
	 *
	 * @param string $get
	 * @param int $input
	 * @param string $ratio
	 * @return int
	 */
	public function render($input = NULL, $ratio = '16:9', $get = 'height')
	{	
		
		$tmp;
		
		if($input !== NULL && is_numeric($input))
		{
			switch($ratio)
			{
				case '4:3':
					if($get === 'height')
					{
						$tmp = ($input * 3) / 4;
					}
					else
					{
						$tmp = ($input * 4) / 3;
					}
					break;
				default:
					if($get === 'height')
					{
						$tmp = ($input * 9) / 16;
					}
					else
					{
						$tmp = ($input * 16) / 9;
					}
			}
		}
		return $tmp;
	}
}