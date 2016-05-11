<?php
namespace N1coode\NjCollection\Controller;

/**
 * @author n1coode
 * @package nj_collection
 */
class CarouselController extends \N1coode\NjCollection\Controller\AbstractController
{
	/**
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction()
    {
        $this->nj_domain_model = \N1coode\NjCollection\Utility\General::getShortClassName(__CLASS__);
		$this->nj_domain = strtolower($this->nj_domain_model);
		$this->init($this->nj_domain_model);
    }
	
	
	public function indexAction()
	{
		$action = explode("Action", __FUNCTION__)[0];
		
		$assignValues = [];
		$assignValues['ext'] = $this->getExtSettings();
		
		$this->cObj = $this->configurationManager->getContentObject();
		
		$actionSettings = [];
		if(array_key_exists('model',$this->settings))
		{
			if(array_key_exists($this->nj_domain,$this->settings['model']))
			{
				if(array_key_exists($action,$this->settings['model'][$this->nj_domain]))
				{
					$actionSettings = $this->settings['model'][$this->nj_domain][$action];
				}	
			}
		}
		
		
		$identifier = $this->nj_ext_key.'_'.$this->nj_domain.'_'.$action;
		if(!empty($actionSettings) && array_key_exists('images', $actionSettings))
		{
			if(intval($actionSettings['images'] > 0))
			{
				$fileObjects = $this->fileRepository->findByRelation('tt_content', $identifier, $this->cObj->data['uid']);
			}
		}
		// get Imageobject information
		$images = array();
		foreach ($fileObjects as $key => $value) {
			$images[$key]['reference'] = $value->getReferenceProperties();
			$images[$key]['original'] = $value->getOriginalFile()->getProperties();
		}
		$assignValues['images'] = $images;
		$this->view->assignMultiple($assignValues);
	}
}