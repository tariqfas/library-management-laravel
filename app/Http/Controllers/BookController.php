<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //
    public function index()
    {
        //code ici 
        $books = DB::table('books')->get()->all();
        return view('layout.app_public',compact('books',$books));
    }
    // book details
    public function getBook($id)
    {
        //code ici 
        $book = DB::table('books')->find($id);
        // $book = Book::where('id',$id)->get();

        $book = Book::find($id);
 
        // return $book->category->category_name;

        // dd($book->category->category_name);
        return view('productDetails',compact('book',$book));
    }
}
