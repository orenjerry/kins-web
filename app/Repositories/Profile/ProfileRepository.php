<?php

namespace App\Repositories\Profile;

use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface ProfileRepository extends Repository{

    public function makeProfile(Request $request);
}
