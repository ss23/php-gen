<?php

require 'gen.php';

$root = new NotNode();
$xorNode = new XorNode();
$xorNode2 = new XorNode();
$shiftNode = new ShiftNode();
$xorNode3 = new XorNode();
$inNode = new InNode();
$inNode2 = new InNode();
$bitNode = new BitNode();
	$bitNode->setData(1);
$bitNode2 = new BitNode();
	$bitNode2->setData(1);
$xorNode4 = new XorNode();
$inNode3 = new InNode();
$notNode = new NotNode();
$notNode2 = new NotNode();
$notNode9 = new NotNode();
$inNode4 = new InNode();
$notNode3 = new NotNode();
$inNode5 = new InNode();

$root->addChild($xorNode);
  $xorNode->addChild($xorNode2);
    $xorNode2->addChild($shiftNode);
      $shiftNode->addChild($xorNode3);
        $xorNode3->addChild($inNode);
	$xorNode3->addChild($inNode2);
      $shiftNode->addChild($bitNode);
      $shiftNode->addChild($bitNode2);
    $xorNode2->addChild($xorNode4);
      $xorNode4->addChild($inNode3);
      $xorNode4->addChild($notNode);
        $notNode->addChild($notNode2);
	  $notNode2->addChild($inNode4);
  $xorNode->addChild($notNode3);
    $notNode3->addChild($inNode5);


$gen_input = 0;
$root->display();
var_dump($root->go());

$gen_input = 0;
var_dump($root->go());

$gen_input = 2;
var_dump($root->go());

$gen_input = 3;
var_dump($root->go());
//$root->display();
