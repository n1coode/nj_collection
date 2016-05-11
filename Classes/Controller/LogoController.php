<?php
namespace N1coode\NjCollection\Controller;

/**
 * @author n1coode
 * @package nj_collection
 */
class LogoController extends \N1coode\NjCollection\Controller\AbstractController
{
	/**
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction()
    {
        parent::init('Logo');
    }
	
	
	/**
	 * Include logo as SVG
	 *
	 * @return void
	 */
	public function svgAction()
	{
		$assignValues = [];
		$assignValues['brand'] = $this->settings['controller']['logo']['brand'];
		$assignValues['monochrome'] = $this->settings['controller']['logo']['monochrome'];
		$assignValues['version'] = $this->settings['controller']['logo']['version'];
		
		$this->view->assignMultiple($assignValues);
	}
	
}