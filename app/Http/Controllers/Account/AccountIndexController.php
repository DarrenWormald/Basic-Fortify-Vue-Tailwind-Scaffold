<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountIndexController extends Controller
{
    //
    //
    public function _construct()
    {
        $this->middleware(['auth']);
    }
    //
    public function __invoke() 
    {
        return inertia()->render('Account/Account');
    }

}
