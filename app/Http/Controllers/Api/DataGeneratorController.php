<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Euser;

class DataGeneratorController extends Controller
{
    public function data()
    {
        $startFrom = request('startFrom');
        $inserts = [];
        for($i=$startFrom; $i< $startFrom + 10000; $i++) {
            array_push($inserts,array(
                'username'  => 85519000000 + $i,
                'password'  => 'tsungloadtest',
                'iterationcount'    => 0
            ));
        }
        return Euser::insert($inserts);
    }

    public function count()
    {
        return Euser::count();
    }

    public function last()
    {
        return Euser::where('password','tsungloadtest')->orderBy('username','DESC')->take(5)->get();
    }

    // NGORK DATA TO SERVER VIA API:: DATA FORMAT JSON
    public function ngork_data()
    {
        // CREATE GUZZLE CLIENT
        $client = new \GuzzleHttp\Client();

        // LOAD DATA FROM CSV FILE
        $file = public_path('users.csv');

        // CONVERT DATA FROM CSV TO ARRAY
        $customerArr = $this->csvToArray($file);

        // SUBMIT DATA TO API
        for ($i=0; $i < count($customerArr); $i++) {
            $response = $client->request('POST', 'http://10.10.12.10:8080/api/v1/register',[
                'json' => ["mobileNumber" => $customerArr[$i]['MSISDN']]
            ]);
        }

        // RETURN RESPONSE
        return "Done";
    }

    private function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
