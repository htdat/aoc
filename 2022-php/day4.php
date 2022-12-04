<?php
$input_file = basename( __FILE__, '.php' ) . '.txt';
$inputs = file( $input_file, FILE_IGNORE_NEW_LINES );

$count = 0;
$count_two= 0;
$count_not_overlapping = 0;
foreach( $inputs as $line ) {
	list( $pair1, $pair2 ) = explode(',', $line );
	list( $h1, $t1 ) = explode('-', $pair1 );
	list( $h2, $t2 ) = explode('-', $pair2 );
	$h1 = (int) $h1; $t1 = (int) $t1;
	$h2 = (int) $h2; $t2 = (int) $t2;

	// Part 1
	if ( ( $h2 <= $h1 && $t1 <= $t2 )
		|| ( $h1<= $h2 && $t2 <= $t1 )
	) {
		$count++;
	}

	// Part 2 - method 1
	$range1 = range( $h1, $t1);
	$range2 = range( $h2, $t2);
	if ( count( array_intersect( $range1, $range2 ) ) > 0 ) {
		$count_two++;
	}

	// Part 2 - method 2
	if( $t1 < $h2 || $t2 < $h1 ) {
		$count_not_overlapping++;
	}
}


echo 'Part 1: ' . $count . PHP_EOL; // 490
echo 'Part 2 - method 1: ' . $count_two. PHP_EOL; // 921
echo 'Part 2 - method 2 - not_overlapping: ' . $count_not_overlapping . PHP_EOL;
echo 'Part 2 - method 2 :' . ( count($inputs) - $count_not_overlapping ); // 921
