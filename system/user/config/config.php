<?php

/** @var array $config */

$global = [];

$query = [];
$isCpJsRequest = false;

if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']) {
    parse_str($_SERVER['QUERY_STRING'], $query);
}

$isCpJsRequest = isset($query['C']) && $query['C'] === 'javascript';

$sep = DIRECTORY_SEPARATOR;

defined('SERVER_NAME') || define('SERVER_NAME', getenv('SERVERNAME'));

if (! $isCpJsRequest && getenv('DEV_MODE') === 'true') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$config['debug'] = getenv('DEV_MODE') === 'true' && ! $isCpJsRequest ? '2' : '0';

// Cache settings
$config['cache_driver'] = getenv('CACHE_DRIVER');// Domain and protocol logic
$secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
$protocol = $secure ? 'https://' : 'http://';

// Dynamic path settings
$baseUrl = $protocol . SERVER_NAME;
$basePath = dirname(dirname(dirname(__DIR__))) . '/public';
$imagesFolder = 'images';
$imagesPath = $basePath . DIRECTORY_SEPARATOR . $imagesFolder;
$imagesUrl = $baseUrl . '/' . $imagesFolder;
$uploadsPath = $basePath . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;

$config['base_url'] = $baseUrl;
$config['base_path'] = $basePath;
$config['site_index'] = '';
$config['site_url'] = $baseUrl;
$config['cp_url'] = $baseUrl . '/cms/';
$config['theme_folder_path'] = $basePath . '/themes/';
$config['theme_folder_url'] = $baseUrl . '/themes/';
$config['captcha_path'] = $imagesPath . '/captchas/';
$config['captcha_url'] = $imagesUrl . '/captchas/';
$config['avatar_path'] = $imagesPath . '/avatars/';
$config['avatar_url'] = $imagesUrl . '/avatars/';

// Cookie & session settings
$config['cookie_domain'] = '';
$config['cookie_httponly'] = 'y';
$config['cookie_path'] = '';
$config['website_session_type'] = 'c';

// Template settings
$config['save_tmpl_files'] = 'y';
$config['enable_template_routes'] = 'n';

// Debugging
$config['show_profiler'] = getenv('SHOW_PROFILER') === 'true' && ! $isCpJsRequest ? 'y' : 'n';
$config['template_debugging'] = getenv('SHOW_PROFILER') === 'true' && ! $isCpJsRequest ? 'y' : 'n';

// Tracking & performance settings
$config['disable_all_tracking'] = 'y';
$config['enable_hit_tracking'] = 'n';
$config['log_referrers'] = 'n';
$config['autosave_interval_seconds'] = '0';

// Control Panel
$config['cp_session_type'] = 'c';
$config['rte_enabled'] = 'n';

// General settings
$config['is_system_on'] = 'y';
$config['allow_extensions'] = 'y';
$config['profile_trigger'] = uniqid('', true);
$config['use_category_name'] = 'n';
$config['reserved_category_word'] = '';
$config['enable_emoticons'] = 'n';
$config['site_404'] = 'core/_404';

$config['is_system_on'] = 'y';
$config['multiple_sites_enabled'] = 'n';

$config['app_version'] = '4.3.1';
$config['encryption_key'] = '435b211cbf7307aa4aba2eb9a19d698848d7b34d';
$config['session_crypt_key'] = '36ea7988ad527586245093279a4959cfb20d55e7';
$config['database'] = array(
    'expressionengine' => array(
        'hostname' => getenv('DB_HOST'),
        'database' => getenv('DB_DATABASE'),
        'username' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'dbprefix' => 'exp_',
        'char_set' => 'utf8mb4',
        'dbcollat' => 'utf8mb4_unicode_ci',
        'port'     => ''
    ),
);