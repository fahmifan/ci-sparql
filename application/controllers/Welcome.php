<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
        parent::__construct();
    }

	public function index()
	{
		$endpoint = "https://query.wikidata.org/sparql";
		$sc = new BorderCloud\SPARQL\SparqlClient();
		$sc->setEndpointRead($endpoint);
		//$sc->setMethodHTTPRead("GET");
		$q = "select *  where {?x ?y ?z.} LIMIT 5";
		$rows = $sc->query($q, 'rows');
		$err = $sc->getErrors();
		if ($err) {
			print_r($err);
			throw new Exception(print_r($err, true));
		}
		
		foreach ($rows["result"]["variables"] as $variable) {
			printf("%-20.20s", $variable);
			echo '|';
		}
		echo "\n";
		
		foreach ($rows["result"]["rows"] as $row) {
			foreach ($rows["result"]["variables"] as $variable) {
				printf("%-20.20s", $row[$variable]);
				echo '|';
			}
			echo "\n";
		}
	}
}
