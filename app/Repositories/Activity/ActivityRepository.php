<?php

namespace App\Repositories\Activity;

use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface ActivityRepository extends Repository{
    public function online(Request $request);
    public function offline(Request $request);
}
