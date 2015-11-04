<?php


function distance($LatitudeFrom, $LongitudeFrom, $LatitudeTo, $LongitudeTo, $EarthRadius = 6371000)
{
	//TO CONVERT DEGREES INTO RADIANS
	$LatFrom = deg2rad($LatitudeFrom);
	$LonFrom = deg2rad($LongitudeFrom);
	$LatTo = deg2rad($LatitudeTo);
	$LonTo = deg2rad($LongitudeTo);

	// THETA(2) - THETA(1)
	$LatDelta = $LatTo - $LatFrom;
	$LonDelta = $LonTo - $LonFrom;

	//DISTANCE FROM HAVERSINE FORMULA
	$distance = 2 * $EarthRadius * asin(sqrt(pow(sin($LatDelta/2), 2) + cos($LatFrom)*cos($LatTo)*pow(sin($LonDelta/2), 2)));
}

?>