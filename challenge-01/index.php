<?php

function findPoint($strArr)
{
    $firstArr = convertStringToArray($strArr[0]);
    $secondArr = convertStringToArray($strArr[1]);
    $commonElements = array_intersect($firstArr, $secondArr);

    return $commonElements;
}

function convertStringToArray($str)
{
    return array_map('intval', explode(',', $str));
}

// keep this function call here
echo findPoint(['1, 3, 4, 7, 13', '1, 2, 4, 13, 15']);
