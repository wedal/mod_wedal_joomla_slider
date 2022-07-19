<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Helper\TagsHelper;

$th = new TagsHelper();
$tags_ids = array_keys($slides);
$tagnames = $th->getTagNames($tags_ids);

if (!count($tagnames)) {
	return;
}
?>

<div id="WedalJoomlaSlider<?php echo $module->id ?>" data-id="<?php echo $module->id ?>" data-itemid="<?php echo $itemid ?>" class="wedaljoomlaslider <?php echo ($params->get('enable')) ? 'enabled' : 'disabled' ?> slider-wr tabs <?php echo $moduleclass_sfx ?>" <?php echo $params->get('data-params'); ?>>

    <?php if ($params->get('show_text') == 'before' || $params->get('show_text') == 'both') { ?>
        <div class="slider-before-text">
            <?php echo $params->get('before_text') ?>
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
		<?php } ?>
	</div>

    <?php if ($params->get('show_text') == 'after' || $params->get('show_text') == 'both') { ?>
        <div class="slider-after-text">
            <?php echo $params->get('after_text') ?>
        </div>
    <?php } ?>

</div>

<?php //Инициализация слайдера. Можно дописать то, чего не хватает в настройках J
if ($params->get('enable')) {
    $js = "
	jQuery(document).ready(function($) {
		$('#WedalJoomlaSlider".$module->id." .slider').slick({
			". ($params->get('lazy_load') ? 'lazyLoad: "'. $params->get('lazy_load') .'",' : '') ."
			slidesToShow: ".$params->get('number_of_slides').",
			slidesToScroll: ".$params->get('slides_to_scroll').",
			autoplay: ".($params->get('autoplay') ? 'true' : 'false').",
			autoplaySpeed: ".$params->get('autoplay_interval').",
			arrows: ".($params->get('show_handles') ? 'true' : 'false').",
			dots: ".($params->get('show_dots') ? 'true' : 'false').",
			centerMode: ".($params->get('center_mode') ? 'true' : 'false').",
			fade: ".($params->get('fade') ? 'true' : 'false').",
			variableWidth: ".($params->get('variable_width') ? 'true' : 'false').",	
			adaptiveHeight: ".($params->get('adaptive_height') ? 'true' : 'false')."
			";
    if ($params->get('slick_params')) {
        $js .= " , " . $params->get('slick_params');
    }
    $js .= "});
	});";

    if ($j_version == 4) {
        $wa->addInlineScript($js);
    } else {
        $document->addScriptDeclaration($js);
    }
}
?>
