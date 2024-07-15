<?php

namespace App\Repositories\Profile;

use App\Http\Response\ResponseArray;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileRepositoryImplement extends Eloquent implements ProfileRepository
{
    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $response;

    public function __construct(ResponseArray $response)
    {
        $this->response = $response;
    }

    public function makeProfile(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string',
                'photo' => 'image|mimes:png,jpg,jpeg,gif|max:5120',
                'banner' => 'image|mimes:png,jpg,gif|max:5120',
                'about' => 'nullable|string',
                'pronouns' => 'nullable|string',
            ]);

            // Get the authenticated user
            $user = User::where('id', session()->get('user_id'))->first();

            // Check if the user already has a profile
            $existingProfile = Profile::where('id_user', $user->id)->first();
            if ($existingProfile) {
                return $this->response->returnArray(400, 'Profile already exists');
            }

            // Initializing table to insert data
            $profile = new Profile;
            $profile->id_user = $user->id;
            $profile->name = $request->input('name');

            // Handle the file uploads
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoName = Str::random(32) . '.' . $photo->getClientOriginalExtension();
                $photoPath = 'images/profile/photo/' . $photoName;
                $photo->move(public_path('images/profile/photo'), $photoName);
                $profile->photo = '/' . $photoPath;
            }

            if ($request->hasFile('banner')) {
                $banner = $request->file('banner');
                $bannerName = Str::random(32) . '.' . $banner->getClientOriginalExtension();
                $bannerPath = 'images/profile/banner/' . $bannerName;
                $banner->move(public_path('images/profile/banner'), $bannerName);
                $profile->banner = '/' . $bannerPath;
            }

            // Handle optional fields
            if ($request->input('about')) {
                $profile->about = $request->input('about');
            }

            if ($request->input('pronouns')) {
                $profile->pronouns = $request->input('pronouns');
            }

            // Save the profile
            $profile->save();

            return $this->response->returnArray(201, 'Profile created successfully');
        } catch (\Exception $e) {
            Log::error('Profile creation error: ' . $e->getMessage());
            return $this->response->returnArray(500, 'Internal Server Error', $e->getMessage());
        }
    }
}
