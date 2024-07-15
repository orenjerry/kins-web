<?php

namespace App\Repositories\Activity;

use App\Http\Response\ResponseArray;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityRepositoryImplement extends Eloquent implements ActivityRepository
{
    protected $response;

    public function __construct(ResponseArray $response)
    {
        $this->response = $response;
    }

    public function online(Request $request)
    {
        // Handle the online status logic here
    }

    public function offline(Request $request)
    {
        $userId = session('user_id');
        $user = User::find($userId);

        if ($user) {
            $user->last_online_at = now();
            $user->save();
            return $this->response->returnArray(200, 'Successfully set activity to offline', '');
        }

        return $this->response->returnArray(404, 'User not found', '');
    }
}
