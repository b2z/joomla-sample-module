<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_latest_users
 *
 * @copyright   Информация о копирайте
 * @license     Информация о лицензии
 */

defined('_JEXEC') or die;

// Подключаем хелпер
require_once __DIR__ . '/helper.php';

// Получаем данные
$users = modLatestusersHelper::getUsers($params);

// Получаем суффикс класса модуля из параметров и экранируем его
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

// Подключаем стили
if ($params->get('include_css', 1))
{
	JHtml::stylesheet('mod_latest_users/style.css', false, true, false);
}

// Подключаем макет вывода
require JModuleHelper::getLayoutPath('mod_latest_users', $params->get('layout', 'default'));
