<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_latest_users
 *
 * @copyright   Информация о копирайте
 * @license     Информация о лицензии
 */

defined('_JEXEC') or die;

/**
 * Хелпер для mod_latest_users
 *
 * @package     Joomla.Site
 * @subpackage  mod_latest_users
 *
 * @since       1.0
 */
abstract class ModLatestusersHelper
{
	/**
	 * Метод получает список последних зарегистрированных пользователей
	 *
	 * @param   JRegistry  &$params  Параметры модуля
	 *
	 * @return  mixed  Список пользователей или null
	 */
	public static function getUsers(&$params)
	{
		// Получаем объект базы данных
		$db = JFactory::getDbo();

		// Получаем объект конструктора запросов
		$query = $db->getQuery(true);

		// Устанавливаем поля для выборки
		$fields = array('name', 'username');

		// Конструируем запрос
		$query->select($db->quoteName($fields))
			->from($db->quoteName('#__users'))
			->where($db->quoteName('block') . ' = 0')
			->order($db->quoteName('registerDate') . ' DESC');

		// Устанавливаем запрос
		$db->setQuery($query, 0, $params->get('count', 5));

		// Выполняем запрос и получаем результат
		$result = $db->loadObjectList();

		return $result;
	}
}
