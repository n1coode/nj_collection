<?php
namespace N1coode\NjCollection\ViewHelpers;

/**
 * @author n1coode
 * @package nj_tutorials
 */
class CodeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
	/**
	 * @var \N1coode\NjCollection\Lib\GeSHi\GeSHi
	 */
	protected $geshi = null;
	
	
	/**
	 * array
	 */
	protected $config = array();
	
	
	/**
	 *	Description
	 *
	 * @param string $code
	 * @param string $language
	 * @param int $startingLine
	 * @param string $highlightLines
	 * @param string $highlightColor
	 * @return string
	 */
	public function render($code='', $language='php', $startingLine = 0, $highlightLines = '', $highlightColor = '#ffedd9')
	{	
		$config['code'] = $code;
		$config['language'] = $language;
		$config['startingLine'] = $startingLine;
		
		$this->geshi = new \N1coode\NjCollection\Lib\GeSHi\GeSHi();

		$this->geshi->set_source($config['code']);
		$this->geshi->set_language($config['language']);
		
		if($startingLine > 0)
		{
			$this->geshi->start_line_numbers_at($startingLine);
		}
		else 
		{
			$this->geshi->start_line_numbers_at(1);
		}
		
		
		/**
		 * GESHI_NORMAL_LINE_NUMBERS - Use normal line numbering
		 * GESHI_FANCY_LINE_NUMBERS - Use fancy line numbering
		 * GESHI_NO_LINE_NUMBERS - Disable line numbers (default)
		 */
		$this->geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS, 37);
		$this->geshi->set_header_type(GESHI_HEADER_DIV);
		$this->geshi->set_numbers_highlighting(true);
		
		if(!empty($highlightLines))
		{
			$lines = explode(',',$highlightLines);

			if(count($lines)>0)
			{
				$color = 'background-color:#C8E1FA;';
				
				$this->geshi->highlight_lines_extra($lines,$color);
			}
		}
		
		//return 'view geshi';
		return $this->geshi->parse_code();
	} 
	
} //end of class \N1coode\NjCollection\ViewHelpers\CodeViewHelper