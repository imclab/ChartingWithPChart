<?php
define("PCHART_PATH", "/srv/www/lib/pChart");
set_include_path(get_include_path() . PATH_SEPARATOR . PCHART_PATH);

require_once "class/pDraw.class.php";
require_once "class/pImage.class.php";
require_once "class/pData.class.php";

// create data set
$myDataset = array(0, 1, 1, 2, 3, 5, 8, 13);
$myData = new pData();
$myData->addPoints($myDataset);

// define image object
$myImage = new pImage(500,300, $myData);
$myImage->setFontProperties(array(
    "FontName" => PCHART_PATH . "/fonts/GeosansLight.ttf",
    "FontSize" => 15));
$myImage->setGraphArea(25,25, 475,275);
$myImage->drawScale();

// output bar chart
$myImage->drawBarChart();
header("Content-Type: image/png");
$myImage->Render(null);

