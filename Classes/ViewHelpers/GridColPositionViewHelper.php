<?php
namespace N1coode\NjCollection\ViewHelpers;

/**
 * @author n1coode
 * @package nj_collection
 */
class GridColPositionViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 *	Description
	 *
	 * @param int $iteration
	 * @param int $overall
	 * @param int $cols
	 * @return string
	 */
	public function render($overall = 0, $index = 0, $cols = 0)
	{
		$tmp = '';
		$index++;
		
		$n = 1;
		$x = 1;
		
		if($overall > 0 && $cols > 1 && $cols <= $overall)
		{
			do {
				
				
				if($n = $index)
				{
					break;
				}
				else {
					if($x < $cols) $x++;
					if($x === $cols) $x = 1;
					$n++;
				}
				
			} while($n < $index);
		}
		
		$tmp = $x;
		
		
		return $tmp;
	}
}