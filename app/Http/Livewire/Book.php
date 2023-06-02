<?php

namespace App\Http\Livewire;

use App\Models\Author;
use App\Models\Book as ModelsBook;
use App\Models\Category;
use App\Models\Publisher;
use Livewire\Component;

class Book extends Component
{
    public $showTable = true;
    public $showForm = false;
    public $updateForm = false;
    public $edit_book_name = "";
    public $updatedBookId = "";
    // from the input
    public $search;
    // from select of add book
    public $category_id;
    public $publisher_id;
    public $author_id;
    // from the input of add book
    public $book_name;
    public function render()
    {
        // Categories
        $categories = Category::get();
        // Publishers
        $publishers = Publisher::get();
        // Authors
        $authors = Author::get();

        $nbrBook = ModelsBook::get()->count();
        $searchTerm = '%'.$this->search.'%';
        if($this->search) {
            $books = ModelsBook::where('book_name','LIKE',$searchTerm)->orderBy('created_at','DESC')->paginate(5);
        }else{
            $books = ModelsBook::orderBy('created_at','DESC')->paginate(5);
        }
        return view('livewire.book',compact('books','nbrBook','categories','publishers','authors'))->layout('layout.app');
    }
    public function showForm()
    {
        $this->showTable = false;
        $this->showForm = true;
        $this->updateForm = false;
        // $this->category_id = 0;
        empty($this->category_id);
        // $this->publisher_id = 0;
        empty($this->publisher_id);
        // $this->author_id =0;
        empty($this->author_id);
    }
    public function store()
    {
        $validate = $this->validate([
            'book_name'=> ['required','string','unique:books'],
            'category_id'=> ['required'],
            'publisher_id'=> ['required'],
            'author_id'=> ['required']
        ]);
        $result = ModelsBook::create($validate);
        if($result){
            session()->flash('success','Book Added Successfully');
            $this->showTable = true;
            $this->showForm = false;
            $this->book_name = '';
        }else{
            session()->flash('error','Book Not Added');
        }
    }
    public function deleteBook($id)
    {
        $result = ModelsBook::findORFail($id)->delete();
        ($result)
        ? session()->flash('success','Book Delete Successfully')
        : session()->flash('error','Book Not Delete Successfully');
        /* if($result){
            session()->flash('success','Book Delete Successfully');
        }else{
            session()->flash('error','Book Not Delete Successfully');
        } */
    }
    public function cancel()
    {
        
        $this->updateForm = false;
        $this->showForm = false;
        $this->showTable = true;
    }
    public function editForm($id)
    {
        $book = ModelsBook::findORFail($id);
        $this->edit_book_name=$book->book_name;
        $this->updatedBookId=$book->id;

        $this->category_id = $book->category_id;
        $this->publisher_id = $book->publisher_id;
        $this->author_id = $book->author_id;

        // dd($book->id);
        $this->showTable = false;
        $this->updateForm = true;
        // $this->updatedbook = "";


    }
    public function updateBook($id)
    {
        // return redirect()->route("book");
        // dd($req->input("edit_book_name"));
        $book = ModelsBook::find($id);
        $edited_book = $this->validate([
            'edit_book_name' => ['required','string'],
            'category_id'=> ['required'],
            'publisher_id'=> ['required'],
            'author_id'=> ['required']
        ]);
        // dd($edited_book['edit_book_name']);
        $book->book_name = $this->edit_book_name;
        $book->category_id = $this->category_id;
        $book->publisher_id = $this->publisher_id;
        $book->author_id = $this->author_id;
        // $book->book_name = $edited_book['edit_book_name'];
        $result = $book->save();
        if($result){
            session()->flash('success','Book Updated Successfully');
            $this->showTable = true;
            $this->updateForm = false;
        }else{ 
            session()->flash('error','Book Not Updated');
         } 

    }
}
