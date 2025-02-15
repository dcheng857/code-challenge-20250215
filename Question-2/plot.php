<?php

// For data store
$dataPoints=array();

// Read the csv file
$handle = fopen("out.csv", "r");

// Read the file line by line
while (($row = fgetcsv($handle, 1000, ",", "\"","\\")) !== FALSE) {
    $x = $row[0];
    $y = $row[1];

    // avoid the header row
    if(is_numeric($x) && is_numeric($y)){
        $dataPoints[] = array($x,$y);
    }
}

// Close the file
fclose($handle);

// Find min and max x & y
$minX = min(array_column($dataPoints, 0));
$maxX = max(array_column($dataPoints, 0));
$minY = min(array_column($dataPoints, 1));
$maxY = max(array_column($dataPoints, 1));

// Define the plot width
$width = 80;

// Calculate proportional height
$height = round(($maxY - $minY) / ($maxX - $minX) * $width);

// Create an empty grid and fill it
$grid = array_fill(0, $height, array_fill(0, $width, ' '));

// Scale and place points in the grid
foreach ($dataPoints as $point) {
    $scaledX = round(($point[0] - $minX) / ($maxX - $minX) * ($width - 1));
    $scaledY = round(($point[1] - $minY) / ($maxY - $minY) * ($height - 1));

    // Flip Y for proper display
    $plotY = $height - 1 - $scaledY;

    // Place the point in place
    $grid[$plotY][$scaledX] = '●';
}

// Print out the scatter plot
foreach ($grid as $row) {
    echo implode('', $row) . "\n";
}