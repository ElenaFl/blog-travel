<?php
function brCalcController(){

    $data = brCalcModel();

    return renderParts('brCalc', $data);
}