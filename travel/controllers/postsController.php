<?php
function postsController(): string
{
    $menu = menuController() ?? [];
    
    $breadcrumbs = brPostsController() ?? [];

    $data = postModel();

    $content = renderPostsLayout('posts', $data);

    return renderTemplate('main', [
        'menu'        => $menu,
        'breadcrumbs' => $breadcrumbs,
        'content'     => $content,
    ]);
}








