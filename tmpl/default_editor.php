<?php
defined('_JEXEC') or die('Restricted access');

switch ($slide->behavior) {

	// Без действия
	case 'none':
		echo '<div class="slider-content-wr">';
			echo '<div class="slider-content1">'.$slide->editor.'</div>';
			if ($slide->slide_title || $slide->slide_desc) {
				echo '<div class="slide-info container">';
					if ($slide->slide_title) {
						echo '<div class="slide-title">'.$slide->slide_title.'</div>';
					}
					if ($slide->slide_desc) {
						echo '<div class="slide-desc">'.$slide->slide_desc.'</div>';
					}
				echo '</div>';
			}
		echo '</div>';
		break;

	// Переход по ссылке
	case 'golink':
		echo '<a class="slider-content-wr" href="'.$slide->slide_link.'">';
			echo '<div class="slider-content">'.$slide->editor.'</div>';
			if ($slide->slide_title || $slide->slide_desc) {
				echo '<div class="slide-info container">';
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

	//Всплывающее окно
	case 'modal':
		echo '<a class="slider-content-wr" data-fancybox data-src="#popuop-'.$key.'" data-fancybox="images" href="javascript:;">';
			echo '<div class="slider-content">'.$slide->editor.'</div>';

			if ($slide->slide_title || $slide->slide_desc) {
				echo '<div class="slide-info container">';
					if ($slide->slide_title) {
						echo '<div class="slide-title">'.$slide->slide_title.'</div>';
					}
					if ($slide->slide_desc) {
						echo '<div class="slide-desc">'.$slide->slide_desc.'</div>';
					}
				echo '</div>';
			}
			if ($slide->readmore_editor) {
				echo '<div id="popuop-'.$key.'">'.$slide->readmore_editor.'</div>';
			}
		echo '</a>';
		break;

	default:
		echo 'Не выбрано поведение слайда при клике. Проверьте настройки.';
		break;
} ?>
