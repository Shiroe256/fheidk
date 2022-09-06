<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Institutions;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function fetchUser()
    {
        $user = DB::table('users')
        ->where('id',Auth::user()->id)
        ->first();
        return response()->json($user);
    }

    public function fetchHeis()
    {
        $heis = DB::table('tbl_heis')
        // ->where('hei_uii',Auth::user()->hei_uii)
        ->where('hei_uii','01026')
        ->first();
        return response()->json($heis);
    }

    // public function update(Request $request) {
	// 	$fileName = '';
	// 	$user = User::find($request->emp_id);
	// 	if ($request->hasFile('avatar')) {
	// 		$file = $request->file('avatar');
	// 		$fileName = time() . '.' . $file->getClientOriginalExtension();
	// 		$file->storeAs('public/images', $fileName);
	// 		if ($user->avatar) {
	// 			Storage::delete('public/images/' . $user->avatar);
	// 		}
	// 	} else {
	// 		$fileName = $request->emp_avatar;
	// 	}

	// 	$empData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'email' => $request->email, 'phone' => $request->phone, 'post' => $request->post, 'avatar' => $fileName];

	// 	$emp->update($empData);
	// 	return response()->json([
	// 		'status' => 200,
	// 	]);
	// }

    // handle update a user ajax request
    public function updateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'avatar' => 'string', //modal field name => validation
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $fileName = '';
            $user = User::find(Auth::user()->id);
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/images', $fileName);
                if ($user->avatar) {
                    Storage::delete('public/images/' . $user->avatar);
                }
            } else {
                $fileName = $request->user_avatar;
            }

            $userData = [
                //actual data being collected in the modal
                'fhe_focal_lname' => $request->fhe_focal_lname, //tablename => $request->name of input field
                'fhe_focal_fname' => $request->fhe_focal_fname,
                'fhe_focal_mname' => $request->fhe_focal_mname,
                'contact_no' => $request->contact,
                'email' => $request->email,
                'avatar' => $fileName,
            ];
            $user->update($userData);
            return response()->json([
                'status' => 200,
            ]);
        }
    }

}
