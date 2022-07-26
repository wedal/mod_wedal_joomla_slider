<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$j_version = substr(JVERSION, 0,1);

JLoader::register('ModWedalJoomlaSliderHelper', __DIR__ . '/helper.php');
$app = Factory::getApplication();
$jinput = $app->input;
$document = $app->getDocument();

if ($j_version == 4) {
    $wa = $document->getWebAssetManager();
}

if($params->get('enable_jquery')) {
    HTMLHelper::_('jquery.framework');
}

if($params->get('enable_css')) {
    HTMLHelper::_('stylesheet','mod_wedal_joomla_slider/mod_wedal_joomla_slider.css',	['relative' => true], ['defer ' => 'defer']);
}

if ($params->get('enable')) {
    HTMLHelper::_('script','mod_wedal_joomla_slider/slick.min.js',	['relative' => true], ['defer ' => 'defer']);
}

if ($params->get('enable_fancybox')) {
    HTMLHelper::_('script','mod_wedal_joomla_slider/fancybox.min.js',	['relative' => true], ['defer ' => 'defer']);
    HTMLHelper::_('stylesheet','mod_wedal_joomla_slider/fancybox.min.css',	['relative' => true], ['defer ' => 'defer']);
}



HTMLHelper::_('script','mod_wedal_joomla_slider/mod_wedal_joomla_slider.js',	['relative' => true], ['defer ' => 'defer']);

$itemid = $jinput->get('Itemid', null, 'int');
$slides = ModWedalJoomlaSliderHelper::getSlides($params);

if (!$slides) {
    echo Text::_('MOD_WEDAL_JOOMLA_SLIDER_NOSLIDES');
    return false;
}

if ($params->get('enable')) {
	$options[] = 'enabled';
} else {
	$options[] = 'disabled';
    if ($params->get('readmore')) {
        $options[] = 'readmore';
    }
}

if ($params->get('center_mode')) {
    $options[] = 'centermode';
}

$class_options = implode(' ', $options);

if(!$params->get('enable') && $params->get('readmore')) {
    $readmore = $params->get('readmore_slides');
} else {
    $readmore = null;
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
$layout = $params->get('layout', 'default');

if ($params->get('show_tabs')) {
    $layout .= '_tabs';
}

require JModuleHelper::getLayoutPath('mod_wedal_joomla_slider', $layout);
