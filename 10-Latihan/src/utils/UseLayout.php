<?php
function UseLayout(
    $content,
    $meta,
    $layout,
    $middlewares
) {
    require_once __DIR__ . "/../layouts/" . $layout . ".php";

    if ($middlewares) {
        $fn_middleware = require_once __DIR__ . "/../middlewares/" . $middlewares . ".php";

        if ($fn_middleware) {
            return Layout($content, $meta);
        }

        return Layout("Login First");
    }

    return Layout($content, $meta);
}