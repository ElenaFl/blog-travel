<?php
function brPostsController()
{
    $data = brPostsModel();

    return renderParts('brPosts', $data);
}
