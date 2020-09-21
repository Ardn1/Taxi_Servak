<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include("./vendor/autoload.php");

use Aws\S3\S3Client;

class Aws
{

    public $S3;

    public function __construct()
    {
        $this->S3 = S3Client::factory([
            'key' => 'o3A1mgmmGdCvM87P1qew2v',
            'secret' => 'bz8q9D5RYr9DSmYh9t8bv48Y7iXTyzBEWiiFMxp8eNrM',
            'region' => 'us-west-2',
            'version' => 'latest',
            'endpoint' => 'https://hb.bizmrg.com'
        ]);


    }


    public function sendFile($filename,$file)
    {
        $result = $this->S3->putObject(array(
            'Bucket' => 'photos23',
            'Key' => $filename,
            'SourceFile' => "1123",
            'ContentType' => 'text',
            'Body' => $file
        ));
    }

    public function getFile($filename){
        $result = $this->S3->getObject([
            'Bucket' => 'photos23',
            'Key'    => $filename
        ]);

        // Print the body of the result by indexing into the result object.
        return $result['Body'];
    }

}