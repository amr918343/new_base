<?php
namespace App\Services\Dashboard\Admin\Auth;

use App\Http\Resources\API\Dashboard\Admin\AdminProfileResource;
use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;

class AuthService {
    public function login(Request $request) {
        $admin = User::where('phone', $request->identifier)->orWhere('email', $request->identifier)->firstOrFail();
        if (!$admin) {
            return sharedResponse('unprocessable', null, null, trans('dashboard.auth.failed_login'), 401);
        }
        if (!$token = auth('api')->attempt($this->getCredentials($request))) {
            return sharedResponse('unprocessable', null, null, trans('dashboard.auth.failed_login'), 401);
        }
        $admin = auth('api')->user();
        if ($admin->is_active == false) {
            return sharedResponse('unprocessable', null, null, trans('dashboard.auth.is_active'));
        }
        if ($admin->is_ban == true) {
            return sharedResponse('unprocessable', null, null, trans('dashboard.auth.banned_message') . ' : ' . $admin->ban_reason);
        }

        data_set($admin, 'token', $token);
        sharedResponse('login', AdminProfileResource::class, $admin);
    }

    public function logout(Request $request) {
        $admin = auth('api')->user();
        $device = Device::where(['user_id' => auth('api')->id(), 'device_token' => $request->device_token])->first();
        if ($device) {
            $device->delete();
        }
        auth('api')->logout();
        return response()->json(['status' => 'success', 'data' => null, 'message' => trans('dashboard.auth.success_logout')]);
    }

    protected function getCredentials(Request $request)
    {
        $identifier = $request->identifier;
        $credentials = [];
        switch ($identifier) {
            case filter_var($identifier, FILTER_VALIDATE_EMAIL):
                $identifier = 'email';
                break;
            case is_numeric($identifier):
                $identifier = 'phone';
                break;
            default:
                $identifier = 'email';
                break;
        }
        $credentials[$identifier] = $request->identifier;
        if ($request->password) {
            $credentials['password'] = $request->password;
        }

        return $credentials;
    }
}
