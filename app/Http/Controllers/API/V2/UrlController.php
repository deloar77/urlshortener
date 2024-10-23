<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use App\Models\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UrlController extends Controller
{
    
    public function shorten(Request $request)
    {
         
        $request->validate([
            'original_url' => 'required|url'
        ]);
          
        $originalUrl = $request->input('original_url');
       

        // Retrieve the authenticated user
           $user = $request->user(); // or auth()->user();
        // Check if the URL already exists for the user
            $url = URL::where('original_url', $originalUrl)
              ->where('user_id', $user->id) // Ensure it's the same user's URL
              ->first();
        
         
       
        if ($url==null) {
            $shortCode = URL::generateShortCode();
            $url = URL::create([
                'user_id'=>$user->id,
                'original_url' => $originalUrl,
                'shortened_url' => $shortCode,
            ]);
        } 
    
        return response()->json([
            'original_url' => $url->original_url,
            'shortened_url' => url('/') . '/' . $url->shortened_url
        ], 201);
    }

   public function UserUrls(Request $request){
    // Assuming the user is authenticated via a token
    $user = $request->user();

    // Retrieve all URLs the authenticated user has registered
    $urls = URL::where('user_id', $user->id)->pluck('original_url');
     
     
    return response()->json([
        'urls' => $urls
    ], 200);
   }
}
