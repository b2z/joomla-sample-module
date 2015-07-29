<?php
/**
 * @package    Mod_Latest_Users
 * @author     Dmitry Rekun <b2z@joomlablog.ru>
 * @copyright  (C) 2014 - 2015 Dmitry Rekun. All rights reserved.
 * @license    GNU General Public License version 3 or later
 */

defined('_JEXEC') or die;

/**
 * Хелпер для mod_latest_users
 *
 * @package  Mod_Latest_Users
 *
 * @since    1.0
 */
abstract class ModLatestusersHelper
{
	/**
	 * Метод получает список последних зарегистрированных пользователей
	 *
	 * @param   \Joomla\Registry\Registry  &$params  Параметры модуля
	 *
	 * @return  array  Список пользователей
	 *
	 * @since   1.0
	 * @throws  RuntimeException
	 */
	public static function getUsers(&$params)
	{
		// Получаем объект базы данных
		$db = JFactory::getDbo();

		// Получаем объект конструктора запросов
		$query = $db->getQuery(true);

		// Устанавливаем поля для выборки
		$fields = array('id', 'name', 'username');

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

	/**
	 * Метод получает список последних материалов пользователя
	 *
	 * @return  mixed  Заголовки материалов пользователя или null
	 *
	 * @since   1.1
	 * @throws  RuntimeException
	 */
	public static function getAjax()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select($db->quoteName('title'))
			->from($db->quoteName('#__content'))
			->where($db->quoteName('state') . ' = 1')
			->where($db->quoteName('created_by') . ' = ' . JFactory::getApplication()->input->getInt('userid'))
			->order($db->quoteName('created') . ' DESC');

		$db->setQuery($query, 0, 3);
		$result = $db->loadObjectList();

		if (!empty($result))
		{
			return $result;
		}

		return null;
	}
}
