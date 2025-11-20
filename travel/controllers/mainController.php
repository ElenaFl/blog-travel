<?php
function mainController(): string
{
    $menu = menuController() ?? [];
    
    $breadcrumbs = brMainController() ?? [];

    $content = mainContentController() ?? [];

    return renderTemplate('main', [
        'menu' => $menu,
        'breadcrumbs' => $breadcrumbs,
        'content' => $content
    ]);
}