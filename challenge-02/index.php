<?php

function noIterate($strArr)
{
    [$mainString, $targetString] = $strArr;
    $requiredCharFrequencies = buildCharacterFrequencyMap($targetString);

    return findMinimumWindow($mainString, $requiredCharFrequencies);
}

function buildCharacterFrequencyMap(string $str): array 
{
    $frequencyMap = [];
    $length = strlen($str);
    
    for ($i = 0; $i < $length; $i++) {
        $char = $str[$i];
        $frequencyMap[$char] = ($frequencyMap[$char] ?? 0) + 1;
    }
    
    return $frequencyMap;
}

function findMinimumWindow(string $mainString, array $requiredFrequencies): string 
{
    $windowCharCounts = [];
    $satisfiedRequirements = 0;
    $totalRequirements = count($requiredFrequencies);
    
    $leftPointer = 0;
    $minWindowLength = PHP_INT_MAX;
    $minWindowStart = 0;
    
    $mainStringLength = strlen($mainString);
    
    for ($rightPointer = 0; $rightPointer < $mainStringLength; $rightPointer++) {
        $currentChar = $mainString[$rightPointer];
        $windowCharCounts[$currentChar] = ($windowCharCounts[$currentChar] ?? 0) + 1;
        
        if (isset($requiredFrequencies[$currentChar]) && 
            $windowCharCounts[$currentChar] === $requiredFrequencies[$currentChar]) {
            $satisfiedRequirements++;
        }
        
        while ($satisfiedRequirements === $totalRequirements) {
            $currentWindowLength = $rightPointer - $leftPointer + 1;
            
            if ($currentWindowLength < $minWindowLength) {
                $minWindowLength = $currentWindowLength;
                $minWindowStart = $leftPointer;
            }
            
            $leftChar = $mainString[$leftPointer];
            $windowCharCounts[$leftChar]--;
            
            if (isset($requiredFrequencies[$leftChar]) && 
                $windowCharCounts[$leftChar] < $requiredFrequencies[$leftChar]) {
                $satisfiedRequirements--;
            }
            
            $leftPointer++;
        }
    }
    
    return $minWindowLength === PHP_INT_MAX ? '' : 
           substr($mainString, $minWindowStart, $minWindowLength);
}

// keep this function call here
echo noIterate(["ahffaksfajeeubsne", "jefaa"]);
