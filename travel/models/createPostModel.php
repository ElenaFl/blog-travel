<?php
function createPostModel():array
{    // Инициализация данных формы
    $formData = [
        'title'      => '',
        'text'       => '',
        'category_id' => 0,
        'errors'     => [],
        'message'    => '',
        'message_type' => ''
    ];    

    // Обработка POST-запроса
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $inputData = [
            'title'       => trim($_POST['title'] ?? ''),
            'category_id' => trim($_POST['category_id'] ?? ''),
            'text'        => trim($_POST['text'] ?? '')
        ];
        
        $validationErrors = validatePostData($inputData);

        if (!$validationErrors || !array_filter($validationErrors))  {
            if (savePost($inputData)) {
                $formData['message']      = 'Запись успешно создана!';
                $formData['message_type'] = 'success';
            } else {
                $formData['message']      = 'Ошибка при сохранении';
                $formData['message_type'] = 'error';
            }
        } else {
            $formData['errors']     = $validationErrors;
            $formData = array_merge($formData, $inputData);
            $formData['message']    = 'Исправьте ошибки';
            $formData['message_type'] = 'error';
        }
    }
    return $formData;
}


function validatePostData(array $data): array
{
    $errors = [];

    if (empty(trim($data['title']))) {
        $errors['title'] = 'Заголовок обязателен';
    } else {
        $title = trim($data['title']);
        $len = mb_strlen($title, 'UTF-8');

        if ($len < 3) {
            $errors['title'] = 'Заголовок слишком короткий (минимум 3 символа)';
        } elseif ($len > 100) {
            $errors['title'] = 'Заголовок слишком длинный (максимум 100 символов)';
        }
    }

    if (empty($data['category_id']) || !ctype_digit($data['category_id']) || $data['category_id'] <= 0) {
        $errors['category_id'] = 'Выберите маршрут';
    }

    if (empty(trim($data['text']))) {
        $errors['text'] = 'Содержание обязательно';
    } else {
        $text = trim($data['text']);
        $len = mb_strlen($text, 'UTF-8');

        if ($len < 10) {
            $errors['text'] = 'Текст слишком короткий (минимум 10 символов)';
        } elseif ($len > 5000) {
            $errors['text'] = 'Текст слишком длинный (максимум 5000 символов)';
        }

        if (!empty($data['title']) && preg_match('/(.)\\1{5,}/u', $data['title'])) {
            $errors['title'] = 'Избегайте повтора символов в заголовке';
        }

        if (!empty($data['text']) && preg_match('/(.)\\1{10,}/u', $data['text'])) {
            $errors['text'] = 'Избегайте повтора символов в тексте';
        }

         $bannedWords = [
        'мат', 'оскорбление', 'спам', 'viagra', 'casino', 'loan',
        'free money', 'click here', 'xxx', 'porn', 'грабь', 'убивай',
        'взлом', 'ключ', 'аккаунт', 'бесплатно', 'выигрыш', 'приз'
        ];

        $combinedText = strtolower($data['title'] . ' ' . $data['text']);

        foreach ($bannedWords as $word) {
            if (stripos($combinedText, $word) !== false) {
                $errors['banned'] = 'Обнаружено запрещённое слово';
                break;
            }
        }
    }

    return $errors;
}







