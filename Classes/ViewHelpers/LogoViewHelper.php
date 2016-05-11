<?php
namespace N1coode\NjCollection\ViewHelpers;

/**
 * @author n1coode
 * @package nj_collection
 */
class LogoViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
{
	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject
	 */
	protected $objectManager;

	
	/**
	 *	Description
	 *
	 * @param array $ext
	 */
	public function render($ext = NULL)
	{
		$request = clone $this->controllerContext->getRequest();

		$request->setControllerExtensionName('nj_collection');
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this);
		$controllerContext = clone $this->controllerContext;
		$controllerContext->setRequest($request);
		$this->setPartialRootPath($controllerContext);
				$content = $this->viewHelperVariableContainer->getView()->renderPartial($partial, NULL, $arguments);
		//$view->setPartialRootPath('fileadmin');
		
		//return $this->renderView($view);
	}
	
	/**
	 * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view
	 * @throws \Exception
	 * @return string
	 */
	protected function renderView(ViewInterface $view) {
		try {
			$content = $view->render();
		} catch (\Exception $error) {
			if (!$this->arguments['graceful']) {
				throw $error;
			}
			$content = $error->getMessage() . ' (' . $error->getCode() . ')';
		}
		return $content;
	}
}