<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use Livewire\Component;

class Category extends Component
{
    public $showTable = true;
    public $showForm = false;
    public $updateForm = false;
    public $category_name = "";
    public $edit_category_name = "";
    public $updatedCategoryId;
    public $searchCategory;
    public function render()
    {
        $nbrCategories = ModelsCategory::get()->count();
        // $categories = ModelsCategory::get();
         $searchTerm = '%'.$this->searchCategory.'%';
        if($this->searchCategory) {
            $categories = ModelsCategory::where('category_name','LIKE',$searchTerm)->orderBy('created_at','DESC')->paginate(5);
        }else{
            $categories = ModelsCategory::orderBy('created_at','DESC')->paginate(5);
        }
        return view('livewire.category',compact('categories','nbrCategories'))->layout('layout.app');
    }
    public function showForm()
    {
        // dd($this);
        $this->showForm = true;
        $this->showTable = false;
    }
    public function store()
    {
        //
        $validate = $this->validate([
            'category_name' => ['required','unique:categories']
        ]);
        // dd($validate);
        $result = ModelsCategory::create($validate);
        if($result)
        {
            session()->flash('success','Category Added Successfully');
        }else{
            session()->flash('error','Category Not Added');
        }
        $this->showForm = false;
        $this->showTable = true;
        /* if($result)
        {
            dd("hello");
        } */
    }
    public function edit($id)
    {
        $this->updateForm = true;
        $this->showTable = false;
        $category = ModelsCategory::findORFail($id);
        $this->updatedCategoryId = $category->id;
        $this->edit_category_name = $category->category_name;
    }
    public function updateCategory($id)
    {
        $category = ModelsCategory::find($id);
        $this->validate([
            'edit_category_name' => ['required','string','unique:categories']
        ]);
        $category->category_name = $this->edit_category_name;
        $result = $category->save();
        if($result)
        {
            session()->flash('success','Category Updated Successfully');
            $this->updateForm = false;
            $this->showTable = true;
        }else{
            session()->flash('error','Category Not Updated');
        }

    }
    public function cancel()
    {
        $this->updateForm = false;
        $this->showForm = false;
        $this->showTable = true;
    }
    public function delete($id)
    {
        $result = ModelsCategory::findORFail($id)->delete();
        ($result)
        ? session()->flash('success','Category Deleted Successfully')
        : session()->flash('error','Category Not Deleted');
    }
}
