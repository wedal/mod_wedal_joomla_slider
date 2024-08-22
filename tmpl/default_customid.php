<?php defined('_JEXEC') or die('Restricted access');

/*
Этот макет выводит тип слайда "Произвольный ID". С его помощью можно получить и загрузить в слайдер какой-либо тип контента (товар, категория, статья и др).
Код получения типа контента по его ID нужно написать самостоятельно, переопределив этот или основной макет в шаблон Joomla, который вы используете.

Массив произвольных ID доступен во всех макетах в переменной $custom_ids в формате:
$custom_ids[порядковый номер слайда в массиве $slides] => Производный ID для этого слайда

*/

if ($params->get('enable')) {
	$src = 'data-lazy';
} else {
	$src = 'src';
}
?>
<div class="slide <?php echo (isset($readmore) && $key > ($readmore-1)) ? 'hide' : '' ?>">
	<div class="slide-wr">
		<?php switch ($slide->behavior) {
			// Без действия
			case 'none':
				echo $slide->custom_id;
				if ($slide->slide_title || $slide->slide_desc) {
					echo '<div class="slide-info">';
						if ($slide->slide_title) {
							echo '<div class="slide-title">'.$slide->slide_title.'</div>';
						}
						if ($slide->slide_desc) {
							echo '<div class="slide-desc">'.$slide->slide_desc.'</div>';
						}
					echo '</div>';
				}
				break;

			// Переход по ссылке
			case 'golink':
				echo '<a href="'.$slide->slide_link.'">';
                    echo $slide->custom_id;
					if ($slide->slide_title || $slide->slide_desc) {
						echo '<div class="slide-info">';
							if ($slide->slide_title) {
								echo '<div class="slide-title">'.$slide->slide_title.'</div>';
							}
							if ($slide->slide_desc) {
								echo '<div class="slide-desc">'.$slide->slide_desc.'</div>';
							}
						echo '</div>';
					}
				echo '</a>';
				break;

			// Всплывающее окно
			case 'modal':
                echo '<a data-fancybox="images'. $module->id .'" href="'.$slide->image.'" data-caption="'.$slide->slide_title.'">';
                    echo $slide->custom_id;
					if ($slide->slide_title || $slide->slide_desc) {
						echo '<div class="slide-info">';
							if ($slide->slide_title) {
								echo '<div class="slide-title">'.$slide->slide_title.'</div>';
							}
							if ($slide->slide_desc) {
								echo '<div class="slide-desc">'.$slide->slide_desc.'</div>';
							}
						echo '</div>';
					}
				echo '</a>';
				break;

			default:
				break;
		} ?>
	</div>
</div>
