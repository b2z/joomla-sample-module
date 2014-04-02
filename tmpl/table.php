<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_latest_users
 *
 * @copyright   Информация о копирайте
 * @license     Информация о лицензии
 */

defined('_JEXEC') or die;

$displayMode = $params->get('display_mode', 0);
?>
<table class="latest_users<?php echo $moduleclass_sfx; ?>">
	<?php if ($users) : ?>
		<?php foreach ($users as $user) : ?>
			<tr><td>
				<?php if ($displayMode == 0) : ?>
					<?php echo $user->username; ?>
				<?php elseif ($displayMode == 1) : ?>
					<?php echo $user->name; ?>
				<?php elseif ($displayMode == 2) : ?>
					<?php echo $user->username; ?> (<?php echo $user->name; ?>)
				<?php endif; ?>
			</td></tr>
		<?php endforeach; ?>
	<?php else : ?>
		<tr><td><?php echo JText::_('MOD_LATEST_USERS_NO_USERS'); ?></td></tr>
	<?php endif; ?>
</table>
