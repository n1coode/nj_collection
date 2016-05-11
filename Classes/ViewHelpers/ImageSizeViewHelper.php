<?php
namespace N1coode\NjCollection\ViewHelpers;
/***************************************************************
 *  Copyright notice
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * @author n1coode
 * @package nj_collection
 */
class ImageSizeViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\ImageViewHelper
{
	/**
	 * Initialize arguments.
	 *
	 * @return void
	 */
	public function initializeArguments() 
	{
		parent::initializeArguments();
		$this->registerTagAttribute('data-original', 'string', 'original image for lazy loading', FALSE);
	}
	
	
	/**
	 * @param string $src
	 * @param boolean $treatIdAsReference
	 * @param string $image
	 * @param boolean $randomize
	 * @param integer $maxWidth
	 * @return array $dimension Width and Height of the Image.
	 * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
	 */
	public function render($src = \NULL, $treatIdAsReference = \FALSE, $image = \NULL, $randomize = \FALSE, $maxWidth = 0) 
	{
		$dimensions = [];
		
		if (is_null($src) && is_null($image) || !is_null($src) && !is_null($image)) 
		{
			throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('You must either specify a string src or a File object.', 1382284106);
		}
		
		$originalImage = $this->imageService->getImage($src, $image, $treatIdAsReference)->getOriginalFile();
		$imagePath = $this->getImagePath($originalImage);
		$file = $imagePath . $originalImage->getIdentifier();
		$imageInformation = getimagesize(PATH_site .\TYPO3\CMS\Core\Utility\PathUtility::getAbsoluteWebPath($file));
		$dimensions['width'] = $imageInformation[0];
		$dimensions['height'] = $imageInformation[1];
		
		if($randomize)
		{
			if($maxWidth > 0)
			{
				$dimensions = $this->randomize($dimensions,$maxWidth); 
			}
		}
		return $dimensions;
	}
	
	/**
	 * @param \TYPO3\CMS\Core\Resource\File $image
	 * @return string $imagePath
	 */
	private function getImagePath(\TYPO3\CMS\Core\Resource\File $image)
	{
		$storage = $image->getStorage();
		$storageConfiguration = $storage->getConfiguration();
		
		$basePath =  $storageConfiguration['basePath'];
		
		if(substr($basePath, strlen($basePath)-1 ) === "/")
		{
			$basePath = \substr($basePath, 0, \strlen($basePath)-1 );
		}
		
		return $basePath;
	}
	
	/**
	 * @param array $dimensions
	 * @param int $maxWidth
	 */
	private function randomize($dimensions, $maxWidth)
	{
		
		$randomDimensions = [];
		$randomDimensions['width'] = \rand($maxWidth,$dimensions['width']);
		$randomDimensions['height'] = \rand($dimensions['height'] * 0.5,$dimensions['height']);
		
		$ratio = $randomDimensions['width'] / $dimensions['width'];
		
		
		$randomDimensions['width'] = $maxWidth;
		$randomDimensions['height'] *= $ratio;
		
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($dimensions,'dimensions');
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($randomDimensions,'random dimensions');
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($ratio);
		$randomDimensions['height'] = \round($randomDimensions['height']);
		
		$dice = rand(1,1.25);
		
		$randomDimensions['width'] *= $dice;
		$randomDimensions['height'] *= $dice;
		
				
		return $randomDimensions;
	}
	
} //end of class N1coode\NjCollection\ViewHelpers\ImageSizeViewHelper