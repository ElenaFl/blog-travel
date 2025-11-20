<?php
function brMainController()
{
   $data = brMainModel();

    return renderParts('brMain', $data);
}