<?php
$input_file = basename( __FILE__, '.php' ) . '.txt';
$inputs = file( $input_file, FILE_IGNORE_NEW_LINES ); 

$elfs = [];
$current_elf = null; 
foreach( $inputs as $calor ) {
    if ( empty($calor) ) {
        $current_elf = $current_elf === null ? 0 : $current_elf + 1; 
    }

    $elfs[$current_elf][] = (int) $calor;
}

// Find max
$elfs_total_calor = array_map( 'array_sum' , $elfs );
echo 'Calories that the Elf carrying the most: ' . max( $elfs_total_calor ) . PHP_EOL;

// Find top 3 
$elfs_total_calor_sort = $elfs_total_calor;
rsort( $elfs_total_calor_sort, SORT_NUMERIC );
$top_3 = array_slice( $elfs_total_calor_sort, 0, 3, true );

echo 'The top three Elves carry ' . implode( ', ', $top_3 ) . '. Total: ' . array_sum( $top_3 );