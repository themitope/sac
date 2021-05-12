<?php
	session_start();
    require_once('../config/db_class.php');
    require_once('../config/constants.php');
    header('Content-Type: application/json');
    $object = new DbQueries();
    $user_id = $_SESSION['user']['unique_id'];
    $order_json = $_SESSION['cart'];
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    $order_total = $_POST['order_total'];
    $order_location = $_SESSION['location'];
    $fullname = $_POST['fullname'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $place_order = $object->save_order($user_id, $order_json, $payment_method, $order_total, $order_location, $fullname, $country, $address, $postcode, $email, $phone);
    $place_order_decode = json_decode($place_order, true);
    $response_array = [];
    // $response_array = [
    //     'redirect' => $place_order_decode['response']['data'],
    //     'success' => 'success',
    // ];
    if($place_order_decode['response']['status'] == SUCCESS_RESPONSE){
        if($place_order_decode['response']['message'] == "redirect"){
            $response_array = [
                'status' => "redirect",
                'url' => $place_order_decode['response']['data'],
            ];
        }
        else{
            $response_array = [
                'status' => "success",
                'url' => "order_complete",
            ];
        }
    }
    else{
        $response_array = [
            'status' => "error",
            'message' => $place_order_decode['response']['message'],
        ];
    }
    echo json_encode($response_array);
?>