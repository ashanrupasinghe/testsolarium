<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SolariumController extends Controller
{
     protected $client;

    public function __construct(\Solarium\Client $client)
    {
		
		//config('solarium')
        $this->client = new \Solarium\Client(config('solarium'));
    }

    public function ping()
    {
		
        // create a ping query
        $ping = $this->client->createPing();

        // execute the ping query
        try {
            $this->client->ping($ping);						
            return response()->json('OK');
			
        } catch (\Solarium\Exception $e) {
            return response()->json('ERROR', 500);
        }
    }
	
	public function search()
    {
		$client=$this->client;
        $query = $client->createSelect();
        $query->addFilterQuery(array('key'=>'name', 'query'=>'name:testdoc-1', 'tag'=>'include'));
        //$query->addFilterQuery(array('key'=>'degree', 'query'=>'degree:MBO', 'tag'=>'exclude'));
        //$facets = $query->getFacetSet();
        //$facets->createFacetField(array('field'=>'degree', 'exclude'=>'exclude'));
        $resultset = $client->select($query);
//dd($resultset);
        // display the total number of documents found by solr
        echo 'NumFound: ' . $resultset->getNumFound();

        // show documents using the resultset iterator
        foreach ($resultset as $document) {

            echo '<hr/><table>';

            // the documents are also iterable, to get all fields
            foreach ($document as $field => $value) {
                // this converts multivalue fields to a comma-separated string
                if (is_array($value)) {
                    $value = implode(', ', $value);
                }

                echo '<tr><th>' . $field . '</th><td>' . $value . '</td></tr>';
            }

            echo '</table>';
        }
		
    }
	public function create(){
		$client=$this->client;        		
		// get an update query instance
		$update = $client->createUpdate();
		// create a new document for the data
$doc1 = $update->createDocument();

$doc1->id = 125;

$doc1->name = 'testdoc-1';
$doc1->price = 364;

// and a second one
$doc2 = $update->createDocument();

$doc2->id = 126;
$doc2->name = 'testdoc-2';
$doc2->price = 340;

// add the documents and a commit command to the update query
$update->addDocuments(array($doc1, $doc2));
$update->addCommit();

// this executes the query and returns the result
$result = $client->update($update);

echo '<b>Update query executed</b><br/>';
echo 'Query status: ' . $result->getStatus(). '<br/>';
echo 'Query time: ' . $result->getQueryTime();
die();
	}
}
