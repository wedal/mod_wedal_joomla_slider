<?php
defined('_JEXEC') or die('Restricted access');

?>

<div id="WedalJoomlaSlider<?php echo $moduleId ?>" class="wedaljoomlaslider <?php echo $class_options ?> slider-wr  <?php echo $moduleclass_sfx ?>" <?php echo $params->get('data-params'); ?>>

	<?php if ($slider_params->show_text == 'before' || $slider_params->show_text == 'both') { ?>
		<div class="slider-before-text">
			<?php echo $slider_params->before_text; ?>
		</div>
	<?php } ?>

	<div class="slider" <?php echo ($readmore) ? 'data-readmore='.$readmore : '' ?>>
		<?php foreach ($slides as $key => $slide) { ?>
			<div class="slide <?php echo ($readmore && $key > $readmore-1) ? 'hide' : '' ?>">
				<?php switch ($slide->source_type) {
					// Шаблоны каждого источника контента хранятся в отдельных подмакетах
					case 'image':
						require JModuleHelper::getLayoutPath('mod_wedal_joomla_slider', $params->get('layout', 'default') . '_image');
						break;

					case 'youtube':
						require JModuleHelper::getLayoutPath('mod_wedal_joomla_slider', $params->get('layout', 'default') . '_youtube');
						break;

					case 'editor':
						require JModuleHelper::getLayoutPath('mod_wedal_joomla_slider', $params->get('layout', 'default') . '_editor');
						break;

					default:
						echo 'Не выбран источник контента для слайда';
						break;
				} ?>

			</div>
		<?php } ?>
	</div>

	<?php if ($readmore && (count($slides) > $readmore)) { ?>
		<div class="readmore-link" data-alttitle="Свернуть">Смотреть все</div>
	<?php } ?>

	<?php if ($slider_params->show_text == 'after' || $slider_params->show_text == 'both') { ?>
		<div class="slider-after-text">
			<?php echo $slider_params->after_text; ?>
		</div>
	<?php } ?>

</div>

<?php //Инициализация слайдера. Можно дописать то, чего не хватает в настройках J
if ($params->get('enable')) {
	$js = "
	jQuery(document).ready(function($) {
		$('#WedalJoomlaSlider".$moduleId." .slider').slick({
			lazyLoad: 'ondemand',
			slidesToShow: ".$slider_params->number_of_slides.",
			slidesToScroll: ".$slider_params->slides_to_scroll.",
			autoplay: ".$slider_params->autoplay.",
			autoplaySpeed: ".$slider_params->autoplay_interval.",
			arrows: ".$slider_params->show_handles.",
			dots: ".$slider_params->show_dots."
			";
			if ($slider_params->slick_params) {
				$js .= " , " . $slider_params->slick_params;
			}
	$js .= "});
	});";

	$wa->addInlineScript($js);
}
?>
