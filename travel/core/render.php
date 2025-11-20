<?php

// частичный шаблон - отрисовка части страницы (menu, header, footer)
function renderPartial(string $page): string
{
    ob_start();
    include __DIR__ . "/../views/parts/$page.phtml";
    return ob_get_clean();
}
function renderPath(string $page, string $creat): string
{
    ob_start();
    include __DIR__ . "/../views/parts/$page.phtml";
    return ob_get_clean();
}

function renderParts(string $page, array $data):string
{
    ob_start();
    extract($data);
    include __DIR__ . "/../views/parts/$page.phtml";
    return ob_get_clean();
}


// шаблон слоя - отрисовка контента страницы (main)
function renderLayout(string $page, array $data): string
{
    ob_start();
    extract($data);
    include __DIR__ . "/../views/layouts/$page.phtml";
    return ob_get_clean();
}

function renderPostsLayout(string $page, array $data): string
{
    extract($data, EXTR_SKIP);
    ob_start();    
    include __DIR__ . "/../views/layouts/posts/$page.phtml";
    return ob_get_clean();
}

/**
 *  главный шаблон, отрисовывает всю страницу (в него включаются частичный шаблон и шаблон слоев в составе контроллеров)
 */
function renderTemplate(string $template, array $params): string
{
    ob_start();
    extract($params);
    include __DIR__ . "/../views/$template.phtml";
    return ob_get_clean();
}





