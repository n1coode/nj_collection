<?php
namespace N1coode\NjCollection\ViewHelpers;

/**
 * @author n1coode
 * @package nj_collection
 */
class InputArgumentsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 * Description
	 *
	 * @param array $args
	 * @return array
	 */
	public function render($args = [])
	{
            $tmp = [];
            
			$today = date('Y-m-d');
			
			if(isset($args['min']) && $args['min'] !== '')
			{
				if($minimum !== 'today')
				{
					$tmp['min'] = date('Y-m-d',strtotime($today." ".$args['min']));
				}
				else {
					$tmp['min'] = $today;
				}
			}
			
			
			if(isset($args['max']) && $args['max'] !== '')
			{
				if($minimum !== 'today')
				{
					$tmp['max'] = date('Y-m-d',strtotime($today." ".$args['max']));
				}
				else {
					$tmp['max'] = $today;
				}
			}
			
			
			
			if(array_key_exists('additionalArguments',$args))
			{
				if(isset($args['additionalArguments']['spellcheck']) && $args['additionalArguments']['spellcheck'] !== '')
				{
					$tmp['spellcheck'] = $args['additionalArguments']['spellcheck'];
				}
			
				if(isset($args['additionalArguments']['autocomplete']) && $args['additionalArguments']['autocomplete'] !== '')
				{
					$tmp['autocomplete'] = $args['additionalArguments']['autocomplete'];
				}
			}
			
			if(array_key_exists('mandatory', $args))
			{
				if($args['mandatory'] !== FALSE)
				{
					$tmp['mandatory'] = 1;
				}
			}
			
            return $tmp;
	}
	
} //end of class N1coode\NjCollection\ViewHelpers\IsInArrayViewHelper

