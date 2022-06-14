<?php

// Инициализируем сессию
session_start();

// Подключение в БД
function pdo(): PDO
{
    static $pdo;

    if (!$pdo) {
        if (file_exists(__DIR__ . '/config.php')) {
            $config = include __DIR__.'/config.php';
        } else {
            $msg = 'config.php';
            trigger_error($msg, E_USER_ERROR);
        }
        // Подключение к БД
        $dsn = 'mysql:dbname='.$config['db_name'].';host='.$config['db_host'];
        $pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return $pdo;
}

function flash(?string $message = null)
{
    if ($message) {
        $_SESSION['flash'] = $message;
    } //else {
      //  if ($_SESSION['flash']) { ?>
          <div class="alert alert-danger mb-3">
              <?//=$_SESSION['flash']?>
          </div>
        <?php }
      //  unset($_SESSION['flash']);
  //  }
//}

function check_auth(): bool
{
    return !!($_SESSION['user_id'] ?? false);
}

// Токен храним в сессии
 
$clientId     = '1111111'; // ID приложения
$clientSecret = 'mysecret'; // Защищённый ключ
$redirectUri  = 'http://mysite.ru/oauth.php'; // Адрес, на который будет переадресован пользователь после прохождения авторизации
 

$params = array(
	'client_id'     => $clientId,
	'redirect_uri'  => $redirectUri,
	'response_type' => 'code',
	'v'             => '5.126', // (обязательный параметр) версиb API https://vk.com/dev/versions
 
		'scope' => 'photos,offline',
);
 
// Вывод на экран ссылки для открытия окна диалога авторизации
//echo '<a href="http://oauth.vk.com/authorize?' . http_build_query( $params ) . '">Авторизация через ВКонтакте</a>';
