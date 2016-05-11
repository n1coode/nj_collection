<?php
namespace N1coode\NjCollection\Domain\Model;

/**
 * A testimonial
 * @author n1coode
 * @package nj_collection
 */
class Testimonial extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var string
     */
    protected $author;
    
	/**
	 * @var string
	 */
	protected $firm;
	
    /**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 * @lazy
	 */
    protected $image;
    
    /**
     * @var string
     */
    protected $testimonial;

	/**
	 * @var string
	 */
	protected $position;
	
    /**
     * @var string
     * @validate StringLength(minimum = 3, maximum = 255)
     */
    protected $title;
	

    /* ***************************************************** */

    /**
     * Constructs a new main category
     *
     */
    public function __construct() {

    }

    /* ***************************************************** */


    /**
     * Setter for the author
     *
     * @param string The author of the feedback
     * @return void
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Getter for the author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }
    
	
	/**
	 * Setter for the firm
	 * 
	 * @return void
	 */
	public function setFirm($firm)
	{
		$this->firm = $firm;
	}
	
	/**
	 * Getter for the firm
	 * 
	 * @return string
	 */
	public function getFirm()
	{
		return $this->firm;
	}
	
	
    /**
	 * Setter for the image
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return void
	 */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
	 * Getter for the image
	 *
	 * @return \TYPO3\CMS\Core\Resource\FileReference $image
	 */
    public function getImage()
    {
        return $this->image;
    }


	/**
     * Setter for the position
     *
     * @param string $position
     * @return void
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Getter for the position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }
	
	
    /**
     * Setter for the testimonial
     *
     * @param string The testimonial to be added
     * @return void
     */
    public function setTestimonial($testimonial)
    {
        $this->testimonial = $testimonial;
    }

    /**
     * Getter for the testimonial
     *
     * @return string
     */
    public function getTestimonial()
    {
        return $this->testimonial;
    }
    
    
    /**
     * Setter for the title
     *
     * @param string The title to be added
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Getter for the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

} //end of class
?>

