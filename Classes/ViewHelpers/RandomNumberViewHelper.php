<?php
namespace N1coode\NjCollection\ViewHelpers;

/**
 * @author n1coode
 * @package nj_collection
 */
class RandomNumberViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 * 
	 * @param int $minimum
	 * @param int $maximum
	 * @param boolean $isIterator
	 * @return int $returnNumber
	 */
	public function render($minimum = 1, $maximum = 9999, $isIterator = FALSE)
	{
		$returnNumber = 0;
		
		if($isIterator)
		{
			if($maximum > 1)
			{
				$returnNumber = \mt_rand(0, ($maximum - 1));
			}
			else {
				$returnNumber = 0;
			}
		}
		else
		{
			if(is_int($minimum) && is_int($maximum)) 
			{
				$returnNumber = \mt_rand($minimum, $maximum);
			}
			else {
				$returnNumber = 1;
			}
		}
		
		return $returnNumber;
	}
}