<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $books = Book::where('title', 'LIKE', "%$query%")->get();
        return response()->json($books);
    }
}