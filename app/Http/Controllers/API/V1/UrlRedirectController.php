<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\URL;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UrlRedirectController extends Controller
{
     public function redirectToOriginal($shortened_url): RedirectResponse
    {
        // Look up the shortened URL in the database
        $url = URL::where('shortened_url', $shortened_url)->first();

        if ($url) {
            // Redirect to the original URL
            return redirect($url->original_url);
        }

        // If the shortened URL doesn't exist, return a 404 response
        return abort(404, 'Shortened URL not found.');
    }
}
