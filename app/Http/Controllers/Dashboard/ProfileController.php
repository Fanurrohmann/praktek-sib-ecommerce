<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;

class ProfileController extends DashboardController
{
    public function index()
    {
        $this->setTitle('Products');
        
        $this->addBreadcrumb('Dashboard', route('dashboard.index'));
        $this->addBreadcrumb('Profile');

        $this->data['profile'] = auth()->user();

        return view('dashboard.profile.index', $this->data);
    }

    public function update()
    {
        // 
    }
}
