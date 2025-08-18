<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait ApiResponder {
    protected function success($data = null, $message = null, $code = 200) {
        return response()->json([
            'icon' => 'success',
            'state' => 'نجاح',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($message, $code = 422) {
        return response()->json([
            'icon' => 'error',
            'state' => 'خطأ',
            'message' => $message
        ], $code);
    }

    /**
     * Check if the user has the required permission
     *
     * @param string $permission The permission to check
     * @param bool $isAjax Whether the request is an AJAX request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function checkPermission($permission, $isAjax) {
        if (!Auth::user()->hasPermission($permission)) {
            $message = 'ليس لديك الصلاحية للقيام بهذه العملية';
            
            if ($isAjax) {
                return $this->error($message, 403);
            }
            
            abort(403, $message);
        }
}
}
