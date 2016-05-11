<?php
namespace N1coode\NjCollection\ViewHelpers;

/**
 * @see \TYPO3\CMS\Fluid\Core\Parser\SyntaxTree\ViewHelperNode::convertArgumentValue()
 * @api
 */
class IsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper 
{
	const _CASE_TYPE_ARRAY = 'array';
	const _CASE_TYPE_STRING = 'string';
	
	
	public function initializeArguments() {
		$this->registerArgument('object', 'mixed', 'Object to check.',FALSE,NULL);
		$this->registerArgument('type', 'string', 'Type of the object.',FALSE,NULL);
	}
	
	/**
	 * renders <f:then> child if $condition is true, otherwise renders <f:else> child
	 * @return string the rendered string
	 */
	public function render() 
	{
		if($this->arguments['object'] !== NULL && $this->arguments['type'] !== NULL)
		{
			$then = false;
			switch($this->arguments['type']){
				case self::_CASE_TYPE_ARRAY:
					$then = is_array($this->arguments['object']);
					break;
				default:
					$then = false;
			} //end of switch(type)
			
			if ($then) {
				return $this->renderThenChild();
			} 
			else {
				return $this->renderElseChild();
			}
		}
		else
		{
			return 'Fehlerhafter ViewHelper-Aufruf. Bitte typ und object angeben.';
		}
	}
}