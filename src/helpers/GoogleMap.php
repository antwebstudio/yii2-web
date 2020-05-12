<?php
namespace ant\helpers;

class GoogleMap {
	public static function coordinateUrl($latitude, $longitude) {
		return 'http://www.google.com/maps/place/'.$latitude.','.$longitude;
	}
	
	public static function addressUrl($streetAddress) {
		return 'http://www.google.com/maps/search/'.urlencode($streetAddress);
		
	}
}