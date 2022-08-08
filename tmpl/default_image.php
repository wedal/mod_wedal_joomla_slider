<?php defined('_JEXEC') or die('Restricted access');

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
				echo '<img '.$src.'="/'.$slide->image.'" alt="'.$slide->slide_title.'">';
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
					echo '<img '.$src.'="/'.$slide->image.'" alt="'.$slide->slide_title.'">';
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
				echo '<a data-fancybox="images'. $module->id .'" href="'.$slide->image.'">';
					echo '<img '.$src.'="/'.$slide->image.'" alt="'.$slide->slide_title.'">';
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
