<?php
include_once __DIR__ .  '/../vendor/autoload.php';

$page = $_GET['page'] ?? 'index';

if ($page === 'index') {

    echo mainController();

} elseif ($page === 'posts') {

    echo postsController();

} elseif ($page === 'post') {

    echo postController();

} elseif ($page === 'calc') {

    echo calcController();

} elseif ($page === 'create') {

    echo createPostController();
}





