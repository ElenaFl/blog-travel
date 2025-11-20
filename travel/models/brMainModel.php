<?php
function brMainModel(): array
{
    return json_decode(file_get_contents(__DIR__ . "/../brMain.json"), true);

}