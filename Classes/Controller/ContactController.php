<?php
namespace N1coode\NjCollection\Controller;

/**
 * @author n1coode
 * @package nj_collection
 */
class ContactController extends \N1coode\NjCollection\Controller\AbstractController
{
	/**
     * @var boolean
     */
    protected $nj_test_mode = true;
	
	
	/**
     * @var string
     */
    protected $nj_mail_development = "post@n1coo.de";

    /**
     * @var string
     */
    protected $nj_mail_production = "post@n1coo.de";

    /**
     * @var string
     */
    protected $nj_mail_system = "system@n1coo.de";
	
	
	/**
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction()
    {
        $this->nj_domain_model = "Contact";
		$this->nj_domain = strtolower($this->nj_domain_model);
		parent::init($this->nj_domain_model);
    }
	
	public function addressAction()
	{
		$contactData = $this->settings['contactData'];
		unset($contactData['socialMedia']);
		$this->view->assign("contactData", $contactData);
	}
	
	public function teleAction()
	{
		$contactData = $this->settings['contactData'];
		unset($contactData['socialMedia']);
		unset($contactData['address']);
	}
	
	
	public function socialMediaAction()
	{
		$this->view->assign("socialMedia", $this->settings['contactData']['socialMedia']);
	}
	
	
	private function additionalArguments($autocomplete,$spellcheck)
	{
		return [
			'autocomplete' => $autocomplete,
			'spellcheck' => $spellcheck
		];
	}
	
	
	public function formFields()
	{
		return [
			'country' => [
				'additionalArguments' => $this->additionalArguments('off','false'),
				'addon-class' => 'flag',
				'autocomplete' => 'off',
				'fieldset' => 'adressData',
				'mandatory' => false,
				'type' => 'input',
			],
			'email'=> [
				'addon-class' => 'envelope',
				'autocomplete' => 'off',
				'eval' => 'email',
				'fieldset' => 'contactData',
				'mandatory' => false,
				'type' => 'input',
			],
			'firm' => [
				'additionalArguments' => $this->additionalArguments('off','false'),
				'autocomplete' => 'off',
				'fieldset' => 'adressData',
				'mandatory' => false,
				'type' => 'input',
			],
			'firstName' => [
				'additionalArguments' => $this->additionalArguments('off','false'),
				'addon-class' => 'user',
				'autocomplete' => 'off',
				'fieldset' => 'adressData',
				'mandatory' => false,
				'type' => 'input',
			],
			'lastName' => [
				'additionalArguments' => $this->additionalArguments('off','false'),
				'addon-class' => 'user',
				'autocomplete' => 'off',
				'fieldset' => 'adressData',
				'mandatory' => false,
				'type' => 'input',
			],
			'location' => [
				'additionalArguments' => $this->additionalArguments('off','false'),
				'addon-class' => 'map-signs',
				'autocomplete' => 'off',
				'fieldset' => 'adressData',
				'mandatory' => false,
				'type' => 'input',
			],
			'message' => [
				'eval' => ['size' => 50],
				'fieldset' => 'messageData',
				'mandatory' => false,
				'type' => 'text',
				
			],
			'mobile'=> [
				'addon-class' => 'mobile',
				'autocomplete' => 'off',
				'fieldset' => 'contactData',
				'mandatory' => false,
				'type' => 'input',
			],
			'name' => [
				'additionalArguments' => $this->additionalArguments('off','false'),
				'addon-class' => 'user',
				'autocomplete' => 'off',
				'fieldset' => 'adressData',
				'mandatory' => false,
				'type' => 'input',
			],
			'phone'=> [
				'addon-class' => 'phone',
				'autocomplete' => 'off',
				'fieldset' => 'contactData',
				'mandatory' => false,
				'type' => 'input',
			],
			'street' => [
				'additionalArguments' => $this->additionalArguments('off','false'),
				'addon-class' => 'home',
				'autocomplete' => 'on',
				'fieldset' => 'adressData',
				'mandatory' => false,
				'type' => 'input',
			],
			'subject' => [
				'additionalArguments' => $this->additionalArguments('off','false'),
				'addon-class' => 'pencil',
				'autocomplete' => 'off',
				'fieldset' => 'messageData',
				'mandatory' => false,
				'type' => 'input',
				
			],
			'zipCode' => [
				'additionalArguments' => $this->additionalArguments('off','false'),
				'addon-class' => 'home',
				'mandatory' => false,
				'type' => 'input',
				'fieldset' => 'adressData'
			],
			'url' => [
				'additionalArguments' => $this->additionalArguments('off','false'),
				'addon-class' => 'globe',
				'eval' => 'url',
				'mandatory' => false,
				'type' => 'input',
				'fieldset' => 'contactData'
			],
		];
	}
	
	public function formAction()
	{
		$success = false;
		
		$action = explode("Action", __FUNCTION__)[0];
		$assignValues = [];
		$assignValues['ext'] = parent::getExtSettings();
		
		
		$mandatory = 'name,email,message';
		$selection = 'name,email,subject,message';
		
		$options = [];
		$options['useFieldsets'] = false;
		$assignValues['options'] = $options;
		
		$fieldDefinitions = $this->formFields();
		
		$fields = [];
		
		foreach(explode(',',$selection) as $field)
		{
			if(is_array($fieldDefinitions))
			{
				if(array_key_exists($field, $fieldDefinitions))
				{
					$fields[$field] = $fieldDefinitions[$field];
				
					if(in_array($field,explode(',',$mandatory)))
					{
						$fields[$field]['mandatory'] = true;
					}
				}
			}
		}
		
		$generateForm = true;
		
		$formData = [];
		if($this->request->hasArgument('submitFormData'))
        {
			$formData = $this->request->getArguments();
			
			$errors = $this->checkFormData($mandatory,$selection,$fieldDefinitions,$formData);
			
			if(!empty($errors))
			{
				$assignValues['errors'] = $errors;
			}
			else
			{
				if($this->sendMail($formData))
				{
					$formData['success'] = 1;
					$generateForm = false;
					$success = true;
				}
			}
			
			$assignValues['formData'] = $formData;
		}
		
		if($generateForm)
		{
			$assignFields = [];
			foreach($fields as $key => $value)
			{
				$assignFields[$value['fieldset']][$key] = $value;
			}

			$assignValues['fields'] = $assignFields;
		}
		
		if($success)
		{
			$this->completeForm($formData,$selection);
		}
		
		//completion
		$this->view->assignMultiple($assignValues);
	}
	
	
	private function completeForm($formData,$selection)
	{
		if(!empty($formData))
		{
			$xml = $this->arrayToXML($formData,$selection);
			$this->addFormdataToRepository($xml);
		}
	}
	
	/**
	 * @param \SimpleXMLElement $xml
	 */
	private function addFormdataToRepository($xml)
	{
		$formData = new \N1coode\NjCollection\Domain\Model\Form();
		
		if($this->request->hasArgument('name'))
        {
			$formData->setSender($this->request->getArgument('name'));
        }
		else
		{
			if($this->request->hasArgument('firstName') || $this->request->hasArgument('lastName'))
			{
				$sender = $this->request->getArgument('firstName') . ' ' . $this->request->getArgument('lastName');
				$formData->setSender($this->request->getArgument($sender));
			}
		}
		$formData->setFtype('contact');
		$formData->setFdata($xml->asXML());
		
		if($this->storagePid > 0)
		{
			$formData->setPid($this->storagePid);
		}

        //add enquiry to repository
        $this->formRepository->add($formData);
	}
	
