<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Backend\BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\PasswordCheckedRequest;
use App\Http\Requests\Backend\ProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use App\Services\ConstantMessageService;

class UserController extends BaseController
{

    protected $panel = 'User';
    protected $view_path = 'backend.user.';
    protected $base_route = 'backend.user.';
    protected $folder_name = 'user';
    protected $page_title, $page_method, $model;

    public function __construct()
    {
        parent::__construct();
    }

    public function profile()
    {
        $data =  [];
        $data['row'] =  auth()->user()->profile;
        return view($this->__loadDataToView($this->view_path . 'profile'),compact('data'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        try{
            if ($request->hasFile('profile_image')) {
                $image = $this->uploadImage($request,'profile_image');
                $request->request->add(['image' => $image]);
                if(auth()->user()->profile){
                    $this->deleteImage(auth()->user()->profile->image);
                }
            }
            $record = Profile::updateOrCreate([
                'user_id' => getLoggedInUser()->id],
                $request->all()
            );
            toast('Profile Updated successfully.','success','top-right');
        }
        catch (\Exception $e) {
            toast('update failed!','error','top-right');
        }
        return back();
    }

    public function changePassword(PasswordCheckedRequest $request)
    {
        $password = $request['new_password'] ? Hash::make($request['new_password']) : auth()->user()->password;
        auth()->user()->update(['password' => $password]);
        toast(ConstantMessageService::UPDATE_PASSWORD,'success','top-right');
        return response()->json('password updated successfully');
    }

}
