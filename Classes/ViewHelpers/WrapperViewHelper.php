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
 * @author n1coode
 * @package nj_collection
 */
class WrapperViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{	
	const _CLASS_CONTAINER	= "n1con";
	const _CLASS_MAIN		= "n1main";
	const _CLASS_PREFIX		= "n1";
	const _CLASS_SECTION	= "n1section";
	const _CLASS_WRAPPER	= "n1wrapper";
	
	/**
	 * @var string 
	 */
	private $dataDevice = '';
	
	/**
	 * @var string 
	 */
	private $dataRole = '';
	
	/**
	 * @var string 
	 */
	private $dataOrientation = '';
	
	
	/**
	 * @var string
	 */
	private $wrapperId = '';
	
	/**
	 * @var string
	 */
	private $wrapperClass = '';
	
	/**
	 * @var string
	 */
	private $wrapperStyle = '';
	
	
	/**
	 * Wraps content.
	 * 
	 * @param string $additionalClass
	 * @param array $args
	 * @param string $id
	 * @param string $dataDevice
	 * @param string $dataRole
	 * @param string $dataOrientation
	 * @param boolean $innerWrap Wrap inner container (n1con & n1wrapper)
	 * @param boolean $noWrap No wrap at all (n1section + innerWrap)
	 * @param string $style
	 * 
	 * @api
	 */
	public function render(
		$additionalClass = null,	
		$args = [], 
		$id = null,
		$dataDevice = null,
		$dataRole = null,
		$dataOrientation = null,
		$innerWrap = true,
		$noWrap = false,
		$style = null
	) 
	{	
		
		$ret = '';
		
		//
		//div -> class
		//
		if(!$noWrap)
		{
			$this->wrapperClass = self::_CLASS_MAIN . ' ' . self::_CLASS_SECTION;
			if($additionalClass !== null) { $this->wrapperClass .= ' '; }
		}
		if($additionalClass !== null)
		{
			$this->wrapperClass .= $additionalClass;
		}
		
		//
		//div -> data-device; div -> data-orientation
		//
		if($dataDevice !== null)
		{
			$this->dataDevice = ' data-device="'.$dataDevice.'"';
			
			if($dataOrientation !== null)
			{
				$this->dataOrientation = ' data-orientation="'.$dataOrientation.'"';
			}
		}
		
		//
		//div -> data-role
		//
		if($dataRole !== null)
		{
			$this->dataRole .= ' data-role="'.$dataRole.'"';
		}
		
		//
		//div -> id
		//
		if($id !== null)
		{
			$this->wrapperId = str_replace(' ', '', $id);
		}
		else {
			if($dataRole !== null)
			{
				$this->wrapperId = self::_CLASS_PREFIX . \lcfirst(str_replace(' ', '', $dataRole));
			}
		}
		if($this->wrapperId !== '')
		{
			$this->wrapperId = ' id="'.$this->wrapperId.'"';
		}
		
		//
		//div -> style
		//
		if($style !== null)
		{
			$this->wrapperStyle = ' style="'.$style.'"';
		}
		
		
		// **** RENDER WRAPPER ****
		$i = 0;
		$ret .= '<div';
		if($this->wrapperClass !== '')
		{
			$ret .= ' class="'.$this->wrapperClass.'"';
		}
		
		$ret .= $this->dataDevice;
		$ret .= $this->dataRole;
		$ret .= $this->dataOrientation;
		$ret .= $this->style; 
		$ret .= $this->wrapperId;
		$ret .= $this->wrapperStyle;
		
		$ret .= '>'; $i++;
		
		if(!$noWrap && $innerWrap) 
		{
			$ret .= '<div class="'.self::_CLASS_MAIN.' '.self::_CLASS_CONTAINER.'">'; $i++;
			$ret .= '<div class="'.self::_CLASS_MAIN.' '.self::_CLASS_WRAPPER.'">'; $i++;
		}
		
		$ret .= $this->renderChildren();
		
		do {
			$ret .= '</div>';
			$i--;
		} 
		while($i > 0);
		
		return $ret;
	}
	
} //end of class N1coode\NjCollection\ViewHelpers\WrapperViewHelper