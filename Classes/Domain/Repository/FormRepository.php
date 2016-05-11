<?php
namespace N1coode\NjCollection\Domain\Repository;

/**
 * @author n1coode
 * @package nj_collection
 */
class FormRepository extends \N1coode\NjCollection\Domain\Repository\AbstractRepository
{
    protected $nj_domain_model = 'Form';
    protected $defaultOrderings = ['crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];
	
    /**
	 * Initializes the repository.
	 * @return void
	 * @see \TYPO3\CMS\Extbase\Persistence\Repository::initializeObject()
	 */
	public function initializeObject() 
	{
		parent::init($this->nj_domain_model);
	}
}