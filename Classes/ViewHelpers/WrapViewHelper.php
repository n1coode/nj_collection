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
class WrapViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{	
	const _ACTION_OPEN			= 'open';
	const _ACTION_CLOSE			= 'close';
	
	const _CLASS_PREFIX			= 'n1';
	const _CLASS_CONTAINER		= 'n1con';
	const _CLASS_MAIN			= 'n1main';
	const _CLASS_SECTION		= 'n1section';
	const _CLASS_WRAPPER		= 'n1wrapper';
	
	const _ELEMENT_SECTION		= 'section';
	const _ELEMENT_DIV			= 'div';
	
	
	
	/**
	 * @var string 
	 */
	private $class = NULL;
	
	/**
	 * @var boolean
	 */
	protected $escapeChildren = FALSE;

	/**
	 * @var boolean
	 */
	protected $escapeOutput = FALSE;
	
	/**
	 * @var boolean 
	 */
	private $excludeInlineWrapper = FALSE;
	
	/**
	 * @var array
	 */
	private $data;
	
	/**
	 * @var string
	 */
	private $dataDevice = NULL;
	
	/**
	 * @var string
	 */
	private $dataRole = NULL;
	
	/**
	 * @var string 
	 */
	private $dataOrientation = NULL;
	
	
	
	/**
	 * @var string
	 */
	private $id = NULL;

	
	/**
	 * @var string
	 */
	private $output = '';


	private $sectionType = self::_ELEMENT_SECTION;
	
	
	/**
	 * @return void
	 */
	public function initializeArguments() {
		//additionalClass = null, , , $dataRole = null, $excludeMainWrapper = 0, $id = null, $insertDataRole = 1, $args = []
		$this->registerArgument('additionalClass', 'string', 'Additional class for the main wrapper.',FALSE,NULL);
		$this->registerArgument('dataDevice', 'string', 'Attribute in the main wrapper to handle output on devices.',FALSE,NULL);
		$this->registerArgument('dataOrientation', 'string', 'Attribute in the main wrapper to handle output on devices in dependency to orientation.',FALSE,NULL);
		$this->registerArgument('dataRole', 'string', 'Attribute in the main wrapper. ID and data-role.',FALSE,NULL);
		$this->registerArgument('exludeInlineWrapper', 'boolean', 'If set to true, the inline divs (n1con & n1wrapper) will not be wrapped',FALSE, FALSE);
		$this->registerArgument('id', 'string', 'ID of the main wrapper. (If not set data-role will be used.)',FALSE,NULL);
		$this->registerArgument('sectionType', 'string', 'Type of the section: div, header, footer, section etc.',FALSE,NULL);

		//$this->registerArgument('value', 'mixed', 'The value to output', FALSE, NULL);
	}

	/**
	 * @return string
	 */
	public function render() 
	{
		// *** get page data
		$this->data = $this->templateVariableContainer->get('data');
		
		// *** render all the stuff
		$this->renderSection();
		
		return $this->output;	
	}
	
	
	
