<?php
ini_set("display_errors", 1);

$arr = array(
    "answers" => array(
        "年齢" => "30",
        "性別" => "男性",
        "現在日付" => "20220329"
    )

);

$test_json = json_encode($arr);

//$test_json = '{"answers": {"年齢": "20", "性別": "男性", "保険種別": "医療保険", "特約": "なし"}}';
//$test_json = '{"answers": {"年齢": "30", "性別": "男性", "現在日付": "20220328"}}';
//$test_json = '{"answers": { "A": ""}}';
//$test_json = '';
//$url = 'https://aeon-dev.dx-dev.toppan-f.co.jp/api/classify/%E4%BF%9D%E9%99%BA%E5%95%86%E5%93%81%E9%81%B8%E6%8A%9E';

//https://aeon-dev.dx-dev.toppan-f.co.jp/api/classify/%E4%BF%9D%E9%99%BA%E6%96%99%E8%A9%A6%E7%AE%97_%E5%BC%95%E5%8F%97%E5%9F%BA%E6%BA%96%E7%B7%A9%E5%92%8C%E5%9E%8B%E4%BF%9D%E9%99%BA

$url = 'http://10.0.138.173:8080/api/classify/%E4%BF%9D%E9%99%BA%E6%96%99%E8%A9%A6%E7%AE%97_%E5%BC%95%E5%8F%97%E5%9F%BA%E6%BA%96%E7%B7%A9%E5%92%8C%E5%9E%8B%E4%BF%9D%E9%99%BA';

echo("<br>\n");
echo(urldecode($url));
echo("<br>\n");
echo($test_json);
echo("<br>\n");

$respons_json= postFromHTTP($url, $test_json);

echo($respons_json);


$respons_arr = json_decode($respons_json, TRUE);

print_r($respons_arr);

function postFromHTTP($url, $data)
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_AUTOREFERER => true,
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}