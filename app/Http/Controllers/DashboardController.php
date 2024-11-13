<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->data['breadcrumbs'] = [];
        $this->data['title'] = 'Dashboard';
        $this->data['notification'] = (object) [
            'unread' => 0,
            'notifications' => [],
        ];
    }

    // Add index method to handle dashboard view
    public function index()
    {
        // You can also add specific breadcrumb entries if needed
        $this->addBreadcrumb('Home', route('dashboard.index'));

        // Render the dashboard.index view with the data
        return view('dashboard.index', $this->data);
    }

    protected function addBreadcrumb($name, $url = null)
    {
        $this->data['breadcrumbs'][] = (object) [
            'name' => $name,
            'url' => $url,
        ];
    }

    protected function getBreadcrumbs()
    {
        return $this->data['breadcrumbs'];
    }

    protected function setTitle($title)
    {
        $this->data['title'] = $title;
    }

    protected function getTitle()
    {
        return $this->data['title'];
    }

    protected function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    protected function getData($key)
    {
        return $this->data[$key];
    }

    protected function setDrillUp($url)
    {
        $this->data['drillUp'] = $url;
    }
}
