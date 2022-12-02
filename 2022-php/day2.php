<?php

const ROCK = 'rock';
const SCISSOR = 'scissors';
const PAPER = 'paper';

CONST opponent_shape = [
	'A' => ROCK,
	'B' => PAPER,
	'C' => SCISSOR,
];

CONST my_shape = [
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
//	var_dump( $game_point );
	$tool_point = TOOL_POINTS[$mine];
//var_dump($tool_point);
	return $game_point + $tool_point;
}

$input_file = basename( __FILE__, '.php' ) . '.txt';
$inputs = file( $input_file, FILE_IGNORE_NEW_LINES );

$total = 0;
foreach ( $inputs as $round ) {
	list($opponent, $mine) = explode( ' ', $round );
	$total = $total + get_points( opponent_shape[$opponent], my_shape[$mine]);
//	exit;
//	var_dump( $opponent, $mine, $round, opponent_shape[$opponent], my_shape[$mine], get_points( opponent_shape[$opponent], my_shape[$mine] )); exit;

}

echo $total;
