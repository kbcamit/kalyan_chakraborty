<?php

namespace App\Controllers;

use Core\Controller;

class Solution extends Controller
{
    public function __construct($route_params)
    {
        parent::__construct($route_params);
    }

    private function solutionOne()
    {
        $ch = curl_init('http://103.219.147.17/api/json.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = curl_exec($ch);
        curl_close($ch);

        $output = explode(", ", json_decode($response, true)['data']);

        $resultantArr = [];

        $index = 0;

        while ($index < count($output)) {
            $keyArr = explode("=", $output[$index]);
            $speedArr = explode("=", $output[$index + 1]);
            array_push($resultantArr, ['key' => $keyArr[1], 'speed' => $speedArr[1]]);
            $index += 2;
        }

        $result = array_values(array_filter($resultantArr, function ($arr) {
            return $arr['speed'] > 60;
        }));

        echo count($result) . " Total count of speeds those crossed 60";
        echo "<br>";
        echo "List<br>";
        print_r($result);
    }

    private function solutionTwo()
    {
        $arr = array('z1', 'Z10', 'z12', 'Z2', 'z3');
        natcasesort($arr);
        print_r($arr);
    }

    private function isValidIp($ip)
    {
        $ipArr = explode(".", $ip);

        if (count($ipArr) != 4) return false;

        if ($ipArr[0][0] == "0") return false;

        $validIp = false;

        foreach ($ipArr as $value):
            if (is_numeric($value)) {
                if ($value >= 0 && $value <= 255) {
                    $validIp = true;
                } else {
                    $validIp = false;
                    break;
                }
            } else {
                $validIp = false;
                break;
            }
        endforeach;

        return $validIp;
    }

    private function solutionThree()
    {
        if($this->isValidIp("192.168.0.1")) {
            print_r("Valid IP address");
        } else {
            print_r("Not valid");
        }
    }

    public function index()
    {
        if ($this->route_params['id'] == 1) {
            $this->solutionOne();
        } elseif ($this->route_params['id'] == 2) {
            $this->solutionTwo();
        } else {
            $this->solutionThree();
        }
    }
}
