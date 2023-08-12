<?php

include("db.php");
header('Content-Type:application/json');

if (isset($_GET['key'])) {


    $key = mysqli_real_escape_string($conn, $_GET['key']);
    $checkRes = mysqli_query($conn, "select * from `api_token` where `token`='$key';");

    if (mysqli_num_rows($checkRes) > 0) {

        $checkRow = mysqli_fetch_assoc($checkRes);
        if ($checkRow['status'] == 1) {

            if ($checkRow['hit_count'] >= $checkRow['hit_limit']) {
                echo json_encode(['status' => 'true', 'msg' => "API limit exceeded"]);
            } else {
                $res = mysqli_query($conn, "UPDATE `api_token` set `hit_count`=hit_count+1 WHERE `token`='$key';");
            }
            $sql = "SELECT * FROM `api` ";
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $arr[] = $row;
                }
                echo json_encode(['status' => 'true', 'data' => $arr]);
            }
        }
    } else {
        echo json_encode(['status' => 'true', 'msg' => "Not a valid api key"]);
    }
} else {
    echo json_encode(['status' => 'true', 'msg' => "No api key found"]);
}
