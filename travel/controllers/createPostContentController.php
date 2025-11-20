<?php
function createPostContentController(): string
{
    $data = createPostContentModel();

    return renderParts('createPost',  $data);
}