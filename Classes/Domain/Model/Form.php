<?php
namespace N1coode\NjCollection\Domain\Model;

/**
 * A form
 * @author n1coode
 * @package nj_collection
 */
class Form extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var string
     */
    protected $sender;
    
	/**
	 * @var string
	 */
	protected $ftype;
	
    
    /**
     * @var string
     */
    protected $fdata;

	
    /* ***************************************************** */

    /**
     * Constructs a new main category
     *
     */
    public function __construct() {

    }

    /* ***************************************************** */


    /**
     * @param string
     * @return void
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }
    
	
	/**
	 * @param string
	 * @return void
	 */
	public function setFtype($ftype)
	{
		$this->ftype = $ftype;
	}
	
	/**
	 * @return string
	 */
	public function getFtype()
	{
		return $this->ftype;
	}
	
	
	/**
     * @param string $fdata
     * @return void
     */
    public function setFdata($fdata)
    {
        $this->fdata = $fdata;
    }

    /**
     * Getter for the position
     *
     * @return string
     */
    public function getFdata()
    {
        return $this->fdata;
    }

} //end of class
?>

