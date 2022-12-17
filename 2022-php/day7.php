<?php
/**
 * Ideas?
 * - Virtual filesystem?
 * - Refactor to use Interfaces?
 */

$input_file = basename( __FILE__, '.php' ) . '.txt';
//$input_file = 'day7-test.txt';
$lines = file( $input_file, FILE_IGNORE_NEW_LINES );

const CMD_CD = 'cd';
const CMD_CD_GO_TO_PARENT = '..';
const CMD_LS = 'ls';
const CMD_START = '$';
const DIR_LINE = 'dir';
const HOME_DIR = '/';

$dir_children                 = [];
$file_list                   = [];
foreach ($lines as $line ) {
	$parts = explode( ' ', $line );
	$is_command = $parts[0] === CMD_START;

	if ( $is_command ) {
		// Command line processing
		$command = $parts[1];

		switch ( $command ) {
			case CMD_CD:
				$dir_name = $parts[2];
				switch ( $dir_name ) {
					case HOME_DIR: // "cd /"
						$cwd                = HOME_DIR;
						break;
					case CMD_CD_GO_TO_PARENT: // "cd .."
						$cwd = substr(
							$cwd,
							0,
							strrpos($cwd, '/')
						);
						break;
					default: // "cd a_folder_name"
						$cwd = $cwd === HOME_DIR
							? $cwd . $dir_name
							: $cwd . '/' . $dir_name;
				}
				break;
			case CMD_LS:
				// do nothing for now.
				break;
			default:
				throw new Error('Command does not exist: ' . $line);
		}
	} else {
		// Parse the result of command "ls"
		$is_dir_line = $parts[0] === DIR_LINE;

		$name = $parts[1];
		$full_path = $cwd === HOME_DIR
			? $cwd . $name
			: $cwd . '/' . $name;

		$dir_children[$cwd][] = $full_path;

		if ( $is_dir_line ) {
			$dir_children[$full_path] = [];
		} else {
			$file_list[$full_path] = (int) $parts[0];
		}
	}
}

global $dir_sizes;
$dir_sizes = [];

function get_dir_size( $finding_dir, $file_list, $dir_children ) {
	global  $dir_sizes;
	if ( array_key_exists( $finding_dir, $dir_sizes ) ){
		return $dir_sizes[$finding_dir];
	}

	if ( ! array_key_exists( $finding_dir, $dir_children ) ){
		throw new Error('Folder does not exist: ' . $finding_dir);
	}

	$total = 0;
	foreach ( $dir_children[$finding_dir] as $child ) {
		if ( array_key_exists($child, $file_list) ) {
			$total += $file_list[$child];
		} else {
			$total += get_dir_size( $child, $file_list, $dir_children );
		}
	}

	$dir_sizes[$finding_dir] = $total;
	return $total;
}

$home_size = get_dir_size('/', $file_list, $dir_children); // trigger the calculation of all directories

const PART_1 = 100000;
echo 'PART 1: ' . array_sum(
	array_filter(
		$dir_sizes,
		function ($val) {
			return $val <= PART_1;
		}
	)
);
echo PHP_EOL;

/**
 * Part 2
 */
$used_space = $home_size;
$freed_up_size = $used_space - ( 70000000 - 30000000 );
echo 'PART 2: ' . min(
	array_filter(
		$dir_sizes,
		function ($val) use ($freed_up_size) {
			return $val >= $freed_up_size;
		}
	)
);

// PART 1: 1783610
// PART 2: 4370655
