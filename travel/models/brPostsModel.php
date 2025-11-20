<?php
function brPostsModel(): array
{
    return json_decode(file_get_contents(__DIR__ . "/../brPosts.json"), true);
}