<?php
namespace N1coode\NjCollection\Utility;

use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileReference;

/**
 * @author n1coode
 * @package nj_collection
 */
class Image
{
	public static function exists($src, $imageService)
	{
		$imageSrcString = $imageService->getImageFromSourceString($src,1);
		
		
		if(!($imageSrcString instanceof File || $imageSrcString instanceof FileReference))
		{
			return false;
		}
		else
		{
			$imagePath = self::getImagePath($imageSrcString);
			$file = $imagePath . $imageSrcString->getIdentifier();
			return file_exists($file);
		}
	}
	
	
	/**
	 * @param \TYPO3\CMS\Core\Resource\File $image
	 * @return string $imagePath
	 */
	public static function getImagePath(\TYPO3\CMS\Core\Resource\File $image)
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
	
	
	public static function imagesToArray(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images)
	{
		$imageCollection = [];
		foreach($images as $image)
		{
			$imageCollection[] = $image;
		} 
		return $imageCollection;
	}
	
	
	/**
	 * @param array $images
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $randomImage
	 */
	public static function pickRandomImage(array $images)
	{
		if(\count($images) > 0)
		{
			$random = \rand(0, \count($images) - 1);
			return $images[$random];
		}
		
		return \NULL;
	}
	
}