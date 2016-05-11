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
class ContentWrapViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{	
	const _CLASS_CONTAINER	= "n1con";
	const _CLASS_MAIN		= "n1main";
	const _CLASS_PREFIX		= "n1";
	const _CLASS_SECTION	= "n1section";
	const _CLASS_WRAPPER	= "n1wrapper";
	
	/**
	 * @var string 
	 */
	private $class = '';
	
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
	private $style = '';
	
	
	/**
	 * Wraps content.
	 * 
	 * @param string $additionalClass
	 * @param array $args
	 * @param string $id
	 * @param boolen $isContentElement
	 * @param string $dataDevice
	 * @param string $dataLayout
	 * @param string $dataRole
	 * @param string $dataOrientation
	 * @param boolean $noWrap No wrap at all (n1section + innerWrap)
	 * @param string $style
	 * @param boolean $wrapEnable
	 * 
	 * @api
	 */
	public function render(
		$additionalClass = null,	
		$args = [], 
		$id = null,
		$isContentElement = true,
		$dataDevice = null,
		$dataLayout = null,
		$dataRole = null,
		$dataOrientation = null,
		$noWrap = false,
		$style = null,
		$wrapEnable = false
	) 
	{	
		
		$ret = '';
		
		if(!$noWrap)
		{
			// ***** CLASS *****
			if($wrapEnable)
			{
				$this->class .= self::_CLASS_MAIN . ' ' . self::_CLASS_SECTION; 
			}
			if($args['tx_njcollection_class_enable'] == 1)
			{
				$this->class .= " " . $args['tx_njcollection_class'];
			}

			if(isset($args['tx_njcollection_alignment']))
			{
				switch($args['tx_njcollection_alignment'])
				{
					case 0: $this->class .= ' left';break;
					case 1: $this->class .= ' center';break;
					case 2: $this->class .= ' right';break;
					case 3: $this->class .= ' justify';break;
					default:;
				}
			}
				
			
			
			// ***** STYLE *****
			if(intval($args['tx_njcollection_bgcolor_enable']) > 0 && $args['tx_njcollection_bgcolor'] !== '')
			{
				$this->style .= 'background-color: ' . $args['tx_njcollection_bgcolor'] . ';';
			}

			if($args['tx_njcollection_style_enable'] == 1)
			{
				if(strlen($this->style) > 0) { $this->style .= " "; }
				$this->style .= $args['tx_njcollection_style'];
			}
			
			
			
			// ***** RENDER WRAPPER *****
			$i = 0;

			$ret .= '<div';

			if($this->class !== '')
			{
				$ret .= ' class="'.$this->class.'"'; 
			}


			if($id)
			{
				$ret .= ' id="' .$id . '"'; 
			}

			if($dataLayout)
			{
				$ret .= ' data-layout="' . $dataLayout . '"'; 
			}


			if($this->style !== '')
			{
				$ret .= ' style="' . $this->style . '"';
			}


			$ret .= '>'; $i++;


			if($wrapEnable)
			{
				$ret .= '<div class="' . self::_CLASS_MAIN . ' ' . self::_CLASS_CONTAINER . '">';$i++;
				$ret .= '<div class="' . self::_CLASS_MAIN . ' ' . self::_CLASS_WRAPPER . ' clearfix">';$i++;
			}

			if($isContentElement === true)
			{
				if($args !== null && $args['header'] !== '' && intval($args['header_layout']) !== 100)
				{
					if($args['header_layout'] != '100')
					{
						$headlineLayout = 'h2';
						
						switch($args['header_layout']) 
						{
							case '2':
								$headlineLayout = 'h3';
								break;
							case '3':
								$headlineLayout = 'h4';
								break;
							case '4':
								$headlineLayout = 'h5';
								break;
							default:;
						}
						
						$ret .= '<div class="title">';
						$ret .= '<'.$headlineLayout.'>' . $args['header'] . '</'.$headlineLayout.'>';
						$ret .= '</div>';
					}
				}
			}

			$ret .= $this->renderChildren();
			
			do {
				$ret .= '</div>';
				
				$i--;
				
			} 
			while($i > 0);
			
		} //end of if($noWrap)
		else
		{
			$ret .= $this->renderChildren();
		}
		
		
		return $ret;
	}
	
} //end of class N1coode\NjCollection\ViewHelpers\WrapperViewHelper