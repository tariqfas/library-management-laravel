<?php

namespace App\Http\Livewire;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\IssueBook;
use App\Models\Publisher;
use App\Models\Student;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $countAuthors = Author::get()->count();
        $countBooks = Book::get()->count();
        $countCategories = Category::get()->count();
        $countPublishers = Publisher::get()->count();
        $countStudents = Student::get()->count();
        $countIssueBook = IssueBook::get()->count();
        return view('livewire.dashboard',compact('countAuthors','countBooks','countCategories','countPublishers','countStudents','countIssueBook'))->layout('layout.app');
    }
}
