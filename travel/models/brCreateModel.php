<?php
function brCreateModel(): array
{
    return json_decode(file_get_contents(__DIR__ . "/../brCreatePost.json"), true);

}