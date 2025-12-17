<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MorePages extends Controller
{
    public function homeAdmin(): Response
    {
        $data = [
            //
        ];

        return Inertia::render('admin/page', $data);
    }
}
