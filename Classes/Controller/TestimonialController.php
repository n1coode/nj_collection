<?php
namespace N1coode\NjCollection\Controller;

/**
 * @author n1coode
 * @package nj_collection
 */
class TestimonialController extends \N1coode\NjCollection\Controller\AbstractController
{	
    /**
     * @var array
     */
    protected $arguments = array();

	/**
     * @var array
     */
	protected $slider = [];
	
    /**
     * Initializes the controller before invoking an action method.
     *
     * @return void
     */
    protected function initializeAction()
    {
            parent::init('Testimonial');
    }
	
    

    protected function listAction()
	{
		$this->testimonialRepository->initializeObject();
		$testimonials = $this->testimonialRepository->findAll();
		$this->view->assign("testimonials", $testimonials);
	}
	
    
    protected function sliderAction()
    {
		$this->testimonialRepository->initializeObject();
		
		$assignValues = [];
		
		if($this->storagePidIsset())
		{
			$this->testimonialRepository->setQuerySettings($this->getStoragePid());
			$testimonials = $this->testimonialRepository->findAllInLimit(5)->toArray();
			shuffle($testimonials);
		}
		
		$this->view->assign("testimonials", $testimonials);
		
		$this->slider['uid'] = $this->storagePid;
		
		$this->view->assign("slider", $this->slider);
		
		$this::addJavascriptSlider();
	   
	   $this->view->assignMultiple($assignValues);
    }
	
	
	
