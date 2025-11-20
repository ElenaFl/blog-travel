<?php
function postModel(): array
{
$data = [
        'title'      => '',
        'text'       => '',
        'category_id' => 0,
        'posts'      => [],
        'errors'     => [],
        'message'    => '',
        'message_type' => ''
    ];

    // Загрузка постов
    $posts = json_decode(file_get_contents(__DIR__ . '/../posts.json'), true) ?? [];
    if (!empty($posts)) {
        $data['posts'] = $posts;
    }

    // Обработка POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Собираем данные
        $formData = [
            'title'       => trim($_POST['title'] ?? ''),
            'category_id' => trim($_POST['category_id'] ?? ''),
            'text'        => trim($_POST['text'] ?? '')
        ];

        // Валидация
        $validationErrors = validatePostData($formData);

        if (empty($validationErrors)) {
            // Сохраняем пост
            if (savePost($formData)) {
                $data['message']      = 'Запись успешно создана!';
                $data['message_type'] = 'success';
            } else {
                $data['message']      = 'Ошибка при сохранении';
                $data['message_type'] = 'error';
            }
        } else {
            // ВАЖНО: передаём ошибки и введённые данные в шаблон
            $data['errors']     = $validationErrors;
            $data['message']    = 'Исправьте ошибки ниже';
            $data['message_type'] = 'error';
            // Сохраняем введённые значения (чтобы форма не очищалась)
            $data = array_merge($data, $formData);
        }
    }
    return $data;
}

function getPosts(): array
{
    return json_decode(file_get_contents(ROOT_PATH . '/posts.json'), true);
}
function getPost(int $id): ?array
{
    return getPosts()[$id] ?? null;
}

function savePost(array $post): bool
{
    try {
        $posts = json_decode(file_get_contents(__DIR__ . '/../posts.json'), true) ?? [];

        // Генерируем ID для нового поста
        $post['id'] = !empty($posts) ? max(array_column($posts, 'id')) + 1 : 1;
        $post['created_at'] = date('Y-m-d H:i:s');

        $posts[] = $post;

        file_put_contents(
            __DIR__ . '/../posts.json',
            json_encode($posts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );

        return true;
    } catch (Exception $e) {
        error_log('Ошибка сохранения поста: ' . $e->getMessage());
        return false;
    }
}
