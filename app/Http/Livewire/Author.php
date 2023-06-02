<?php

namespace App\Http\Livewire;

use App\Models\Author as ModelsAuthor;
use Illuminate\Http\Request;
use Livewire\Component;

class Author extends Component
{
    public $showTable = true;
    public $createForm = false;
    public $updateForm = false;
    public $edit_author_name = "";
    public $updatedAuthorId = "";
    public $search;
    public $author_name;
    public function render()
    {
        $nbrAuthor = ModelsAuthor::get()->count();
        $searchTerm = '%'.$this->search.'%';
        if($this->search) {
            $authors = ModelsAuthor::where('author_name','LIKE',$searchTerm)->orderBy('created_at','DESC')->paginate(5);
        }else{
            $authors = ModelsAuthor::orderBy('created_at','DESC')->paginate(5);
        }
        return view('livewire.author',compact('authors','nbrAuthor'))->layout('layout.app');
    }
    public function showForm()
    {
        $this->showTable = false;
        $this->createForm = true;
    }
    public function searchAuthor()
    {
        
    }
    public function store()
    {
        $validate = $this->validate([
            'author_name'=> ['required','string','unique:authors']
        ]);
        $result = ModelsAuthor::create($validate);
        if($result){
            session()->flash('success','Author Add Successfully');
            $this->showTable = true;
            $this->createForm = false;
            $this->author_name = '';
        }else{
            session()->flash('error','Author Not Add Successfully');
        }
    }
    public function deleteAuthor($id)
    {
        $result = ModelsAuthor::findORFail($id)->delete();
        ($result)
        ? session()->flash('success','Author Delete Successfully')
        : session()->flash('error','Author Not Delete Successfully');
        /* if($result){
            session()->flash('success','Author Delete Successfully');
        }else{
            session()->flash('error','Author Not Delete Successfully');
        } */
    }
    public function cancel()
    {
        $this->showTable = true;
        $this->updateForm = false;
    }
    public function editForm($id)
    {
        $author = ModelsAuthor::findORFail($id);
        $this->edit_author_name=$author->author_name;
        $this->updatedAuthorId=$author->id;
        // dd($author->id);
        $this->showTable = false;
        $this->updateForm = true;
        // $this->updatedAuthor = "";


    }
    public function updateAuthor($id)
    {
        // return redirect()->route("book");
        // dd($req->input("edit_author_name"));
        $author = ModelsAuthor::find($id);
        $edited_author = $this->validate([
            'edit_author_name' => ['required','string']
        ]);
        // dd($edited_author['edit_author_name']);
        $author->author_name = $this->edit_author_name;
        // $author->author_name = $edited_author['edit_author_name'];
        $result = $author->save();
        if($result){
            session()->flash('success','Author Update Successfully');
            $this->showTable = true;
            $this->updateForm = false;
        }else{ 
            session()->flash('error','Author Not Update');
         } 

    }
}
