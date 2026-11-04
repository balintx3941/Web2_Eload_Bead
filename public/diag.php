
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo 'PHP: ' . PHP_VERSION . '<br>';
echo 'pdo_mysql: ' . (extension_loaded('pdo_mysql') ? 'OK' : 'NINCS') . '<br>';

foreach (['vendor/autoload.php', 'bootstrap/app.php', '.env', 'storage/logs', 'storage/framework/views', 'bootstrap/cache'] as $f) {
    echo $f . ': ' . (file_exists(__DIR__ . '/../' . $f) ? 'OK' : 'HIÁNYZIK') . '<br>';
}
echo 'storage írható: ' . (is_writable(__DIR__ . '/../storage') ? 'igen' : 'NEM') . '<br>';

require __DIR__ . '/../vendor/autoload.php';
echo 'autoload OK<br>';

$app = require __DIR__ . '/../bootstrap/app.php';
echo 'app OK<br>';
