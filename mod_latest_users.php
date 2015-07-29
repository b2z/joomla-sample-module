<?php
/**
 * @package    Mod_Latest_Users
 * @author     Dmitry Rekun <b2z@joomlablog.ru>
 * @copyright  (C) 2014 - 2015 Dmitry Rekun. All rights reserved.
 * @license    GNU General Public License version 3 or later
 */

defined('_JEXEC') or die;

// Подключаем хелпер
require_once __DIR__ . '/helper.php';

// Получаем данные
$users = ModLatestusersHelper::getUsers($params);

// Получаем суффикс класса модуля из параметров и экранируем его
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

// Подключаем стили
if ($params->get('include_css', 1))
{
	JHtml::stylesheet('mod_latest_users/style.css', false, true);
}

// Подключаем макет вывода
require JModuleHelper::getLayoutPath('mod_latest_users', $params->get('layout', 'default'));

// Код AJAX запроса
?>
<script>
(function($) {
	$('.mlu-user').on('click', function(event) {
		event.preventDefault();
		var userid = $(this).data('userid'); // Получаем ID пользователя
		var target = $('#mlu-container-' + userid); // Устанавливаем контейнер для вывода данных

		// Формируем параметры запроса
		var request = {
			'option': 'com_ajax', // Используем AJAX интерфейс
			'module': 'latest_users', // Название модуля без mod_
			'format': 'json', // Формат возвращаемых данных
			'userid': userid // ID пользователя
		};

		// Посылаем AJAX запрос
		$.ajax({
			type: 'POST',
			data: request
		})
			.done(function(response) {
				// Есть успешный ответ сервера и данные
				if (response.success && response.data) {
					// Собираем список материалов
					var result = '<ul>';
					$.each (response.data, function(index, value) {
						result += '<li>' + value.title + '</li>';
					});
					result += '</ul>';

					// Заполняем контейнер списком материалов
					target.html(result).fadeIn();
				}

				// Есть успешный ответ сервера, но нет данных.
				if (response.success && !response.data) {
					target.html('<?php echo JText::_('MOD_LATEST_USERS_NO_ARTICLES'); ?>').addClass('text-warning').fadeIn();
				}

				// Есть неуспешный ответ сервера и текст ошибки
				if (!response.success && response.message) {
					target.html(response.message).addClass('text-error').fadeIn();
				}

				// Скрываем контейнер через 3 секунды
				setTimeout(function() {
					target.fadeOut();
				}, 3000);
			})
			.fail(function() {
				target.html('<?php echo JText::_('MOD_LATEST_USERS_ERROR_PROCESSING_REQUEST'); ?>').addClass('text-error').fadeIn();

				// Скрываем контейнер через 3 секунды
				setTimeout(function() {
					target.fadeOut();
				}, 3000);
			});
	});
})(jQuery);
</script>
