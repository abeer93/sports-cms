<?php

namespace App\Http\Controllers;

class ApiDocumentationController extends Controller
{
    /**
     * View for displaying json apis
     */
    public function jsonApisDoc()
    {
        return view('api-doc');
    }
}
