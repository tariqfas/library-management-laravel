<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\IssueBook as ModelsIssueBook;
use App\Models\Student;
use Livewire\Component;

class IssueBook extends Component
{
    public $showTable = true;
    public $showForm = false;
    public $updateForm = false;
    public $edit_book_name = "";
    public $updatedBookId = "";
    public $dateIssue;
    public $dateReturn;
    // from the input
    public $search;
    // from select of add book
    // from the input of add book
    public $student_id;
    public $book_id;
    public $book_name;
    public function render()
    {
        // Students
        $students = Student::get();
        // books
        $books = Book::get();

        $nbrIssueBook = ModelsIssueBook::get()->count();
        $searchTerm = '%'.$this->search.'%';
        if($this->search) {
            $issueBooks = ModelsIssueBook::where('book_name','LIKE',$searchTerm)->orderBy('created_at','DESC')->paginate(5);
        }else{
            $issueBooks = ModelsIssueBook::orderBy('created_at','DESC')->paginate(5);
        }
        return view('livewire.issue-book',compact('issueBooks','nbrIssueBook','books','students'))->layout('layout.app');
    }
    public function showForm()
    {
        $this->showTable = false;
        $this->showForm = true;
        $this->updateForm = false;
        // $this->student_id = 0;
        empty($this->student_id);
        // $this->book_id = 0;
        empty($this->book_id);
    }
    public function store()
    {
        $return_days = 30;
        $validate = $this->validate([
            'student_id'=> ['required'],
            'book_id'=> ['required']
        ]);
        // $result = ModelsIssueBook::create($validate);
        $issueBook = new ModelsIssueBook;
        $issueBook->student_id = $this->student_id;
        $issueBook->book_id = $this->book_id;
        $issueBook->issue_date = date("Y-m-d");
        // strtotime("+".$return_days."months")  ===> to add 'days/months/years' to a date
        $issueBook->return_date = date("Y-m-d",strtotime("+".$return_days."days"));
        $result = $issueBook->save();
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
        $result = ModelsIssueBook::findORFail($id)->delete();
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
        $book = ModelsIssueBook::findORFail($id);
        // $this->edit_book_name=$book->book_name;
        $this->updatedBookId=$book->id;

        $this->student_id = $book->student_id;

        $this->book_id = $book->book_id;
        $this->dateIssue = $book->issue_date;
        $this->dateReturn = $book->return_date;

        // dd($book->id);
        $this->showTable = false;
        $this->updateForm = true;
        // $this->updatedbook = "";


    }
    public function updateBook($id)
    {
        // return redirect()->route("book");
        // dd($req->input("edit_book_name"));
        $book = ModelsIssueBook::find($id);
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
