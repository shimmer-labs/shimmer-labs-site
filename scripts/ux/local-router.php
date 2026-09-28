<?php
$root = '/Users/loganherr/shimmer-labs-site';
$path = $root . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (is_file($path) && strpos(realpath($path), $root . '/assets') === 0) { return false; }
require $root . '/index.php';
