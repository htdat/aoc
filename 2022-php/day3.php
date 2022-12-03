<?php
$input_file = basename( __FILE__, '.php' ) . '.txt';
$inputs = file( $input_file, FILE_IGNORE_NEW_LINES );

function get_point( string $char ): int {
	if ( strlen($char) !== 1 ) {
		throw new Error( 'Not a single character' );
	}

	$ord = ord( $char );
	return $ord >= 97 ? $ord - 96 : $ord - 38;
}

/**
 * Part 1
 */
$total = 0;
foreach ( $inputs as $line ) {
	$part1       = substr( $line, 0, strlen( $line ) / 2 );
	$part2       = substr( $line, strlen( $line ) / 2, strlen( $line ) / 2 );
	$part1_chars = str_split( $part1 );
	$part2_chars = str_split( $part2 );

	$counts = array_count_values(
		array_merge(
			array_unique( $part1_chars ),
			array_unique( $part2_chars )
		)
	);

	$found = array_search( 2, $counts );
	$total = $total + get_point( $found );
}

echo $total . PHP_EOL; // 7785

/**
 * Part 2
 */
$total_two = 0;
for ($i = 0; $i < count($inputs); $i = $i +3) {
	$counts =  array_count_values(
		array_merge(
			array_unique( str_split( $inputs[$i] ) ),
			array_unique( str_split( $inputs[$i + 1] ) ),
			array_unique( str_split( $inputs[$i + 2] ) )
		)
	);

	$found = array_search( 3, $counts );
	$total_two = $total_two + get_point( $found );
}

echo $total_two; // 2633
