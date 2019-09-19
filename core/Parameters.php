<?php

namespace core;

use app\classes\Uri;

class Parameters {

	private $uri;

	public function __construct() {
		$this->uri = Uri::uri();
	}

	public function load() {
		return $this->getParameter();
	}

	private function getParameter() {

	if (substr_count($this->uri, '/') > 2) {
		$parameter = array_values(array_filter(explode('/', $this->uri)));

		$obj = new \StdClass;
		$array = [];
			foreach($parameter as $key => $value){
				if ($key > 1){
					array_push($array, filter_var($this->getNextParameter($key-1), FILTER_SANITIZE_STRING));
					$obj->parametros = $array;
				}
			}

			return $obj;
		}
	}

	private function getNextParameter($actual) {
		$parameter = array_values(array_filter(explode('/', $this->uri)));

		return $parameter[$actual + 1] ?? $parameter[$actual];

	}

}