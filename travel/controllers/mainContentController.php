<?php
function mainContentController(): string
{
   $data = mainContentModel();

    return renderLayout('mainContent', $data);

}