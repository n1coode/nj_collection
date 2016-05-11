<?php
namespace N1coode\NjCollection\Domain\Repository;

/**
 * @author n1coode
 * @package nj_collection
 */
class ContentRepository extends \N1coode\NjCollection\Domain\Repository\AbstractRepository
{
	protected $defaultOrderings = array(
		'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);
	
} //end of class N1coode\NjCollection\Domain\Repository\CommentRepository