	private function arrayToXML($formData,$selection)
	{
		$xml = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><NjFormData></NjFormData>");
		foreach ($formData as $key=>$value)
		{
			if(is_array(explode(',',$selection)) && in_array($key, explode(',',$selection)))
			{
				if(is_string($value) && $value !== '')
				{
					$xml->addChild($key,  \htmlspecialchars($value));
				}
			}
		}
		return $xml;
	}
	
	
	/**
	 * @param string $mandatory
	 * @param string $selection
	 * @param string $fieldDefinitions
	 * @param array $formData
	 */
	private function checkFormData($mandatory = NULL, $selection = NULL,$fieldDefinitions = NULL, $formData = NULL)
	{
		$errors = [];
		
		if($selection !== NULL && $selection !== '')
		{
			foreach(explode(',',$selection) as $key=>$value)
			{
				
				if($fieldDefinitions !== NULL && is_array($fieldDefinitions))
				{
					if(in_array($value,explode(',',$mandatory)))
					{
						if($formData[$value] == '')
						{
							$errors[$value] = 'missing';
						}
					}
					
					if(!array_key_exists($value, $errors))
					{
						if(array_key_exists('eval', $fieldDefinitions[$value]))
						{
							$eval = $fieldDefinitions[$value]['eval'];
							if($formData[$value] !== '')
							{
								if(is_string($eval))
								{
									if($eval === 'email')
									{
										if(!\TYPO3\CMS\Core\Utility\GeneralUtility::validEmail($formData[$value]))
										{
											$errors['email'] = 'wrongFormat';
										}
									}
									if($eval === 'url')
									{
										if(!\TYPO3\CMS\Core\Utility\GeneralUtility::isValidUrl($formData[$value]))
										{
											$errors['url'] = 'wrongFormat';
										}
									}
								}
								if(is_array($eval))
								{
									if(array_key_exists('size', $eval))
									{
										$minSize = $eval['size'];
										if(strlen($formData[$value]) < $minSize) { $errors[$value] = 'tooShort'; }
									}
								}
							}
						}
					}
				}
			}
		}

		return $errors;
	}
	
