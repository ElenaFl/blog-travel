<?php
function createPostController(): string
{
    $menu = menuController() ?? [];

    $breadcrumbs = brCreateController() ?? [];

    $formData = createPostModel() ?? [];

    // Загрузка данных из json-файла (включая caption и categories)
    $createContent = json_decode(file_get_contents(__DIR__ . '/../createPostContent.json'), true);

    $caption = $createContent['caption'] ?? 'Создание поста';
    
    $categories = $createContent['categories'] ?? [];

    $content = renderPostsLayout(
        'createPost',
        [...$formData,
            'categories' => $categories,
            'caption'    => $caption
        ]
    );

    return renderTemplate('main', [
        'menu'        => $menu,
        'breadcrumbs' => $breadcrumbs,
        'content'     => $content,
    ]);
}



