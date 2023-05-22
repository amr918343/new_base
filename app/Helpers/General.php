<?php
function sharedResponse($method, $resource = null, $collection_or_model = null, $custom_message = null)
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
        $response = response()->json(['status' => 'fail', 'data' => null, 'message' => trans($custom_message)], 422);
    }
    return $response;
}
