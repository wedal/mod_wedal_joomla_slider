<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Response\JsonResponse;

/**
 * Helper for mod_wedal_joomla_slider
 */
class ModWedalJoomlaSliderHelper
{
	public static function getParams($moduleId) {
		$module = ModuleHelper::getModuleById((string) $moduleId);
		$params = new JRegistry;
		$params->loadString($module->params);

		return $params;
	}

	public static function getSlides($params)
	{
		if ($params->get('show_tabs')) {
			$slides = $params->get('list_templates_tabs');
			$slides = array_values(get_object_vars($slides));

			if (!$slides) {
			    return false;
            }

			$tags_ids = array();
			foreach ($slides as $slide) {
				$tags_ids = array_merge($tags_ids, $slide->tags);
			}

			$tags_ids = array_unique($tags_ids);
			$slides_tabs = array();

			foreach ($tags_ids as $tag_id) {
				foreach ($slides as $slide_key => $slide) {
					if (in_array($tag_id, $slide->tags)) {
						$slides_tabs[$tag_id][$slide_key] = $slide;
					}
				}
			}
			$slides = $slides_tabs;
		} else {
			$slides = $params->get('list_templates');

            if (!$slides) {
                return false;
            }

			$slides = array_values(get_object_vars($slides));
		}

		return $slides;
	}

	public static function getSlidesByTagAjax()
	{
		$jinput = Factory::getApplication()->input;
		$mod_id = $jinput->get('id', null, 'int');
		$tag_id = $jinput->get('tagid', null, 'int');

		if (!$mod_id || !$tag_id) {
			return false;
		}

		$params = self::getParams($mod_id);

		$slides = self::getSlides($params);

		if (!$slides[$tag_id]) {
			return false;
		}

		$slides_ajax = array();
		foreach($slides[$tag_id] as $key => $slide) {
			switch ($slide->source_type) {
				case 'image':
					ob_start();
					htmlspecialchars(require JModuleHelper::getLayoutPath('mod_wedal_joomla_slider', $params->get('layout', 'default') . '_image'), ENT_QUOTES);
					$slides_ajax[$key] = ob_get_contents();
					ob_end_clean();
					break;

				case 'youtube':
					ob_start();
					htmlspecialchars(require JModuleHelper::getLayoutPath('mod_wedal_joomla_slider', $params->get('layout', 'default') . '_youtube'), ENT_QUOTES);
					$slides_ajax[$key] = ob_get_contents();
					ob_end_clean();
					break;

				case 'editor':
					ob_start();
					htmlspecialchars(require JModuleHelper::getLayoutPath('mod_wedal_joomla_slider', $params->get('layout', 'default') . '_editor'), ENT_QUOTES);
					$slides_ajax[$key] = ob_get_contents();
					ob_end_clean();
					break;

				default:
					$slides_ajax[$key] = 'Не выбран источник контента для слайда';
					break;
			}
		 }

		return new JsonResponse($slides_ajax);
	}
}
