<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include("./vendor/autoload.php");

use Aws\S3\S3Client;

class aws
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

    function base64_to_jpeg($base64_string, $output_file="tmp.tmp") {

        $uid = rand(11111111111111, 99999999999999);
        $newname = $uid . '.jpg';
        $output_file=$newname;
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' );

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $base64_string ) );

        // clean up the file resource
        fclose( $ifp );

        return $output_file;
    }


    public function sendFile($filename,$file)
    {
        $file=$this->base64_to_jpeg($file);
        $result = $this->S3->putObject(array(
            'Bucket' => 'photos23',
            'Key' => $filename,
            'SourceFile' => $file,
        ));
        unlink($file);
    }

    public function getFile($filename){
        try {
            $result = $this->S3->getObject([
                'Bucket' => 'photos23',
                'Key' => $filename
            ]);

            $uid = rand(11111111111111, 99999999999999);
            $newname = $uid . '.jpg';

            file_put_contents($newname, (string)$result['Body']);
            $imagedata = file_get_contents($newname);
            $base64 = base64_encode($imagedata);
            unlink($newname);
            return $base64;
        } catch (Exception $exception){
            return "";
        }
    }

}