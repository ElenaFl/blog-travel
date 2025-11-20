<?php
function createPostContentModel(): array
{
    return json_decode(file_get_contents(__DIR__ . "/../createPostContent.json"), true);
}