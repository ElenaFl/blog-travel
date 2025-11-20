<?php
function brCreateController()
{
    $data = brCreateModel();

    return renderParts('brCreatePost', $data);
}