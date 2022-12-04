<?php
$input_file = basename( __FILE__, '.php' ) . '.txt';
$inputs = file( $input_file, FILE_IGNORE_NEW_LINES );

$count = 0;
$count_two= 0;
foreach( $inputs as $line ) {
	list( $pair1, $pair2 ) = explode(',', $line );
	list( $h1, $t1 ) = explode('-', $pair1 );
	list( $h2, $t2 ) = explode('-', $pair2 );

	if ( ( $h2 <= $h1 && $t1 <= $t2 )
		|| ( $h1<= $h2 && $t2 <= $t1 )
	) {
		$count++;
	}

	$range1 = range( $h1, $t1);
	$range2 = range( $h2, $t2);
	if ( count( array_intersect( $range1, $range2 ) ) > 0 ) {
		$count_two++;
	}
}

echo $count . PHP_EOL; // 490
echo $count_two; // 921
