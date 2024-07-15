<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Controllers\Controller;
use App\Repositories\Activity\ActivityRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    protected $activityRepository;
    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }
    public function online (Request $request)
    {
        return $this->activityRepository->online($request);
    }

    public function offline (Request $request)
    {
        return $this->activityRepository->offline($request);
    }
}
