<?php

const ROCK = 'rock';
const SCISSOR = 'scissors';
const PAPER = 'paper';

CONST OPPONENT_SHAPE = [
	'A' => ROCK,
	'B' => PAPER,
	'C' => SCISSOR,
];

CONST MY_SHAPE = [
	'X' => ROCK,
	'Y' => PAPER,
	'Z' => SCISSOR,
];

const TOOL_POINTS = [
	ROCK => 1,
	PAPER => 2,
	SCISSOR => 3,
];

const GAME_POINTS = [
	ROCK => [
		PAPER => 6,
		SCISSOR => 0,
		ROCK => 3,
	],
	PAPER => [
		ROCK => 0,
		SCISSOR => 6,
		PAPER => 3,
	],
	SCISSOR => [
		ROCK => 6,
		PAPER => 0,
		SCISSOR => 3
	],
];

function get_points( string $opponent, string $mine ): int {
	$game_point = GAME_POINTS[$opponent][$mine];
	$tool_point = TOOL_POINTS[$mine];
	return $game_point + $tool_point;
}

$input_file = basename( __FILE__, '.php' ) . '.txt';
$inputs = file( $input_file, FILE_IGNORE_NEW_LINES );

$total = 0;
foreach ( $inputs as $round ) {
	list($opponent, $mine) = explode( ' ', $round );
	$total = $total + get_points( OPPONENT_SHAPE[$opponent], MY_SHAPE[$mine]);
}

echo $total; // 12679

/**
 * Part 2
 */
// X means you need to lose, Y means you need to end the round in a draw, and Z means you need to win
const LOSE = 'X';
const DRAW = 'Y';
const WIN = 'Z';

const PART_TWO = [
	ROCK => [
		LOSE => SCISSOR,
		DRAW => ROCK,
		WIN => PAPER,
	],
	PAPER => [
		LOSE => ROCK,
		DRAW => PAPER,
		WIN => SCISSOR,
	],
	SCISSOR => [
		LOSE => PAPER,
		DRAW => SCISSOR,
		WIN => ROCK,
	],
];

$total_two = 0;

foreach ( $inputs as $round ) {
	list($opponent, $indicator) = explode( ' ', $round );
	$mine = PART_TWO[OPPONENT_SHAPE[$opponent]][$indicator];
	$total_two = $total_two + get_points( OPPONENT_SHAPE[$opponent], $mine);
}
echo PHP_EOL;
echo $total_two; // 14470
