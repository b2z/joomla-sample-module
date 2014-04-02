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
<div class="latest_users<?php echo $moduleclass_sfx; ?>">
	<?php if ($users) : ?>
		<ul id="latest_users_list">
			<?php foreach ($users as $user) : ?>
				<li>
					<?php if ($displayMode == 0) : ?>
						<?php echo $user->username; ?>
					<?php elseif ($displayMode == 1) : ?>
						<?php echo $user->name; ?>
					<?php elseif ($displayMode == 2) : ?>
						<?php echo $user->username; ?> (<?php echo $user->name; ?>)
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<span><?php echo JText::_('MOD_LATEST_USERS_NO_USERS'); ?></span>
	<?php endif; ?>
</div>
