<?php
namespace N1coode\NjCollection\ViewHelpers;

/**
 * @author n1coode
 * @package nj_collection
 */
class DivClassViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 *	Description
	 *
	 * @param array $ext
	 */
	public function render($ext = NULL)
	{
		$tmp = '';
		if($ext != NULL && is_array($ext))
		{
			if(isset($ext['key'])&&!empty($ext['key']))
			{
				$tmp .= $ext['key'];
			}
			if(isset($ext['domain'])&&!empty($ext['domain']))
			{
				$tmp .= $this->insertSpacer($tmp);
				$tmp .= $ext['domain'];
			}
			if(isset($ext['action'])&&!empty($ext['action']))
			{
				$tmp .= $this->insertSpacer($tmp);
				$tmp .= $ext['action'];
			}
		}
		
		return $tmp;
	}
	
	/**
	 * @param string $tmp
	 */
	protected function insertSpacer($tmp)
	{
		if (\strlen($tmp) > 0) 
		{
			return ' ';
		}
		return '';
	}
}