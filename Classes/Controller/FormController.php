<?php
namespace N1coode\NjCollection\Controller;

/**
 * @author n1coode
 * @package nj_collection
 */
class FormController extends \N1coode\NjArtgallery\Controller\AbstractController
{
    /**
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction()
    {
        $this->nj_domain_model = "Form";
		$this->nj_domain = strtolower($this->nj_domain_model);
		parent::init($this->nj_domain_model);
    }
    
} //end of class \N1coode\NjCollection\Controller\FormController