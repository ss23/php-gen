<?php

require 'nodes.php';

class Generate {
	protected $max_depth = 2;
	protected $node_classes = array();

	public function __construct() {
		foreach (get_declared_classes() as $class) {
			if (is_subclass_of($class, 'Node')) {
				$this->node_classes[] = $class;
			}
		}
	}
	
	public function getRandomNode($force_terminal = false) {
		$class = new $this->node_classes[array_rand($this->node_classes)];
		if ($force_terminal) {
			if ($class->getMaxChildren() != 0) {
				unset($class); // Hoping this will save a little memory
				return $this->getRandomNode(true);
			}
		}
		return $class;
	}

	/**
	 * Depth is a hacky way of making sure we don't generate programs that are too large
	 * Want to change it to gettiing more likely to pick a terminal as we get furtheir
	 */
	public function populateNode(Node $node, $depth = 1) {
		$depth++;

		if ($node->getDatum()) {
			$node->setData(mt_rand(0, 1));
		}
		$children = mt_rand($node->getMinChildren(), $node->getMaxChildren());
		for ($i = 0; $i < $children; $i++) {
			$child = $this->getRandomNode($depth > $this->max_depth);
			$this->populateNode($child, $depth);
			$node->addChild($child);
		}
	}

	public function buildProgram() {
		$root = $this->getRandomNode();
		$this->populateNode($root);
		return $root;
	}
}

