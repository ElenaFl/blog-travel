<?php
function brPostModel(): array
{
    $data = json_decode(file_get_contents(__DIR__ . "/../brPost.json"), true);
    $data['id'] = $_GET['id'] ?? null;
    return $data;
}