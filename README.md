php-gen
=======

Generate programs with PHP!

Read run.php for instructions.

Some example programs:

    /**
     * Create a program which returns bit1 of input xor bit2 of input
     * A max_depth of 2 is optimum
     */
    function test_program($program) {
        $input = mt_rand(0,3); // 2 bits
        $res = $program->go();
        $expected_input = str_pad(decbin($input), 2, '0', STR_PAD_LEFT);
        // We want bits xor'd
        $expected_input = (int)$expected_input[0] ^ (int)$expected_input[1];
        return $res == $expected_input;
    }

Which gives us:
    
    Found a valid program after 92985 attempts.
    XorNode
      ShiftNode
        BitNode (1)
        BitNode (1)
        InNode
      AndNode
        BitNode (1)
        InNode

For more information on what each node does (evidently, it's a tree structure) check nodes.php.
You can add your own nodes if you want -- it will use them in the programs it generates when it sees them there.
