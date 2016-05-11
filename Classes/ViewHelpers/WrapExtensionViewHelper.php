<?php
/*                                                                        *
 * This script belongs to the TYPO3 package "nj_collection".              *

 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *

 *                                                                        */
namespace N1coode\NjCollection\ViewHelpers;

/**
 * DESCRIPTION: This wrapper can be used to wrap the main "container" of a website.
 * The wrap will end in following sheme:
 * <section id="id" class="n1main n1section" ...>
 *		<div class="n1con">
 *			<div class="n1main n1wrapper">
 *				given child content
 *			</div>
 *		</div>
 * </section>
 * 
 * @author n1coo.de
 * @package nj_collection
 */
class WrapExtensionViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{	
	/**
	 * @var boolean
	 */
	protected $escapeChildren = FALSE;

	/**
	 * @var boolean
	 */
	protected $escapeOutput = FALSE;
	
	/**
	 * @var array
	 */
	private $data;
	
	/**
	 * @var string
	 */
	private $output;
	
	/**
	 * @var boolean
	 */
	private $wrapEnabled = FALSE;
	
	
	public function initializeArguments() {
		$this->registerArgument('additional', 'array', 'Additional classes.',FALSE,NULL);
		$this->registerArgument('settings', 'array', 'Extension settings.',FALSE,NULL);
		$this->registerArgument('alternateAction', 'string', 'Exchanges the action (in $settings), if set.',FALSE,NULL);
		//$this->registerArgument('value', 'mixed', 'The value to output', FALSE, NULL);
	}
	
	
	/**
	 * @return string
	 */
	public function render() 
	{		
		// *** get page data
		$this->data = $this->templateVariableContainer->get('data');
		
		if($this->arguments['settings'] !== NULL && is_array($this->arguments['settings']))
		{
			$this->wrapEnabled = TRUE;
		}
		
		if($this->wrapEnabled)
		{
			$this->output .= '<div class="';
			$this->output .= $this->arguments['settings']['key'];
			$this->output .= ' ' .$this->arguments['settings']['domain'];
			
			if($this->arguments['alternateAction'] !== NULL && $this->arguments['alternateAction'] !== '')
			{
				$this->output .= ' ' .$this->arguments['alternateAction'];
			}
			else
			{
				$this->output .= ' ' .$this->arguments['settings']['action'];
			}
			
			
			if(isset($this->arguments['settings']['version']))
			{
				$this->output .= ' ' .$this->arguments['settings']['version'];
			}
			
			$this->addAdditionalClasses();
			
			$this->output .= ' clearfix';
			$this->output .= '">';
		}
		
		$this->output .= $this->renderChildren();
		
		if($this->wrapEnabled)
		{
			$this->output .= '</div>';
		}
		
		return $this->output;
	}
	
	/**
	 * @return void
	 */
	private function addAdditionalClasses()
	{
		if($this->arguments['additional'] !== NULL && is_array($this->arguments['additional']))
		{
			foreach($this->arguments['additional'] as $className)
			{
				$this->output .= ' ' . $className;
			}
		}
	}
}