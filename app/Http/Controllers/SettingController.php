<?php

namespace App\Http\Controllers;

use App\Models\Details;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller {
    public function index() {
        return view('content.settings.index');
    }

    public function get_account() {
        return view('content.settings.account');
    }

    // public function privacy_and_policy() {
    //     $content = Details::where('type','privacy-and-policy')->first();
    //     return view('content.home.pages.privacy-and-policy')
    //     ->with('content',$content->content);
    // }

    // public function terms_of_use() {
    //     $content = Details::where('type','terms-of-use')->first();
    //     return view('content.home.pages.terms-of-use')
    //     ->with('content',$content->content);
    // }

    // public function about_us() {
    //     $content = Details::where('type','about-us')->first();
    //     return view('content.home.pages.about-us')
    //     ->with('content',$content->content);
    // }


    public function update_account(Request $request) {
        $validator = Validator::make(request()->all(), [
            'full_name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            // 'phone' => 'required',
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
            $user->full_name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();

            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("Updated Successfully.")
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update_password(Request $request) {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $validator->errors()->first()
            ], 422);
        }

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => __("Current password is incorrect.")
            ], 422);
        }

        try {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json([
                'icon' => 'success',
                'state' => __("Success"),
                'message' => __("Password updated successfully.")
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'state' => __("Error"),
                'message' => $e->getMessage()
            ]);
        }
    }

    // public function upload_image(Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'image' => 'required|image|mimes:jpeg,png,jpg', // Validate each file in the array
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'icon' => 'error',
    //             'state' => __("Error"),
    //             'message' => $validator->errors()->first()
    //         ], 422);
    //     }

    //     try {
    //         $image = $request->file('image');
    //         $imageName = time() . '_' . $image->getClientOriginalName();
    //         $image->move(public_path('assets/img/photos/users/'), $imageName);

    //         $user = User::find(Auth::user()->id);
    //         $user->photo = $imageName;
    //         $user->save();

    //         return response()->json([
    //             'icon' => 'success',
    //             'state' => __("Success"),
    //             'message' => __("Created Successfully.")
    //         ]);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'icon' => 'error',
    //             'state' => __("Error"),
    //             'message' => $e->getMessage(),
    //         ]);
    //     }
    // }

    // public function get_privacy_and_policy() {
    //     $content = Details::where('type','privacy-and-policy')->first();
    //     return view('content.dashboard.settings.privacy-and-policy')
    //     ->with('content',$content->content);
    // }

    // public function get_terms_of_use() {
    //     $content = Details::where('type','terms-of-use')->first();
    //     return view('content.dashboard.settings.terms-of-use')
    //     ->with('content',$content->content);
    // }

    // public function get_about_us() {
    //     $content = Details::where('type','about-us')->first();
    //     return view('content.dashboard.settings.about-us')
    //     ->with('content',$content->content);
    // }

    // public function update_privacy_and_policy(Request $request) {
    //     try {
    //         $content = Details::where('type','privacy-and-policy')->first();
    //         $content->content = $request->content;
    //         $content->save();
    //         return response()->json([
    //         'icon' => 'success',
    //         'state' => __("Success"),
    //         'message' => __("Updated Successfully.")
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //         'icon' => 'error',
    //         'state' => __("Error"),
    //         'message' => $e->getMessage()
    //         ]);
    //     }
    // }

    // public function update_terms_of_use(Request $request) {
    //     try {
    //         $content = Details::where('type','terms-of-use')->first();
    //         $content->content = $request->content;
    //         $content->save();
    //         return response()->json([
    //         'icon' => 'success',
    //         'state' => __("Success"),
    //         'message' => __("Updated Successfully.")
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //         'icon' => 'error',
    //         'state' => __("Error"),
    //         'message' => $e->getMessage()
    //         ]);
    //     }
    // }

    // public function update_about_us(Request $request) {
    //     try {
    //         $content = Details::where('type','about-us')->first();
    //         $content->content = $request->content;
    //         $content->save();
    //         return response()->json([
    //         'icon' => 'success',
    //         'state' => __("Success"),
    //         'message' => __("Updated Successfully.")
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //         'icon' => 'error',
    //         'state' => __("Error"),
    //         'message' => $e->getMessage()
    //         ]);
    //     }
    // }

}
