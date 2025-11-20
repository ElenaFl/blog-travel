<?php
function menuModel(): array
{
    return json_decode(file_get_contents(__DIR__ . "/../menu.json"), true);
}
