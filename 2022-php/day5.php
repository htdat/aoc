<?php
$input_file = basename( __FILE__, '.php' ) . '.txt';
$inputs = file( $input_file, FILE_IGNORE_NEW_LINES );

/**
 * Extract stacks
 */
$stacks = [];
for ( $i = 7; $i >=0; $i--) {
	$line = $inputs[$i];
	$chars = str_split( $line );
	$stack_no = 1;

	for ( $j=0; $j < strlen( $line ); $j = $j + 4 ) {
		$char = $chars[$j+1];
		if ( $char !== ' ')  {
			$stacks[$stack_no][] = $char;
		}
		$stack_no++;
 	}
}

$stacks_part_2 = $stacks;
for ( $i = 10; $i < count( $inputs ); $i++ ) {
	$arr = explode( ' ', $inputs[$i] );
	$amount = (int) $arr[1];
	$from = (int) $arr[3];
	$to = (int) $arr[5];

	/**
	 * Part 1
	 */
	for($j = 1; $j <= $amount; $j++ ) {
		$item = array_pop( $stacks[$from] );
		$stacks[$to][] = $item;
	}

	/**
	 * Part 2
	 */
	$moving_crates = array_slice( $stacks_part_2[$from], -$amount, $amount, true );
	$stacks_part_2[$from] = array_slice(
		$stacks_part_2[$from],
		0,
		count($stacks_part_2[$from]) - $amount,
			true
	);
	$stacks_part_2[$to] = array_merge( $stacks_part_2[$to], $moving_crates );
}

/**
 * Output results.
 */
$res        = '';
$res_part_2 = '';
for ( $i = 1; $i <= count($stacks ); $i++ ) {
	$last_index = count( $stacks[$i] ) - 1;
	$res .= $stacks[$i][$last_index];

	$last_index2 = count( $stacks_part_2[$i] ) - 1;
	$res_part_2  .= $stacks_part_2[$i][$last_index];
}

echo $res . PHP_EOL; // GRTSWNJHH
echo $res_part_2 . PHP_EOL; // QLFQDBBHM
