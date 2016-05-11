<?php
namespace N1coode\NjCollection\Service;


/**
 * FileCollectionService
 */
class FileCollectionService 
{
    /**
     * Collection Repository
     *
     * @var \TYPO3\CMS\Core\Resource\FileCollectionRepository
     * @inject
     */
    protected $collectionRepository;


    /**
     * Returns an array of file objects for the given UIDs of fileCollections
     *
     * @param $collectionUids
     * @return array
     */
    public function getFileObjectsFromCollection($collectionUids) 
    {
        $imageItems = array();
        
        
        
        
        foreach ($collectionUids as $collectionUid) 
        {
            $collection = $this->collectionRepository->findByUid($collectionUid);
            
			$collection->loadContents();
          
            foreach ($collection->getItems() as $item) 
            {
                //if (get_class($item) === 'TYPO3\CMS\Core\Resource\FileReference') 
                //{
                //        array_push($imageItems, $this->getFileObjectFromFileReference($item));
                //} 
                //else {
                        array_push($imageItems, $item);
                //}
            }
        }
        return $imageItems;
       //return $this->sortFileObjects($imageItems);
    }
}
?>