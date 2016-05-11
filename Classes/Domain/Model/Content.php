<?php
namespace N1coode\NjCollection\Domain\Model;

/**
 * A content element
 * @author n1coode
 * @package nj_collection
 */
class Content extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
	 * @var string
	 * @validate StringLength(minimum = 3, maximum = 255)
	 */
	protected $headline;
	
	/**
	 * @var int
	 */
	protected $headlineHidden;
	
	/**
	 * @var string
	 */
	protected $headlineStyle;
	
	/**
	 * @var string
	 */
	protected $content;
	
	/**
	 * @var string
	 */
	protected $ctype;
	
	/**
	 * @var string
	 */
	protected $code;
	
	/**
	 * @var string
	 */
	protected $codeHighlightColor;
	
	/**
	 * @var string
	 */
	protected $codeHighlightLines;
	
	
	/**
	 * @var string
	 */
	protected $codeLang;
	
	/**
	 * @var int
	 */
	protected $codeStartingLine;
	
	/**
	 * @var string
	 */
	protected $html;
	
	/**
	 * @var string
	 */
	protected $message;
	
	/**
	 * @var string
	 */
	protected $messageType;
	
	/**
	 * @var int
	 */
	protected $sorting;
	
	
	/* ***************************************************** */

	/**
	 * Constructs a new artist
	 * @return AbstractObject
	 */
	public function __construct() {

	}

	/* ***************************************************** */

	
	/**
	 * Setter for the content
	 *
	 * @param string $content
	 * @return void
	 */
	public function setContent($content)
	{
		$this->content = $content;
	}
	
	/**
	 * Getter for the content
	 *
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}
	
	
	/**
	 * Setter for the headline
	 *
	 * @param string $headline
	 * @return void
	 */
	public function setHeadline($headline)
	{
		$this->headline = $headline;
	}
	
	/**
	 * Getter for the headline
	 *
	 * @return string
	 */
	public function getHeadline()
	{
		return $this->headline;
	}
	
	/**
	 * Setter for the option that handles if headline is hidden or not
	 *
	 * @param int $headlineHidden
	 * @return void
	 */
	public function setHeadlineHidden($headlineHidden)
	{
		$this->headlineHidden = $headlineHidden;
	}
	
	/**
	 * Getter for the option that handles if headline is hidden or not
	 *
	 * @return int
	 */
	public function getHeadlineHidden()
	{
		return $this->headlineHidden;
	}
	
	/**
	 * Setter for the headline style
	 *
	 * @param string $headlineStyle
	 * @return void
	 */
	public function setHeadlineStyle($headlineStyle)
	{
		$this->headlineStyle = $headlineStyle;
	}
	
	/**
	 * Getter for the headline style
	 *
	 * @return string
	 */
	public function getHeadlineStyle()
	{
		return $this->headlineStyle;
	}
	
	
	/**
	 * Setter for the code
	 *
	 * @param string $code
	 * @return void
	 */
	public function setCode($code)
	{
		$this->code = $code;
	}
	
	/**
	 * Getter for the code
	 *
	 * @return string
	 */
	public function getCode()
	{
		return $this->code;
	}
	
	
	/**
	 * Setter for the code highlight lines
	 *
	 * @param string $codeHighlightLines
	 * @return void
	 */
	public function setCodeHighlightLines($codeHighlightLines)
	{
		$this->codeHighlightLines = $codeHighlightLines;
	}
	
	/**
	 * Getter for the code highlight lines
	 *
	 * @return string
	 */
	public function getCodeHighlightLines()
	{
		return $this->codeHighlightLines;
	}
	
	
	/**
	 * Setter for the code highlight color
	 *
	 * @param string $codeHighlightColor
	 * @return void
	 */
	public function setCodeHighlightColor($codeHighlightColor)
	{
		$this->codeHighlightColor = $codeHighlightColor;
	}
	
	/**
	 * Getter for the code highlight color
	 *
	 * @return string
	 */
	public function getCodeHighlightColor()
	{
		return $this->codeHighlightColor;
	}
	
	
	/**
	 * Setter for the code language
	 *
	 * @param string $codeLang
	 * @return void
	 */
	public function setCodeLang($codeLang)
	{
		$this->codeLang = $codeLang;
	}
	
	/**
	 * Getter for the code lang
	 *
	 * @return string
	 */
	public function getCodeLang()
	{
		return $this->codeLang;
	}
	
	
	/**
	 * Setter the code starting line number
	 *
	 * @param int $codeStartingLine
	 * @return void
	 */
	public function setCodeStartingLine($codeStartingLine)
	{
		$this->codeStartingLine = $codeStartingLine;
	}
	
	/**
	 * Getter for the code lang
	 *
	 * @return int
	 */
	public function getCodeStartingLine()
	{
		return $this->codeStartingLine;
	}
	
	
	/**
	 * Setter the content type
	 *
	 * @param string $ctype
	 * @return void
	 */
	public function setCtype($ctype)
	{
		$this->ctype = $ctype;
	}
	
	/**
	 * Getter for the content type
	 *
	 * @return string
	 */
	public function getCtype()
	{
		return $this->ctype;
	}
	
	
	/**
	 * Setter for the html code
	 *
	 * @param string $html
	 * @return void
	 */
	public function setHtml($html)
	{
		$this->html = $html;
	}
	
	/**
	 * Getter for the html code
	 *
	 * @return string
	 */
	public function getHtml()
	{
		return $this->html;
	}
	
	
	/**
	 * Setter for the message
	 *
	 * @param string $message
	 * @return void
	 */
	public function setMessage($message)
	{
		$this->message = $message;
	}
	
	/**
	 * Getter for the message
	 *
	 * @return string
	 */
	public function getMessage()
	{
		return $this->message;
	}
	
	
	/**
	 * Setter for the message type
	 *
	 * @param string $messageType
	 * @return void
	 */
	public function setMessageType($messageType)
	{
		$this->messageType = $messageType;
	}
	
	/**
	 * Getter for the message type
	 *
	 * @return string
	 */
	public function getMessageType()
	{
		return $this->messageType;
	}
	
	
	/**
	 * Setter the sorting
	 *
	 * @param int $sorting
	 * @return void
	 */
	public function setSorting($sorting)
	{
		$this->sorting = $sorting;
	}
	
	/**
	 * Getter for the sorting
	 *
	 * @return int
	 */
	public function getSorting()
	{
		return $this->sorting;
	}
	
} //end of class N1coode\NjTutorials\Domain\TutorialItem
?>