	private function addJavascriptSlider()
	{
		$slider  =	'<script type="text/javascript">';
		$slider .=	'jQuery(document).ready(function($) {';
		
		$slider	.=	'var _SlideshowTransitions = [{$Duration:1000,y:1,$Easing:$JssorEasing$.$EaseInBounce}];';
		
		$slider	.=	'var options_'.$this->slider['uid'].' = {';
		
		$slider	.=	'$AutoPlay: true,';
		
		
		$slider	.=	'};';
		
		$slider	.=	'});';
		
		$slider .=	'var jssor_slider'.$this->slider['uid'].' = new $JssorSlider$("slider_container_'.$this->slider['uid'].'", options_'.$this->slider['uid'].');';

		$slider	.=	'});';
		
		$slider	.=	'</script>';
		
		$slider_resize  =	'<script type="text/javascript">';
		
		$slider_resize .= 'function ScaleSlider() {';
		$slider_resize .= 'alert(1);';
		$slider_resize .= 'var parentWidth = $("#slider_container_'.$this->slider['uid'].'").parent().width();';
		$slider_resize .= '		
            if (parentWidth) {
                jssor_slider'.$this->slider['uid'].'.$ScaleWidth(parentWidth);
            }
            else {
                window.setTimeout(ScaleSlider, 30);
        }';
		
		$slider_resize .= '$(document).ready(function () {';
        $slider_resize .= 'scaleSlider();';
		$slider_resize .= '$(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);';
		
        //responsive code end
		$slider_resize .= '});';
		
		$slider_resize .= '</script>';
		
		//$GLOBALS['TSFE']->additionalHeaderData[] = $slider_resize;
		
	}
	
	
	private function addSlider2Javascript()
	{
		$jq =	'<script type="text/javascript">';
		
		$jq .=	'jQuery(document).ready(function($) {';
		
		if($this->settings['model']['slider']['animationEffect'] == 'fade')
		{
			$jq .=	'var _SlideshowTransitions = [{ $Duration: 1200, $Opacity: 2 }];';
		}
		$jq .=	'var _SlideshowTransitions = [{$Duration:1000,y:1,$Easing:$JssorEasing$.$EaseInBounce}];';
		//$jq .=	'var _SlideshowTransitions = [{$Duration:1200,x:0.2,y:-0.1,$Delay:20,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$JssorEasing$.$EaseInWave,$Top:$JssorEasing$.$EaseInWave,$Clip:$JssorEasing$.$EaseOutQuad},$Round:{$Left:1.3,$Top:2.5}}];';
		
		//$jq .=	'var _SlideshowTransitions = [{$Duration:1200,x:0.2,y:-0.1,$Delay:20,$Cols:8,$Rows:4,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$JssorEasing$.$EaseInWave,$Top:$JssorEasing$.$EaseInWave,$Clip:$JssorEasing$.$EaseOutQuad},$Outside:true,$Round:{$Left:1.3,$Top:2.5}}];';
		$jq .=	'var _CaptionTransitions = [];
		_CaptionTransitions["L"] = { $Duration: 900, x: 0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
		_CaptionTransitions["R"] = { $Duration: 900, x: -0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
		_CaptionTransitions["T"] = { $Duration: 900, y: 0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
		_CaptionTransitions["B"] = { $Duration: 900, y: -0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
		_CaptionTransitions["ZMF|10"] = { $Duration: 900, $Zoom: 11, $Easing: { $Zoom: $JssorEasing$.$EaseOutQuad, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 };
		_CaptionTransitions["RTT|10"] = { $Duration: 900, $Zoom: 11, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseOutQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} };
		_CaptionTransitions["RTT|2"] = { $Duration: 900, $Zoom: 3, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Round: { $Rotate: 0.5} };
		_CaptionTransitions["RTTL|BR"] = { $Duration: 900, x: -0.6, y: -0.6, $Zoom: 11, $Rotate: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.8} };
		_CaptionTransitions["CLIP|LR"] = { $Duration: 900, $Clip: 15, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic }, $Opacity: 2 };
		_CaptionTransitions["MCLIP|L"] = { $Duration: 900, $Clip: 1, $Move: true, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic} };
		_CaptionTransitions["MCLIP|R"] = { $Duration: 900, $Clip: 2, $Move: true, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic} };';
		
		$jq .=	'var options = {';
		
		//$jq .=	'$Loop: 2,';
		
		/**
		 * [Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
		 */
		
		$autoplay = $this->settings['model']['slider']['autoplay'] == 1 ? 'true' : 'false';
		//$jq .=	'$AutoPlay: '.$autoplay.',';
		$jq .=	'$AutoPlay: true,';
		/**
		 * [Optional] Orientation to play slide (for auto play, navigation), default value is 1
		 *  1	horizontal, 
		 *  2	vertical, 
		 *  5	horizental reverse, 
		 *  6 	vertical reverse
		 */
		//$jq .=	'$PlayOrientation: '.$this->settings['model']['slider']['slideDirection'].',';
		$jq .=	'$PlayOrientation: 1,';
		/**
		 *	[Optional] Orientation to drag slide, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
		 *	0	no drag, 
		 *	1	horizental, 
		 *	2	vertical,
		 *	3	either
		 */
		//$jq .=	'$DragOrientation: '.$this->settings['model']['slider']['dragDirection'].',';
		$jq .=	'$DragOrientation: 0,';
		
		$jq .=	'$FillMode: 2,';
		
		/**
		 * [Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
		 */
		$autoplayInterval = $this->settings['model']['slider']['autoplayInterval'] <= 0 ? '5000' : $this->settings['model']['slider']['autoplayInterval'];
		//$jq .=	'$AutoPlayInterval: '.$autoplayInterval.',';
		
		/**
		 * [Optional] Whether to pause when mouse over if a slider is auto playing, default value is 1
		 * 0	no pause, 
		 * 1	pause for desktop,
		 * 2	pause for touch device, 
		 * 3	pause for desktop and touch device, 
		 * 4	freeze for desktop, 
		 * 8	freeze for touch device, 
		 * 12	freeze for desktop and touch device
		 */
		$pauseOnHover = $this->settings['model']['slider']['autoplayPauseOnHover'] == 1 ? 'true' : 'false';
		//$jq .=	'$PauseOnHover: '.$this->settings['model']['slider']['autoplayPauseOnHover'].',';
		
		/**
		 * [Optional] Allows keyboard (arrow key) navigation or not, default value is false
		 */
		$jq .=	'$ArrowKeyNavigation: true,';
		
		/**
		 * [Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
		 */
		$jq .=	'$SlideEasing: $JssorEasing$.$EaseOutQuint,';
		
		/**
		 * [Optional] Minimum drag offset to trigger slide , default value is 20
		 */
		$jq .=	'$MinDragOffsetToSlide: 20,';
		
		/**
		 * [Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
		 */
		$slideDuration = $this->settings['model']['slider']['slideDuration'] <= 0 ? '800' : $this->settings['model']['slider']['slideDuration'];
		//$jq .=	'$SlideDuration: '.$slideDuration.',';
		
		
		$jq .=	'$SlideSpacing: 0,$DisplayPieces: 1,$ParkingPosition: 0,$UISearchMode: 1,';
		
		//if($this->settings['model']['slider']['animationEffect'] == 'fade')
		//{
			$jq .=	'$SlideshowOptions: {$Class: $JssorSlideshowRunner$,$Transitions: _SlideshowTransitions, $TransitionsOrder: 1,$ShowLink: true},';
		//}
		
		$jq .=	'$CaptionSliderOptions: {$Class: $JssorCaptionSlider$,$CaptionTransitions: _CaptionTransitions,$PlayInMode: 1,$PlayOutMode: 3},';
		
		/**
		 *	$Class			[Required] Class to create navigator instance
		 *	$ChanceToShow	[Required] 0 Never, 1 Mouse Over, 2 Always
		 *	$AutoCenter		[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
		 *	$Steps			[Optional] Steps to go for each navigation request, default value is 1
		 *	$Lanes			[Optional] Specify lanes to arrange items, default value is 1
		 *	$SpacingX		[Optional] Horizontal space between each item in pixel, default value is 0
		 *	$SpacingY		[Optional] Vertical space between each item in pixel, default value is 0
		 *	$Orientation	[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
		 */
		$jq .=	'$BulletNavigatorOptions: {$Class: $JssorBulletNavigator$,$ChanceToShow: 2,$AutoCenter: 0,$Steps: 1,$Lanes: 1,$SpacingX: 8,$SpacingY: 8,$Orientation: 1},';
		$jq .=	'$ArrowNavigatorOptions: {$Class: $JssorArrowNavigator$,$ChanceToShow: 1,$AutoCenter: 2,$Steps: 1}';
		
		$jq .=	'};';
		
		$jq .=	'var jssor_slider'.$this->settings['model']['slider']['uid'].' = new $JssorSlider$("slider_container_'.$this->settings['model']['slider']['uid'].'", options);';

		$jq .=	'});';
				
						
				
				
 
		
		
		$jq2 .=	'$(document).ready(function(){';
		
		$jq2 .=	'var options = {';
		$jq2 .=	'$AutoPlay: true,';
		
		$jq2 .=	'}; //end of options';
		
		$jq2 .=	'var jssor_slider1 = new $JssorSlider$("slider_container_1", options);';
		
		$jq2 .=	'}); //end of $(document).ready';
		$jq .=	'</script>';
			
		$GLOBALS['TSFE']->additionalHeaderData[] = $jq;
	}
    
} //end of class \N1coode\NjInternship\Controller\TestimonialController
?>
