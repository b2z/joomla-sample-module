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
<div class="latest_users<?php echo $moduleclass_sfx; ?>">
	<?php if ($users) : ?>
		<ul id="latest_users_list">
			<?php foreach ($users as $user) : ?>
			<li>
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
			</li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<span><?php echo JText::_('MOD_LATEST_USERS_NO_USERS'); ?></span>
	<?php endif; ?>
</div>
