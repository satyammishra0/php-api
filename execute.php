<style>
    body {
        background-color: #000;
        color: #fff;
    }
</style>
<?php
$url = "http://localhost/saaol/creative-generator/api/index.php?key=qwertyuiopljhgf";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);

$result = json_decode($result, true);

if (!isset($result['msg'])) {
    echo "<pre>";
    print_r($result);
    echo "</pre>";
} else {
    echo "no data";
}
