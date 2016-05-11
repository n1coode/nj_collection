<?php
namespace N1coode\NjCollection\ViewHelpers;

/**
 * @author n1coode
 * @package nj_collection
 */
class TextTransformViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	public function initializeArguments() {
		$this->registerArgument('text', 'string', 'Text to be transformed.',FALSE,NULL);
		$this->registerArgument('action', 'string', 'Transformation.',FALSE,NULL);
	}
	
	/**
	 *	Description
	 *	 
	 * @return string
	 */
	public function render()
	{	
		$tmp = '';
		
 		if($this->arguments['text'] !== NULL)
 		{
			switch($this->arguments['action'])
			{
				case 'lcfirst':
					$tmp = lcfirst($this->arguments['text']);
					break;
				default:
					$tmp = ucfirst($this->arguments['text']);
			}
 		}
 	
		return $tmp;
	}
} //end of class \N1coode\NjCollection\ViewHelpers\TextTransformViewHelper