<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

JLoader::register('ModWedalJoomlaSliderHelper', __DIR__ . '/helper.php');
$jinput = Factory::getApplication()->input;

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->useScript('jquery');
$wa->useScript('slick');

HTMLHelper::_('script','mod_wedal_joomla_slider/mod_wedal_joomla_slider.js',	['relative' => true], ['defer ' => 'defer']);

$moduleId = $module->id;
$itemid = $jinput->get('Itemid', null, 'int');
//$moduleWidth = $params->get('width', '');

$slides = ModWedalJoomlaSliderHelper::getSlides($params);

$slider_params = new stdClass();
$slider_params->number_of_slides = $params->get('number_of_slides');
$slider_params->autoplay = $params->get('autoplay');
$slider_params->autoplay_interval = $params->get('autoplay_interval');
$slider_params->slides_to_scroll = $params->get('slides_to_scroll');
$slider_params->slick_params = $params->get('slick_params');

if($params->get('autoplay')) {
    $slider_params->autoplay = 'true';
} else {
    $slider_params->autoplay = 'false';
}

if($params->get('show_handles')) {
    $slider_params->show_handles = 'true';
} else {
    $slider_params->show_handles = 'false';
}

if($params->get('show_dots')) {
    $slider_params->show_dots = 'true';
} else {
    $slider_params->show_dots = 'false';
}

$slider_params->show_text = $params->get('show_text');

switch ($slider_params->show_text) {
    case 'before':
        $slider_params->before_text = $params->get('before_text');
        break;

    case 'after':
        $slider_params->after_text = $params->get('after_text');
        break;

    case 'both':
        $slider_params->before_text = $params->get('before_text');
        $slider_params->after_text = $params->get('after_text');
        break;

    default:
        break;
}

if ($params->get('enable')) {
	$options[] = 'enabled';
} else {
	$options[] = 'disabled';
    if ($params->get('readmore')) {
        $options[] = 'readmore';
    }
}

$class_options = implode(' ', $options);

if(!$params->get('enable') && $params->get('readmore')) {
    $readmore = $params->get('readmore_slides');
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

$layout = $params->get('layout', 'default');

if ($params->get('show_tabs')) {
    $layout .= '_tabs';
}

require JModuleHelper::getLayoutPath('mod_wedal_joomla_slider', $layout);
