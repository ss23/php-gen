<?php

define('RANDOM_NODE_DATA', 'ixlvDyy10Su7EjZ35NzSmqzb6iYkCvEPCZqf1QUcLepaodOvjeXQcDePk1lDkJb');
abstract class Node {
        protected $maxChildren = 0;
        protected $minChildren = 0;
        protected $children = array();
        /**
         * Is the node a terminal? A datum
         */
        protected $datum = false;
        protected $data = RANDOM_NODE_DATA;

        abstract protected function execute();

        public function go($data = RANDOM_NODE_DATA) {
                if ((count($this->children) < $this->minChildren) || (count($this->children) > $this->maxChildren)) {
                        throw new Exception('Incorrect number of children');
                }
                if ($this->datum && ($this->data === RANDOM_NODE_DATA)) {
                        throw new Exception('Please fill in some data');
                }
		if ($data !== RANDOM_NODE_DATA) {
			global $gen_input;
			$gen_input = $data;
		}
                return (int)$this->execute();
        }

        public function addChild(Node $child) {
                if (count($this->children) >= $this->maxChildren) {
                        throw new Exception('Too many children');
                }
                $this->children[] = $child;
                return $this;
        }

        public function getDatum() {
                return $this->datum;
        }

        public function getMaxChildren() {
                return $this->maxChildren;
        }

        public function getMinChildren() {
                return $this->minChildren;
        }

        public function display($depth = 0) {
                for ($i = 0; $i < $depth; $i++) {
                        echo " ";
                }
                echo get_class($this);
                if ($this->datum == true) {
                        echo " (" . $this->data . ")";
                }
                echo "\n";
                foreach ($this->children as $child) {
                        $child->display($depth + 1);
                }
        }
}

class XorNode extends Node {
        public function __construct() {
                $this->maxChildren = $this->minChildren = 2;
        }

        protected function execute() {
                return $this->children[0]->go() ^ $this->children[1]->go();
        }
}

class AndNode extends Node {
        public function __construct() {
                $this->maxChildren = $this->minChildren = 2;
        }

        protected function execute() {
                return $this->children[0]->go() & $this->children[1]->go();
        }
}

class OrNode extends Node {
        public function __construct() {
                $this->maxChildren = $this->minChildren = 2;
        }

        protected function execute() {
                return $this->children[0]->go() | $this->children[1]->go();
        }
}

class BitNode extends Node {
        public function __construct() {
                $this->datum = true;
        }

        protected function execute() {
                return $this->data;
        }

        public function setData($data) {
                $this->data = ($data) ? 1 : 0;
        }
}

class InNode extends Node {
        protected function execute() {
                global $gen_input;
		return $gen_input;
        }
}

class ShiftNode extends Node {
        public function __construct() {
                $this->maxChildren = $this->minChildren = 3;
        }

        protected function execute() {
                if ($this->children[0]->go()) {
                        return $this->children[2]->go() >> $this->children[1]->go();
                } else {
                        return $this->children[2]->go() << $this->children[1]->go();
                }
        }
}

/*
class NotNode extends Node {
        public function __construct() {
                $this->maxChildren = $this->minChildren = 1;
        }

        protected function execute() {
                return ~$this->children[0]->go();
        }
}*/

class RandNode extends Node {
	protected function execute() {
		return mt_rand(0,1);
	}
}
