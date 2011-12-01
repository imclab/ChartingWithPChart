<?php
define("PCHART_PATH", "/srv/www/lib/pChart");
set_include_path(get_include_path() . PATH_SEPARATOR . PCHART_PATH);

require_once "class/pDraw.class.php";
require_once "class/pImage.class.php";
require_once "class/pData.class.php";

// create data set
$squareSeries = array();
$cubeSeries = array();
$fourthSeries = array();
for ($i = 0; $i <= 4; $i++) {
    $squareSeries[$i] = pow($i, 2);
    $cubeSeries[$i] =  pow($i, 3);
    $fourthSeries[$i] = pow($i, 4);
}
$myPowersData = new pData();
$myPowersData->addPoints($squareSeries, "Square");
$myPowersData->addPoints($cubeSeries, "Cube");
$myPowersData->addPoints($fourthSeries, "Fourth");

// specify colors
$myPowersData->setPalette("Square",
    array("R" => 240,"G" => 16, "B" =>16, "Alpha" => 100));
$myPowersData->setPalette("Cube",
    array("R" => 16, "G" => 240, "B" => 16, "Alpha" => 100));
$myPowersData->setPalette("Fourth",
    array("R" => 16, "G" => 16, "B" => 240, "Alpha" => 100));

// define image object
$myPowersImage = new pImage(500,300, $myPowersData);
$myPowersImage->setFontProperties(array(
    "FontName" => PCHART_PATH . "/fonts/MankSans.ttf",
    "FontSize" => 12));
$myPowersImage->setGraphArea(40,40, 460,260);
$myPowersImage->drawScale();

// add chart title and legend
$myPowersImage->drawText(150,50, "The First Three Powers",
    array("R" => 0, "G" => 64, "B" => 255, "FontSize" => 20));
$myPowersImage->drawLegend(70,100, 
    array("R" => 220, "G" => 220, "B" => 220,
          "FontR" => 0, "FontG" => 64, "FontB" => 255,
          "BorderR" => 80, "BorderG" => 80, "BorderB" => 80,
          "FontSize" => 12, "Family" => LEGEND_FAMILY_CIRCLE));

// output plot chart
$myPowersImage->drawPlotChart();
header("Content-Type: image/png");
$myPowersImage->Render(null);