	/**
	 * @return boolean
	 */
	protected function sendMail($formData)
	{
		$templatePathAndFilename = $this->getAbsolutePathAndFilename('Standalone/Email/Contact.html');
		
		$emailView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		
		$assignValues = [];
		$assignValues['formData'] = $formData;
		
		$emailView->setTemplatePathAndFilename($templatePathAndFilename);
		$emailView->assignMultiple($assignValues);
		
		$emailBody = $emailView->render();
		
		
		$nj_mail_to = $this->nj_test_mode ? $this->nj_mail_development : $this->nj_mail_production;
		$nj_mail_from = (is_array($formData) && isset($formData['email']) && $formData['email'] !== '' ) ? $formData['email'] : $this->nj_mail_system;

		
		$message = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
		
		$subject = 'Kontaktformular';
		$subject .= ' - ' . $GLOBALS['TSFE']->pSetup['10.']['variables.']['pageTitle.']['value'];
				
		if(is_array($formData) && isset($formData['subject']) && $formData['subject'] !== '' )
		{
			$subject .= ' | '.$formData['subject'];
		}
		
		
		$message->setTo($nj_mail_to)
			->setFrom($nj_mail_from)
			->setSubject($subject);

		// Possible attachments here
		//foreach ($attachments as $attachment) {
		// $message->attach($attachment);
		//}

		// Plain text example
		#$message->setBody($emailBody, ‘text/plain’);

		// HTML Email
		$message->setBody($emailBody, 'text/html');

		$message->send();
		
		return $message->isSent();
		
		
		
		
		
		
	}
	
	/**
	 * Return path and filename for a file
	 * respect *RootPaths and *RootPath	
	 *
	 * @param string $relativePathAndFilename e.g. Email/Name.html
	 * @param string $part "template", "partial", "layout"
	 * @return string
	 */
	public function getAbsolutePathAndFilename($relativePathAndFilename, $part = 'template') 
	{
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
		);

		if (!empty($extbaseFrameworkConfiguration['view'][$part . 'RootPaths'])) {

			foreach ($extbaseFrameworkConfiguration['view'][$part . 'RootPaths'] as $path) {

				$absolutePath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($path);

				if (file_exists($absolutePath . $relativePathAndFilename)) {
					$absolutePathAndFilename = $absolutePath . $relativePathAndFilename;
				}
			}
		} else {
			$absolutePathAndFilename = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
				$extbaseFrameworkConfiguration['view'][$part . 'RootPath'] . $relativePathAndFilename
			);
		}

		if (empty($absolutePathAndFilename)) {	
			$absolutePathAndFilename = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
				'EXT:femanager/Resources/Private/' . ucfirst($part) . 's/' . $relativePathAndFilename
			);
		}

		return $absolutePathAndFilename;
	}

	
} //end of class  N1coode\NjCollection\Controller\ContactController