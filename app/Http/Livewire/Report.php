<?php

namespace App\Http\Livewire;

use App\Models\IssueBook;
use Livewire\Component;


class Report extends Component
{
    public $dateReport;
    public $reports;
    
    public function mount()
    {
        $this->dateReport = date('Y-m-d');
    }
    public function render()
    {
        
        return view('livewire.report')->layout('layout.app');
        // return view('livewire.report');
    }
    public function getDateReport()
    {
        $issueBook = IssueBook::whereDate('created_at',$this->dateReport)->orderBy('id','DESC')->get();
        // dd($issueBook);
        $this->reports = $issueBook;
    }
}
