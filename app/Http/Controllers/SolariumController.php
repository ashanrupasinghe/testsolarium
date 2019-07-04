<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SolariumController extends Controller {

    protected $client;

    public function __construct(\Solarium\Client $client) {

        //config('solarium')
        $this->client = new \Solarium\Client(config('solarium'));
    }

    public function ping() {

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

    public function search() {
        $client = $this->client;
        $query = $client->createSelect();
        //$query->addFilterQuery(array('key' => 'name', 'query' => 'name:testdoc-1', 'tag' => 'include'));
        $query->addFilterQuery(array('key' => 'attr_file', 'query' => 'attr_file:*Virtual Reality*', 'tag' => 'include'));
        //$query->addFilterQuery(array('key'=>'degree', 'query'=>'degree:MBO', 'tag'=>'exclude'));
        //Computer Hardware
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

    public function create() {
        $client = $this->client;
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
        echo 'Query status: ' . $result->getStatus() . '<br/>';
        echo 'Query time: ' . $result->getQueryTime();
        die();
    }

    public function delete() {
        $client = $this->client;
        // get an update query instance
        // get an update query instance
        $update = $client->createUpdate();

// add the delete query and a commit command to the update query
        $update->addDeleteQuery('name:testdoc*');
        $update->addCommit();

// this executes the query and returns the result
        $result = $client->update($update);

        echo '<b>Update query executed</b><br/>';
        echo 'Query status: ' . $result->getStatus() . '<br/>';
        echo 'Query time: ' . $result->getQueryTime();

        /**
          // get an update query instance
          $update = $client->createUpdate();

          // add the delete id and a commit command to the update query
          $update->addDeleteById(123);
          $update->addCommit();

          // this executes the query and returns the result
          $result = $client->update($update);

          echo '<b>Update query executed</b><br/>';
          echo 'Query status: ' . $result->getStatus(). '<br/>';
          echo 'Query time: ' . $result->getQueryTime();
         */
    }

    public function facetField() {
        $client = $this->client;
        // get a select query instance
        $query = $client->createSelect();

// get the facetset component
        $facetSet = $query->getFacetSet();

// create a facet field instance and set options
        $facetSet->createFacetField('stock')->setField('inStock');
        dd($query);
// this executes the query and returns the result
        $resultset = $client->select($query);

// display the total number of documents found by solr
        echo 'NumFound: ' . $resultset->getNumFound();

// display facet counts
        echo '<hr/>Facet counts for field "inStock":<br/>';
        $facet = $resultset->getFacetSet()->getFacet('stock');
        foreach ($facet as $value => $count) {
            echo $value . ' [' . $count . ']<br/>';
        }

// show documents using the resultset iterator
        foreach ($resultset as $document) {

            echo '<hr/><table>';
            echo '<tr><th>id</th><td>' . $document->id . '</td></tr>';
            echo '<tr><th>name</th><td>' . $document->name . '</td></tr>';
            echo '<tr><th>price</th><td>' . $document->price . '</td></tr>';
            echo '</table>';
        }
        die();
    }

    public function extractPDF() {
        $client = $this->client;

        // get an extract query instance and add settings
        $query = $client->createExtract();
        $query->addFieldMapping('content', 'file');
        //$query->addFieldMapping('content', 'url');
        //$query->addFieldMapping('content', 'text');
        $query->setUprefix('attr_');
        //$query->addParam('stream.url',"https://www.dropbox.com/sh/myq4cuwzm8fkdl6/AACVILl0ngd0xuaY-HTXPg01a?dl=0&preview=2014CS024.pdf");
        //__DIR__ => "C:\xampp\htdocs\solarium\app\Http\Controllers"
        //"C:\xampp\htdocs\solarium\public"
        //$query->setFile(public_path(). '\index.php');
        $query->setFile(public_path(). '\cvs\5.pdf');
        //$query->setFile("https://www.dropbox.com/sh/myq4cuwzm8fkdl6/AACVILl0ngd0xuaY-HTXPg01a?dl=0&preview=2014CS024.pdf");
        $query->setCommit(true);
        $query->setOmitHeader(false);
// add document
        $doc = $query->createDocument();
        $doc->id = 'cv-5';
        $doc->some = 'more fields';
        $query->setDocument($doc);
// this executes the query and returns the result
        $result = $client->extract($query);
        echo '<b>Extract query executed</b><br/>';
        echo 'Query status: ' . $result->getStatus() . '<br/>';
        echo 'Query time: ' . $result->getQueryTime();
        die();
        //$doc = new Solarium_Document_ReadWrite();
//dd($doc);
//$doc->id = time();
//$doc->some = 'more fields';
        /* $client->read
          $extract = $client->createExtract();
          $extract->addFieldMapping('content', 'text');
          $extract->setUprefix('ignore_');
          dd($extract);
          $extract->setDocument($doc);
          $extract->setFile('/path/to/file.pdf');

          $client->execute($extract);

         */

        /*
          $extract = $client->createExtract();
          $request = $client->createRequest($extract);
          $headers = array('Content-Type:multipart/form-data');
          $request->addHeaders($headers);
          $client->executeRequest($request);
         */
    }

}
