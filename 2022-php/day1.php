<?php
$input_file = basename( __FILE__, '.php' ) . '.txt';
$inputs = file( $input_file, FILE_IGNORE_NEW_LINES ); 

$elfs = [];
$current_elf = null; 
foreach( $inputs as $calor ) {
    if ( empty($calor) ) {
        $current_elf = $current_elf === null ? 0 : $current_elf + 1; 
    }

    $elfs[$current_elf][] = $calor;
}

$elfs_total_calor = array_map( 'array_sum' , $elfs );

echo 'Calories that the Elf carrying the most: ' . max( $elfs_total_calor );