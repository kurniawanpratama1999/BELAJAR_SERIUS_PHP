<?php
require_once __DIR__ . '/utils/UseLayout.php';

$current_url = rtrim(string: $_SERVER['REQUEST_URI'], characters: "/");
$current_url = preg_replace(pattern: '/\.php$/', replacement: '', subject: $current_url);
$temp_file = $_SERVER['DOCUMENT_ROOT'] . "/src/pages" . strtolower(string: $current_url);
$temp_file = htmlspecialchars(string: $temp_file);
$fix_file =
    file_exists(filename: (string) $temp_file . ".php")
    ? (string) $temp_file . ".php"
    : (string) $temp_file . "/index.php";

if (file_exists(filename: $fix_file)) {
    $comp = require_once $fix_file;
    $content = $comp['content'];
    $meta = $comp['meta'] ?? [];
    $layout = $comp['layout'] ?? "DefaultLayout";
    $middleware = $comp['middleware'];

    return UseLayout($content, $meta, $layout, $middleware);
}

http_response_code(response_code: 404);
return UseLayout(content: "<p>404 | NOT FOUND</p>", meta: [], layout: "DefaultLayout", middlewares: false);