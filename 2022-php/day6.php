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
for ( $i = 13; $i < count($chars); $i++ ) {
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

echo 'Hard-work method:' . PHP_EOL;
echo $res . PHP_EOL; // 1723
echo $res_two . PHP_EOL; // 3708

function get_the_first_mark( int $unique_chars, string $signal ): int {
	$res = 0;
	$signal_chars = str_split($signal);

	for( $i = $unique_chars; $i <= strlen($signal); $i++ ) {
		$group = array_slice($signal_chars, $i - $unique_chars, $unique_chars );
		if ( $unique_chars === count( array_unique($group) ) ) {
			$res = $i;
			break;
		}
	}
	return $res;
}

echo '---------' . PHP_EOL;
echo 'Generalization: ' . PHP_EOL;
echo get_the_first_mark( 4, $line ) . PHP_EOL;
echo get_the_first_mark( 14, $line ) . PHP_EOL;
