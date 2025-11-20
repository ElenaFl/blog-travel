<?php
function brPostController()
{
    $data = brPostModel();

    return renderParts('brPost', $data);
}