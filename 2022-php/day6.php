<?php
$input_file = basename( __FILE__, '.php' ) . '.txt';
$line = file_get_contents( $input_file );

$chars = str_split( $line );
$res = 0;
for ( $i = 3; $i < count($chars); $i++ ) {
	if ( 4 === count ( array_unique( [ $chars[$i-3], $chars[$i-2], $chars[$i-1], $chars[$i] ] ) ) ) {
		$res = $i + 1;
		break;
	}
}

$res_two = 0;
for ( $i = 14; $i < count($chars); $i++ ) {
	if ( 14 === count ( array_unique( [
			$chars[$i-13],
			$chars[$i-12],
			$chars[$i-11],
			$chars[$i-10],
			$chars[$i-9],
			$chars[$i-8],
			$chars[$i-7],
			$chars[$i-6],
			$chars[$i-5],
			$chars[$i-4],
			$chars[$i-3],
			$chars[$i-2],
			$chars[$i-1],
			$chars[$i] ] ) ) ) {
		$res_two = $i + 1;
		break;
	}
}

echo $res . PHP_EOL; // 1723
echo $res_two; // 3708
