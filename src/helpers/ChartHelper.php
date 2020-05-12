<?php 
namespace ant\helpers;

use ant\helpers\DateTime;

class ChartHelper {
	public static function fillMissingDate($array, $dateAttribute, $fillValues) {
		if (is_array($dateAttribute)) {
			$dateAttribute = key($dateAttribute);
			$dateFormat = current($dateAttribute);
		} else {
			$dateFormat = 'Y-m-d';
		}
		$newArray = [];
		foreach ($array as $index => $data) {
			$previousDate = isset($previousDate) ? new DateTime($previousDate) : null;
			$diffInDays = isset($previousDate) ? (new DateTime($data[$dateAttribute]))->differentInDays($previousDate) : 0;
			
			if ($diffInDays > 1) {
				for ($i = 0; $i < $diffInDays - 1; $i++) {
					$newItem = $fillValues;
					$newItem[$dateAttribute] = $previousDate->addDays(1)->format($dateFormat);
					$newArray[] = $newItem;
				}
			}
			$newArray[] = $data;
			
			$previousDate = $data['created_date'];
		}
		return $newArray;
	}
}