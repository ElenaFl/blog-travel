<?php
function menuController(): string
{
    $data = menuModel();

    return renderParts('menu', $data);
}

