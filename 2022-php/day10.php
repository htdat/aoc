<?php
$input_file = basename( __FILE__, '.php' ) . '.txt';
$lines = file( $input_file, FILE_IGNORE_NEW_LINES );

/**
 * Part 1
 */
$cycle_no   = 0;
$register_v = 1;
$history = []; // key: cycle no; value: register value
for($i=1; $i <= count($lines); $i++ ) {
	$arr = explode(' ', $lines[$i-1] );
	$type = $arr[0];
	if ( 'noop' === $type ) {
		$cycle_no++;
		$history[$cycle_no] = $register_v;
	} else {
		// type 'addx'
		$cycle_no++;
		$history[$cycle_no] = $register_v;

		$cycle_no++;
		$history[$cycle_no] = $register_v;
		$register_v = $register_v + $arr[1];
	}
}

$list_cycles = [20, 60, 100, 140, 180, 220];
$list_values = array_map(
	function ( $cycle_no )  {
		global $history;
		return $cycle_no * $history[$cycle_no];
	},
	$list_cycles
);

echo 'Part 1: ' . array_sum( $list_values ) . PHP_EOL; // 13820

/**
 * Part 2
 */
const CYCLES_PER_LINE = 40;
$crt_pixels = []; // one-index (indexing starts with 1)
$output = '';
for($i=1; $i <= count($history); $i++ ) {
	$middle_sprite_position = $history[$i] + 1; //
	$lit_pixels_positions = [$middle_sprite_position - 1, $middle_sprite_position, $middle_sprite_position + 1];

	$current_pixel_position = $i % CYCLES_PER_LINE;
	$current_pixel_type = in_array( $current_pixel_position, $lit_pixels_positions ) ? '#' : '.';

	$crt_pixels[$i] = $current_pixel_type;

	$output = $output . $current_pixel_type;
	if ( $current_pixel_position === 0 ) {
		$output = $output . PHP_EOL;
	}
}

echo 'Part 2: ' . PHP_EOL;
echo $output;
/**
Letter: ZKGRKGRK
Screen Output:

####.#..#..##..###..#..#..##..###..#..#.
...#.#.#..#..#.#..#.#.#..#..#.#..#.#.#..
..#..##...#....#..#.##...#....#..#.##...
.#...#.#..#.##.###..#.#..#.##.###..#.#..
#....#.#..#..#.#.#..#.#..#..#.#.#..#.#..
####.#..#..###.#..#.#..#..###.#..#.#..#.

 */
