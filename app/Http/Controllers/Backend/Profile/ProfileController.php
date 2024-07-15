<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Controllers\Controller;
use App\Repositories\Profile\ProfileRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileRepository;
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function viewMakeProfile()
    {
        return view('content.profile.makeProfile');
    }

    public function makeProfile(Request $request)
    {
        return $this->profileRepository->makeProfile($request);
    }
}
