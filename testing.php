<?php
$time = microtime(true);
$start = $time;

	 function print_multiple($numbers){
	 	foreach ($numbers as $number) {
			if($number % 5 == 0){
				echo $number.'<br>';
			}
	 	}
	 }
	 print_multiple(['1', '5', '10', '20', '3', '4', '9']);

/*function getMultiple(array $array){
	return array_filter($array, function($arr){
		return $arr % 5 == 0;
	});
}*/

//print_r(getMultiple([5, 20, 1, 2, 4]));
$time = microtime(true);
$finish = $time;
echo($finish); echo $start;
echo "Speed: ". ($finish - $start);
?>