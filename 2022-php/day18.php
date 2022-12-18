<?php
$input_file = basename( __FILE__, '.php' ) . '.txt';
$lines = file( $input_file, FILE_IGNORE_NEW_LINES );

$cubes = [];
foreach ($lines as $line) {
	$points = explode(',', $line);
	$cubes[] = [ (int)$points[0], (int)$points[1], (int)$points[2] ];
}

$count_cubes = count($cubes);
$connected = 0;
for($first=0; $first < $count_cubes; $first++ ){
	$cube1 = $cubes[$first];
	for( $second= $first + 1; $second < $count_cubes; $second++ ) {
		$cube2 = $cubes[$second];
		$diff = [
			abs($cube1[0] - $cube2[0] ),
			abs ( $cube1[1] - $cube2[1] ),
			abs ( $cube1[2] - $cube2[2] ),
		];

		$counts_diff = array_count_values($diff);
		if( ! array_key_exists( 0, $counts_diff ) ) {
			continue;
		}

		if( ! array_key_exists( 1, $counts_diff ) ) {
			continue;
		}

		if ( $counts_diff[0] === 2 && $counts_diff[1] === 1 ) {
			$connected++;
		}

		if ( $counts_diff[0] === 3 ) {
			throw new Error( 'Two identical cubes!' );
		}
	}
}

echo 'PART 1: ' . ( (6 * $count_cubes) - (2 * $connected) ) . PHP_EOL;
