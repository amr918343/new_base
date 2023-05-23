<?php
namespace App\Services\Dashboard\Admin\AdminService;

use App\Http\Requests\General\FilterRequest;
use App\Http\Resources\Dashboard\Admin\IndexAdminResource;
use App\Http\Resources\Dashboard\Admin\ShowAdminResource;
use App\Models\User;

class AdminService {
    public function getAllWithPagination(FilterRequest $request) {
        $admins = User::whereIn('user_type', ['admin', 'superadmin'])->where('user_id', '<>', auth('api')->id())->latest()->paginate($request->per_page ?? 10);
        return sharedResponse('index', IndexAdminResource::class, $admins);
    }

    public function getAllWithoutPagination() {
        $admins = User::whereIn('user_type', ['admin', 'superadmin'])->where('user_id', '<>', auth('api')->id())->get();
        return sharedResponse('index', IndexAdminResource::class, $admins);
    }

    public function show($id) {
        $admin = User::where('id', "<>", auth()->id())->whereIn('user_type', ['superadmin', 'admin'])->findOrFail($id);
        return sharedResponse('show', ShowAdminResource::class, $admin);
    }
    public function store($request) {
        try {
            $admin = User::create($request->validated() + ['user_type' => 'admin', 'is_activated_by_admin' => true]);
            return sharedResponse('store');
        } catch (\Exception $e) {
            \DB::rollback();
            return sharedResponse('server_error');
        }
    }

    public function update($request, $id) {
        $admin = User::where('id', "<>", auth()->id())->whereIn('user_type', ['superadmin', 'admin'])->findOrFail($id);
        try {
            $admin->update($request->validated());
            return sharedResponse('update');
        } catch (\Exception $e) {
            \DB::rollback();
            return sharedResponse('server_error');
        }
    }

    public function destroy($id) {
        $admin = User::where('id', "<>", auth()->id())->whereIn('user_type', ['superadmin', 'admin'])->findOrFail($id);
        $admin->delete();
        return sharedResponse('destroy');
    }
}
