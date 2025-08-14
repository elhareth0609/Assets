<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {
    public function login(Request $request) {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
                'remember' => 'sometimes|in:on',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 422);
            }

            try {
                $loginInput = $request->input('email');
                $password = $request->input('password');
                $remember = $request->has('remember');

                // تحديد ما إذا كان البريد أو اسم المستخدم
                $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

                // محاولة تسجيل الدخول
                if (Auth::attempt([$fieldType => $loginInput, 'password' => $password], $remember)) {
                    return response()->json([
                        'message' => __("Login successful"),
                    ]);
                } else {
                    return response()->json([
                        'message' => __("Invalid credentials"),
                    ], 401);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 500);
            }
        }
        return view('content.auth.login');
    }



    public function change(Request $request) {
      $validator = Validator::make($request->all(), [
        'newPassword' => 'required|min:8',
        'confirmPassword' => 'required|same:newPassword',
        'currentPassword' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $validator->errors()->first()
          ], 422);
      }

      try {
        if (!Auth::attempt(['email' => Auth::user()->email, 'password' => $request->currentPassword])) {
            return response()->json([
              'icon' => 'error',
              'state' => __("Error"),
              'message' => __("Current password is incorrect."),
            ]);
        }

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->newPassword);
        $user->save();

        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Password changed successfully.")
        ]);

      } catch (\Exception $e) {
        return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $e->getMessage(),
        ]);
      }
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
            'icon' => 'error',
            'state' => __("Error"),
            'message' => $validator->errors()->first()
            ], 422);
        }

        try {

            $user = User::find(Auth::user()->id);
            $user->username = $request->username;
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->save();

            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("Profile details updated successfully.")
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('auth.login');
    }

}
