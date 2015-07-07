<?php

namespace These\Http\Requests;

use Redirect;
use Illuminate\Contracts\Auth\Guard;

class AdminPageRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Guard $auth)
    {
        if (!$auth->check()) {
            return false;
        }

        return $auth->user()->isAdmin();
    }

    /**
     * If access was denied.
     *
     * @return Redirect to route with flash message
     */
    public function forbiddenResponse()
    {
        return Redirect::route('results.index')
                ->with('flash_notification', "Vous n'avez pas accès à cette fonctionnalité !");
    }

    /**
     * Get the sanitized input for the request.
     *
     * @return array
     */
    public function sanitize()
    {
        return $this->all();
    }
}
