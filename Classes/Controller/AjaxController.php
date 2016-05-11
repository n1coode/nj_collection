<?php
namespace N1coode\NjCollection\Controller;

/**
 * @author n1coode
 * @package nj_collection
 */
class AjaxController extends \N1coode\NjCollection\Controller\AbstractController
{
	/**
     * @var array
     */
    protected $arguments = array();
	
	/**
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction()
    {
       parent::init('Ajax');
    }
	
	public function getImagesAction()
	{
		$this->init();
		$collectionUids = explode(',', '2');
		
		$images = $this->fileCollectionService->getFileObjectsFromCollection($collectionUids);
		
		$paginationArray = array(
                'itemsPerPage' => 25,
                'maximumVisiblePages' => 5,
                'insertAbove' => 1,
                'insertBelow' => 1
		);
		$this->view->assignMultiple(array(
			'collection' => $collection,
			'images' => $images,
			'offset' => $offset,
			'paginationConfiguration' => $paginationArray,
			'settings' => $this->settings,
			'currentUid' => $currentUid,
			'arguments' => $this->arguments
		));
		
		
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->request->getArguments());
		return json_encode( 
            array(
				"content" => $this->view->render(),
                "success" => "1", 
            )
        );
	}
	
	protected function init()
    {
        $this->arguments = $this->request->getArguments();
    }
	
} //end of class \N1coode\NjCollection\Controller\Ajax