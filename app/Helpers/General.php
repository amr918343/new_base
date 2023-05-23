<?php
function sharedResponse($method, $resource = null, $collection_or_model = null, $custom_message = null, $status = 422)
{
    $response = null;
    if ($method == 'store') {
        $response = response()->json(['status' => 'success', 'message' => trans('dashboard.messages.success_add'), 'data' => null], 201);
    }

    if ($method == 'update') {
        $response = response()->json(['status' => 'success', 'message' => trans('dashboard.messages.success_update'), 'data' => null]);
    }

    if ($method == 'destroy') {
        $response = response()->json(['status' => 'success', 'data' => null, 'message' => trans('dashboard.messages.success_delete')]);
    }

    if ($method == 'server_error') {
        $response = response()->json(['status' => 'fail', 'message' => trans('dashboard.messages.something_went_wrong_please_try_again'), 'data' => null], 500);
    }

    if ($method == 'index') {
        $response = $resource::collection($collection_or_model)->additional(['status' => 'success', 'message' => null]);
    }

    if ($method == 'show') {
        $response = $resource::make($collection_or_model)->additional(['status' => 'success', 'message' => null]);
    }

    if ($method == 'unprocessable') {
        $response = response()->json(['status' => 'fail', 'data' => null, 'message' => trans($custom_message)], $status);
    }
    return $response;
}

function convertArabicNumber($number)
{
    $arabic_array = ['۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'];
    return strtr($number, $arabic_array);
}

function filter_mobile_number($phone)
{
    $phone =  convertArabicNumber($phone);
    $first_number = substr($phone, 0, 1);
    if ($first_number == '0') {
        $phone = substr($phone, 1);
    }
    return $phone;
}
