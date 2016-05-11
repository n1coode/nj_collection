<?php
namespace N1coode\NjCollection\ViewHelpers;

/**
 * @author n1coode
 * @package nj_collection
 */
class GridViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 *	Description
	 *
	 * @param int $iteration
	 * @param int $overall
	 * @param int $cols
	 * @param string $startend
	 * 
	 * @return string
	 */
	public function render($overall = 0, $index = 0, $cols = 0, $startend=NULL)
	{
		$close = boolval($close);
		
		$overall = intval($overall);
		$index = intval($index);
		$cols = intval($cols);
		
		$tmp = '';
		$index++;
		
		
		$n = 1;
		$x = 1;
		
		$divStart = '<div class="n1col gs1of'.$cols.'"'.'>';
		$divEnd = '</div>';
		$divEmpty = $divStart.'&amp;'.$divEnd;
		$groupStart = '<div class="n1grid group">'.$divStart;
		$groupEnd = $divEnd.$divEnd;
		
		
		if($startend !== NULL)
		{
			switch($startend)
			{
				case 'start':
					$tmp .= $groupStart;
					break;
				case 'end':
					if($overall > 0 && $cols > 1 && $cols <= $overall)
					{
						$tmp .= $divEnd;
						if($overall % $cols > 0)
						{
							$x = $overall % $cols;
							
							while($x > 0)
							{
								$tmp .= $divEnd.$divStart;
								$x--;
							}
						}
						$tmp .= $groupEnd;
					}
					break;
				default:;
			}
		}
		else 
		{
			if($overall > 0 && $cols > 1 && $cols <= $overall)
			{	
				while ($x < $index)
				{
					if($n < $cols)
					{
						$n++;
					}
					elseif($n === $cols)
					{
						$n = 1;
					}
					$x++;
				}
				
				if($n < $cols) { $tmp .= $divEnd.$divStart; }
				else { $tmp .= $groupEnd.$groupStart; }
			}
		}
		
		return $tmp;
	}
}
