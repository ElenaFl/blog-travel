<?php
function postController(): string
{
    $menu = menuController() ?? [];
    
    $breadcrumbs = brPostController() ?? [];

    $id = $_GET['id'] ?? null;

    $data = getPost($id);
    
    $content = renderPostsLayout('post', $data);

    return renderTemplate('main', [
        'menu' => $menu,
        'breadcrumbs' => $breadcrumbs,
        'content' => $content
    ]);
}