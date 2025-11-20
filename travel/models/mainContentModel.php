<?php
function mainContentModel(): array
{
    return json_decode(file_get_contents(__DIR__ . "/../mainContent.json"), true);
}