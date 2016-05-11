<?php
namespace N1coode\NjCollection\Controller;
use TYPO3\CMS\Core\Resource\Collection\FolderBasedFileCollection;
use TYPO3\CMS\Extbase\Domain\Model\File;

/**
 * @author n1coode
 * @package nj_collection
 */
class ImageGalleryController extends \N1coode\NjCollection\Controller\AbstractController
{
    /**
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction()
    {
        parent::init('ImageGallery');
    }
    
    /**
     * List action
     *
     * @param int $offset
     * @return void
     */
    public function listAction($offset = 0) 
    {
        //if($this->settings['fileCollection'] !== "" && $this->settings['fileCollection']) 
        //{
            $collectionUids = explode(',', '1');
            $imageItems = $this->fileCollectionService->getFileObjectsFromCollection($collectionUids);
            //$cObj = $this->configurationManager->getContentObject();
            //$currentUid = $cObj->data['uid'];

            $paginationArray = array(
                'itemsPerPage' => 25,
                'maximumVisiblePages' => 5,
                'insertAbove' => 1,
                'insertBelow' => 1
            );
            $this->view->assignMultiple(array(
                'imageItems' => $imageItems,
                'offset' => $offset,
                'paginationConfiguration' => $paginationArray,
                'settings' => $this->settings,
                'currentUid' => $currentUid
            ));
       // }
    }
    
} //end of \N1coode\NjCollection\Controller\ImageGalleryController
?>