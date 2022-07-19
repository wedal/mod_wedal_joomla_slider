<?php defined('_JEXEC') or die('Restricted access'); ?>

<div class="slide <?php echo ($readmore && $key > ($readmore-1)) ? 'hide' : '' ?>">
	<div class="slide-wr">
		<?php switch ($slide->behavior) {
			// Без действия
			case 'none':
				echo '<iframe src="https://www.youtube.com/embed/'.$slide->youtube.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
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
					echo '<iframe src="https://www.youtube.com/embed/'.$slide->youtube.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
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
				echo '<a data-fancybox="images'. $module->id .'" href="https://www.youtube.com/embed/'.$slide->youtube.'">';
					echo '<div class="youtube_bgr" style="background-image: url(https://i.ytimg.com/vi/'.$slide->youtube.'/hqdefault.jpg);">
						<div class="yb"></div>
					</div>';

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