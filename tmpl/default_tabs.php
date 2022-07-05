<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Helper\TagsHelper;

$th = new TagsHelper();
$tags_ids = array_keys($slides);
$tagnames = $th->getTagNames($tags_ids);

if (!count($tagnames)) {
	return;
}

if ($params->get('enable')) {
	$enable = 'enabled';
} else {
	$enable = 'disabled';
}
?>

<div id="WedalJoomlaSlider<?php echo $moduleId ?>" data-id="<?php echo $moduleId ?>" data-itemid="<?php echo $itemid ?>" class="wedaljoomlaslider <?php echo $enable ?> slider-wr tabs <?php echo $moduleclass_sfx ?>" <?php echo $params->get('data-params'); ?>>

	<?php if ($slider_params->show_text == 'before' || $slider_params->show_text == 'both') { ?>
		<div class="slider-before-text">
			<?php echo $slider_params->before_text; ?>
		</div>
	<?php } ?>

	<div class="tabs">
		<ul class="tabs-titles">
		<?php foreach ($tagnames as $key => $tagname) { ?>
			<li data-tagid="<?php echo $tags_ids[$key] ?>" <?php echo ($key == 0) ? 'class="active"' : '' ?>>
				<span><?php echo $tagname ?></span>
			</li>
		<?php } ?>
		</ul>
	</div>

	<div class="slider">
		<?php foreach(current($slides) as $key => $slide) { ?>
			<div class="slide">
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
