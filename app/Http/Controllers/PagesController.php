<?php

namespace These\Http\Controllers;

use Request;

/**
 * Class PagesController.
 */
class PagesController extends Controller
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        // Check for unsupportedBrowser
        $this->middleware('supportedBrowser');
    }

    /**
     * Home view.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Thank you for submitting.
     *
     * @return \Illuminate\View\View
     */
    public function thankyou()
    {
        extract(Request::all());

        return view('survey.submitted', compact('email', 'answer_id'));
    }
}
