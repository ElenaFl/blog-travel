<?php
function calcController(): string {

   $menu = menuController() ?? [];

    $breadcrumbs = brCalcController() ?? [];

    $data = calaModel();

    $content = renderLayout('calc', $data);

    return renderTemplate('main', [
        'menu' => $menu,
        'breadcrumbs' => $breadcrumbs,
        'content' => $content,
    ]);

}