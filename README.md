# How To
- Install composer client in your machine
- Open terminal/cmd, cd to this project, then type `composer update`. This will download dependencies that requires.

## Using with fuseki
You can use fuseki as your Sparql server. Start the fuseki server, 
Try this code
```php
$fuseki_server = "http://localhost:3030"; // change this to your fuseki server address
$fuseki_sparql_db = "perpustakaan"; // change this to your fuseki Sparql database
$endpoint = $fuseki_server."/".$fuseki_sparql_db."/query";

$sc = new BorderCloud\SPARQL\SparqlClient();
$sc->setEndpointRead($endpoint);
$q = "SELECT ?sub ?pred ?obj WHERE { ?sub ?pred ?obj } LIMIT 10";

$rows = $sc->query($q, 'rows');
$err = $sc->getErrors();
if ($err) {
  print_r($err);
  throw new Exception(print_r($err, true));
}

foreach ($rows["result"]["variables"] as $variable) {
  printf("%s", $variable);
  echo '|';
}
echo "\n";

foreach ($rows["result"]["rows"] as $row) {
  foreach ($rows["result"]["variables"] as $variable) {
    printf("%s", $row[$variable]);
    echo '|';
  }
  echo "\n";
}
``` 
