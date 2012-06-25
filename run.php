<?php

/**
 * Random program generator!
 * Create a function test_program.
 * If your function returns true, the program gets to stay
 * If your function returns false, it's gone
 * It may only stay if it passes *every* time (100 tests are done)
 * Depending on the complexity of your programs, increase or decrease the max_depth in
 *  gen.php. Simple programs might only need 3. Complex, 99. Keep in mind, this is
 *  exponentially expenive.
 * Check github for some example tests
 */

/**
 * Create a program which returns bit1 of input xor bit2 of input
 * A max_depth of 2 is optimum
 */
function test_program($program) {
	$input = mt_rand(0,3); // 2 bits
	$res = $program->go($input); // Give it the input
	$expected_input = str_pad(decbin($input), 2, '0', STR_PAD_LEFT);
	// We want bits xor'd
	$expected_input = (int)$expected_input[0] ^ (int)$expected_input[1];
	return $res == $expected_input;
}


require 'gen.php';
$Generator = new Generate();

$pc = 0;
while (true) {
	// Generate a program
	$program = $Generator->buildProgram();
	$pc++;
	// Test it
	for ($i = 0; $i < 100; $i++) {
		if (!test_program($program)) {
			$i = 999;
		}
	}
	if ($i != 1000) {
		global $gen_input;
		// We have a winner!
		echo "Found a valid program after $pc attempts.\n";
		//echo "We expected: {$gen_input}. Received {$program->go()}\n";
		$program->display();
		exit();
	}

	// Display status
	echo str_pad($pc, 6, '0', STR_PAD_LEFT) . "\r";
}

