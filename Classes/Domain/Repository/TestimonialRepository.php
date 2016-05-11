<?php
namespace N1coode\NjCollection\Domain\Repository;

/**
 * @author n1coode
 * @package nj_collection
 */
class TestimonialRepository extends \N1coode\NjCollection\Domain\Repository\AbstractRepository
{
    protected $nj_domain_model = 'Testimonial';
	
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
	
	/**
	 * @param int $limit
	 * @param int $offset
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult
	 */
	public function findAllInLimit($limit = 5, $offset = 0) 
	{
		$query = $this->createQuery();
		return $query
			->setOffset((integer)$offset)
			->setLimit((integer)$limit)
			->execute();
	}
    
}