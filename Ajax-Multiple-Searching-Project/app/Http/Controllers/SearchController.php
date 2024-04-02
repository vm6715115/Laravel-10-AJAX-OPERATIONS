<?php

namespace App\Http\Controllers;

use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = Search::query();
        if ($request->ajax()) {
            $users = $query->where('name','LIKE','%'.$request->search.'%')
            ->orWhere('email','LIKE','%'.$request->search.'%')
            ->orWhere('phone','LIKE','%'.$request->search.'%')
            ->get();
            return response()->json(['users' => $users]);
        }
        else
        {
            $users = $query->get();
            return view('search', compact('users'));
        }
    }
}
