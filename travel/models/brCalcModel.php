<?php
function brCalcModel(): array
{

    return json_decode(file_get_contents(__DIR__ . "/../brCalc.json"), true);

}