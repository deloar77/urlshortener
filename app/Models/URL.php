<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class URL extends Model
{
   protected $fillable = ['original_url', 'shortened_url','user_id','visit_count'];

    // Method to generate a unique short code
    public static function generateShortCode()
    {
        $code = substr(md5(uniqid(rand(), true)), 0, 6); // Generates a 6-character string
        while (self::where('shortened_url', $code)->exists()) {
            $code = substr(md5(uniqid(rand(), true)), 0, 6); // Regenerate if code exists
        }
        return $code;
    }
}
