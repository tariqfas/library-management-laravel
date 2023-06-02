<?php

namespace App\Http\Livewire;

use App\Models\Publisher as ModelsPublisher;
use Livewire\Component;

class Publisher extends Component
{
    public $showTable = true;
    public $createForm = false;
    public $updateForm = false;
    public $edit_publisher_name = "";
    public $updatedPublisherId = "";
    public $search;
    public $publisher_name;
    public function render()
    {
        $nbrPublisher = ModelsPublisher::get()->count();
        $searchTerm = '%'.$this->search.'%';
        if($this->search) {
            $publishers = ModelsPublisher::where('publisher_name','LIKE',$searchTerm)->orderBy('created_at','DESC')->paginate(5);
        }else{
            $publishers = ModelsPublisher::orderBy('created_at','DESC')->paginate(5);
        }
        return view('livewire.publisher',compact('publishers','nbrPublisher'))->layout('layout.app');
    }
    public function showForm()
    {
        $this->showTable = false;
        $this->createForm = true;
    }
    public function searchPublisher()
    {
        
    }
    public function store()
    {
        $validate = $this->validate([
            'publisher_name'=> ['required','string','unique:publishers']
        ]);
        $result = ModelsPublisher::create($validate);
        if($result){
            session()->flash('success','Publisher Added Successfully');
            $this->showTable = true;
            $this->createForm = false;
            $this->publisher_name = '';
        }else{
            session()->flash('error','Publisher Not Added');
        }
    }
    public function deletePublisher($id)
    {
        $result = ModelsPublisher::findORFail($id)->delete();
        ($result)
        ? session()->flash('success','Publisher Delete Successfully')
        : session()->flash('error','Publisher Not Delete Successfully');
        /* if($result){
            session()->flash('success','Publisher Delete Successfully');
        }else{
            session()->flash('error','Publisher Not Delete Successfully');
        } */
    }
    public function cancel()
    {
        
        $this->updateForm = false;
        $this->createForm = false;
        $this->showTable = true;
    }
    public function editForm($id)
    {
        $publisher = ModelsPublisher::findORFail($id);
        $this->edit_publisher_name=$publisher->publisher_name;
        $this->updatedPublisherId=$publisher->id;
        // dd($publisher->id);
        $this->showTable = false;
        $this->updateForm = true;
        // $this->updatedpublisher = "";


    }
    public function updatePublisher($id)
    {
        // return redirect()->route("book");
        // dd($req->input("edit_publisher_name"));
        $publisher = ModelsPublisher::find($id);
        $edited_publisher = $this->validate([
            'edit_publisher_name' => ['required','string']
        ]);
        // dd($edited_publisher['edit_publisher_name']);
        $publisher->publisher_name = $this->edit_publisher_name;
        // $publisher->publisher_name = $edited_publisher['edit_publisher_name'];
        $result = $publisher->save();
        if($result){
            session()->flash('success','Publisher Updated Successfully');
            $this->showTable = true;
            $this->updateForm = false;
        }else{ 
            session()->flash('error','Publisher Not Updated');
         } 

    }
    
}
