<?php
/**
 * @package    Mod_Latest_Users
 * @author     Dmitry Rekun <b2z@joomlablog.ru>
 * @copyright  (C) 2014 - 2015 Dmitry Rekun. All rights reserved.
 * @license    GNU General Public License version 3 or later
 */

defined('_JEXEC') or die;

/** @var  $params  \Joomla\Registry\Registry */
$displayMode = $params->get('display_mode', 0);
?>
<table class="latest_users<?php echo $moduleclass_sfx; ?>">
	<?php if ($users) : ?>
		<?php foreach ($users as $user) : ?>
			<tr><td>
				<a href="#" class="mlu-user" data-userid="<?php echo $user->id; ?>">
					<?php if ($displayMode == 0) : ?>
						<?php echo $user->username; ?>
					<?php elseif ($displayMode == 1) : ?>
						<?php echo $user->name; ?>
					<?php elseif ($displayMode == 2) : ?>
						<?php echo $user->username; ?> (<?php echo $user->name; ?>)
					<?php endif; ?>
				</a>
				<div id="mlu-container-<?php echo $user->id; ?>" style="display:none"></div>
			</td></tr>
		<?php endforeach; ?>
	<?php else : ?>
		<tr><td><?php echo JText::_('MOD_LATEST_USERS_NO_USERS'); ?></td></tr>
	<?php endif; ?>
</table>
