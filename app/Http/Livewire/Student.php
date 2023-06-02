<?php

namespace App\Http\Livewire;

use App\Models\Student as ModelsStudent;
use Livewire\Component;

class Student extends Component
{
    public $showTable = true;
    public $showForm = false;
    public $updateForm = false;
    public $updatedStudentId = "";
    // from the input
    public $search;
    
    // from the input of add Student
    public $name;
    public $email;
    public $address;
    public $phone;
    public $classes;
    public $gender;
    // from the input of update Student
    public $edit_student_name = "";
    public $edit_student_email = "";
    public $edit_student_address = "";
    public $edit_student_phone = "";
    public $edit_student_classes = "";
    public $edit_student_gender = "";

    public function render()
    {
        $nbrStudent = ModelsStudent::get()->count();
        $searchTerm = '%'.$this->search.'%';
        if($this->search) {
            $students = ModelsStudent::where('name','LIKE',$searchTerm)->orderBy('created_at','DESC')->paginate(5);
        }else{
            $students = ModelsStudent::orderBy('created_at','DESC')->paginate(5);
        }
        return view('livewire.student',compact('students','nbrStudent'))->layout('layout.app');
    }
    public function showForm()
    {
        $this->showTable = false;
        $this->showForm = true;
        $this->updateForm = false;
    }
    public function store()
    {
        $validate = $this->validate([
            'name'=> ['required','string'],
            'email'=> ['required'],
            'address'=> ['required'],
            'gender'=> ['required'],
            'phone'=> ['required'],
            'classes'=> ['required']
        ]);
        $result = ModelsStudent::create($validate);
        if($result){
            session()->flash('success','Student Added Successfully');
            $this->showTable = true;
            $this->showForm = false;
            $this->name = '';
            $this->email = '';
            $this->address = '';
            $this->gender = '';
            $this->phone = '';
            $this->classes = '';
        }else{
            session()->flash('error','Student Not Added');
        }
    }
    public function deleteStudent($id)
    {
        $result = ModelsStudent::findORFail($id)->delete();
        ($result)
        ? session()->flash('success','Student Deleted Successfully')
        : session()->flash('error','Student Not Deleted');
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
        $student = ModelsStudent::findORFail($id);
        $this->edit_student_name=$student->name;
        $this->edit_student_email=$student->email;
        $this->edit_student_address=$student->address;
        $this->edit_student_phone=$student->phone;
        $this->edit_student_classes=$student->classes;
        $this->edit_student_gender=$student->gender;
        $this->updatedStudentId=$student->id;

        /* $this->category_id = $book->category_id;
        $this->publisher_id = $book->publisher_id;
        $this->author_id = $book->author_id; */

        $this->showTable = false;
        $this->updateForm = true;


    }
    public function updateStudent($id)
    {
        // return redirect()->route("book");
        // dd($req->input("edit_student_name"));
        $student = ModelsStudent::find($id);
        $edited_student = $this->validate([
            'edit_student_name' => ['required','string'],
            'edit_student_email'=> ['required'],
            'edit_student_address'=> ['required'],
            'edit_student_phone'=> ['required'],
            'edit_student_classes'=> ['required'],
            'edit_student_gender'=> ['required']
        ]);
        // dd($edited_student['edit_student_name']);
        $student->name = $this->edit_student_name;
        $student->email = $this->edit_student_email;
        $student->address = $this->edit_student_address;
        $student->phone = $this->edit_student_phone;
        $student->classes = $this->edit_student_classes;
        $student->gender = $this->edit_student_gender;

        // $student->student_name = $edited_student['edit_student_name'];
        $result = $student->save();
        if($result){
            session()->flash('success','Student Updated Successfully');
            $this->showTable = true;
            $this->updateForm = false;
        }else{ 
            session()->flash('error','Student Not Updated');
         } 

    }
}
