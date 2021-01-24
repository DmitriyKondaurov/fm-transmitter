<?php
require_once( __DIR__ . "/wp-domains.php" );
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wordpress');

/** Имя пользователя MySQL */
define('DB_USER', 'dima');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '3FgvSDRj');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '=0k4Z5]WuNU*6gM9Ux|[DNkk!{RY0[TU@n%n-nwbvNwC<1se#brnGozRn9;s925H');
define('SECURE_AUTH_KEY',  'y1U7_<~g,78@nv<r.zjqB.f:h8{T-^AQO==WX{lipRlLXk2z8WF$3q9gfX?^(hCn');
define('LOGGED_IN_KEY',    '5$@TrC d{5d6(#WXw1Khj3(gxvjA9TLZ.:Uo>J:-(cz~T9>jYd]~xp-TR?<oYVK*');
define('NONCE_KEY',        'bb/?|$0,mvsW+I<Z(I3+OO*)T| u-{lHHv:]@)fSvilh,@[O2nXy]7Du(8ji}dQ,');
define('AUTH_SALT',        'A,FS`+#e$6j6=5p*b6M&;?&ru=CA j`WBAo#k}F.`FMxV(iEn3~a>je@_l-_BXp7');
define('SECURE_AUTH_SALT', 'mo5+Hp^<JT$N1=8uUD/pik(bh<VF0MYuzhYi1z-|%Pl=nDva8V:lt6KJp(r %rj0');
define('LOGGED_IN_SALT',   'ilFx-DnpJ]/f(k1!?ljI%E~$`SP[H[9-PB`yR&R0qp]P,#|$>sP++w4H(LS6^1>k');
define('NONCE_SALT',       'eRU} iH6For4IU?RIg5]0C{JXV_HrPER[nZ1OS2SV=RAOl<me,>p(>7aLy`/ W>`');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');

