<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // public function homePage ()
    // {
    //     return view('admin.admin-home');
    // }
       
    public function accomplishmentPage()
    {
        return view('admin.admin-accomplishment');
    }

    public function classRecordsPage()
    {
        return view('admin.accomplishments.admin-class-records');
    }

    public function addAccomplishmentPage()
    {
        return view('admin.accomplishments.admin-add-accomplishment');
    }

    public function hapPage()
    {
        return view('admin.reports.admin-hap');
    }
}
