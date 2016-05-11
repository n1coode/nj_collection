<?php
namespace N1coode\NjCollection\ViewHelpers;

/**
 * @author n1coode
 * @package nj_collection
 */
class RandomImageViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	private $image;
	
	/**
	 * @var mixed 
	 */
	private $images;
	
	/**
	 * @var int 
	 */
	private $numberOfImages = 0;
	
	/**
	 * @var int
	 */
	private $random = -1;
	
	/**
	 * @var string
	 */
	private $output = '';
	
	
	public function initializeArguments() {
		$this->registerArgument('images', 'mixed', 'Collection of images.',TRUE,NULL);
	}
	
	/**
	 * 
	 * 
	 * @return string $image
	 */
	public function render()
	{
		if($this->arguments['images'] instanceof \Traversable)
		{
			$this->images = $this->arguments['images'];
			$this->numberOfImages = count($this->images);
			
			$this->random = rand(0, $this->numberOfImages - 1);
			
			$i = 0;
			foreach($this->images as $image)
			{
				if($i === $this->random)
				{					
					$this->image = $image;
				}
				$i++;
			}
		}
		if($this->image instanceof \TYPO3\CMS\Extbase\Domain\Model\FileReference)
		{
			$this->output = $this->image->getOriginalResource()->getOriginalFile()->getPublicUrl(TRUE);
		}
		return $this->output;
	}
}