	/**
	 * @return void
	 */
	private function buildAttributeClass()
	{
		
		$this->class .= $this->tagAttributeOpen('class');
		$this->class .= self::_CLASS_MAIN . ' ' .self::_CLASS_SECTION;
		
		if ( $this->arguments['additionalClass'] !== NULL ) 
		{
			if(!$this->classAlreadyExists($this->arguments['additionalClass']))
			{
				$this->class .= ' '.$this->arguments['additionalClass'];
			}
		} 
		
		$this->class .= $this->tagAttributeClose();
	}
	
	
	/**
	 * @return void
	 */
	private function buildAttributeDataDevice()
	{
		if($this->arguments['dataDevice'] !== NULL)
		{
			$this->dataDevice .= $this->tagAttributeOpen('data-device');
			
			$this->dataDevice .= $this->arguments['dataDevice'];
			
			$this->dataDevice .= $this->tagAttributeClose();
		}
	}
	
	
	/**
	 * @return void
	 */
	private function buildAttributeDataOrientation()
	{
		if($this->arguments['dataDevice'] && $this->arguments['dataOrientation'] !== NULL)
		{
			$this->dataOrientation .= $this->tagAttributeOpen('data-orientation');
			$this->dataOrientation .= $this->arguments['dataOrientation'];
			$this->dataOrientation .= $this->tagAttributeClose();
		}
	}
	
	
	/**
	 * @return void
	 */
	private function buildAttributeDataRole()
	{
		if($this->arguments['dataRole'] !== NULL)
		{
			$this->dataRole .= $this->tagAttributeOpen('data-role');
			$this->dataRole .= $this->arguments['dataRole'];
			$this->dataRole .= $this->tagAttributeClose();
		}
	}
	
	
	/**
	 * @return void
	 */
	private function buildAttributeId()
	{
		if($this->arguments['id'] !== NULL || $this->arguments['dataRole'] !== NULL)
		{
			$this->id .= $this->tagAttributeOpen('id');
			if($this->arguments['id'] !== NULL)
			{
				$this->id .= $this->arguments['id']; 
			}
			else
			{
				if($this->arguments['dataRole'] !== NULL)
				{
					$this->id .= self::_CLASS_PREFIX . $this->arguments['dataRole'];
				}
			}
			$this->id .= $this->tagAttributeClose();
		}
	}
	
	
	/**
	 * @param string $checkClass
	 * @return boolean
	 */
	private function classAlreadyExists($checkClass)
	{
		if(strpos($this->class,$checkClass)!==false){ 
			return true;
		}
		return false;
	}

	
	/**
	 * @return void
	 */
	private function renderSection()
	{
		if($this->arguments['sectionType'] !== NULL)
		{
			$this->sectionType = $this->arguments['sectionType'];
		}
		$this->excludeInlineWrapper = $this->arguments['exludeInlineWrapper'];
		
		$elementType = $this->sectionType;
		
		// *** build attributes
		
		$this->buildAttributeClass();
		$this->buildAttributeId();
		$this->buildAttributeDataDevice();
		$this->buildAttributeDataOrientation();
		$this->buildAttributeDataRole();
		
		$this->output .= $this->elementOpener(self::_ACTION_OPEN,$elementType);
		
		// *** attributes (will only be added, if NOT NULL)
		
		$this->output .= $this->class;
		$this->output .= $this->dataDevice;
		$this->output .= $this->dataOrientation;
		$this->output .= $this->dataRole;
		$this->output .= $this->id;

		$this->output .= $this->elementOpener(self::_ACTION_CLOSE,$elementType);
		
		$this->output .= $this->renderContainer();
		
		$this->output .= $this->elementCloser($elementType);
	}
	
	/**
	 * @return void
	 */
	private function renderWrapper()
	{
		if(!$this->excludeInlineWrapper)
		{
			$this->output .= $this->elementOpener(self::_ACTION_OPEN);
			$this->output .= ' class="' . self::_CLASS_MAIN . ' ' . self::_CLASS_WRAPPER . '"';
			$this->output .= $this->elementOpener(self::_ACTION_CLOSE);
		}
		$this->output .= $this->renderChildren();
		
		if(!$this->excludeInlineWrapper)
		{
			$this->output .= $this->elementCloser();
		}
	}
	
	/**
	 * @return void
	 */
	private function renderContainer()
	{
		
		
		if(!$this->excludeInlineWrapper)
		{
			$this->output .= $this->elementOpener(self::_ACTION_OPEN);
			$this->output .= ' class="' . self::_CLASS_MAIN . ' ' . self::_CLASS_CONTAINER . '"';
			$this->output .= $this->elementOpener(self::_ACTION_CLOSE);
		}
		
		$this->output .= $this->renderWrapper();
		
		if(!$this->excludeInlineWrapper)
		{
			$this->output .= $this->elementCloser();
		}
		
	}
	
	/**
	 * Description: HOOK, to add your own attributes
	 * @return void
	 */
	public function addAttributes() {
	}

	
	/**
	 * @param string $attribute
	 * @return string
	 */
	private function tagAttributeOpen($attribute = NULL) 
	{
		if($attribute !== NULL)
		{
			return ' ' . $attribute . '="';
		}
	}
	
	/**
	 * @return string
	 */
	private function tagAttributeClose()
	{
		return '"';
	}
	
	/**
	 * @return string
	 */
	private function tagClose()
	{
		return '>';
	}
	
	/**
	 * @param string $elementType
	 * @return string
	 */
	private function tagOpen($elementType =  self::_ELEMENT_DIV)
	{
		return '<' . $elementType;
	}
	
	/**
	 * @param string $elementType
	 * @return string
	 */
	private function elementCloser($elementType =  self::_ELEMENT_DIV)
	{
		return '</' . $elementType . '>';
	}
	
	/**
	 * @param string $tagAction
	 * @param string $elementType
	 * @return string
	 */
	private function elementOpener($tagAction = self::_ACTION_OPEN, $elementType = self::_ELEMENT_DIV)
	{
		switch($tagAction)
		{
			case self::_ACTION_CLOSE:
				return $this->tagClose($elementType);
			case self::_ACTION_OPEN:
				return $this->tagOpen($elementType);
		}
	}
	
}