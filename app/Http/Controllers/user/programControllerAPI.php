<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Models\Donation;

class programControllerAPI extends Controller
{
    public function searchVolunteer(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|max:255',
        ]);
    
        $query = $request->input('keyword');
    
        $volunteers = Volunteer::where('title', 'LIKE', "%{$query}%")
                               ->orWhere('description', 'LIKE', "%{$query}%")
                               ->orWhere('category', 'LIKE', "%{$query}%")
                               ->get();
    
        $result = $volunteers;
    
        return response()->json([
            'status' => 'success',
            'message' => 'Search completed successfully',
            'data' => $result,
        ]);
    }
    
    public function searchDonation(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|max:255',
        ]);
    
        $query = $request->input('keyword');
    
        $donations = Donation::where('title', 'LIKE', "%{$query}%")
                             ->orWhere('description', 'LIKE', "%{$query}%")
                             ->orWhere('category', 'LIKE', "%{$query}%")
                             ->get();
    
        $result = $donations;
    
        return response()->json([
            'status' => 'success',
            'message' => 'Search completed successfully',
            'data' => $result,
        ]);
    }
}
