<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SubscriptionArea;
use App\Models\Employee;
use App\Models\Subscriber;
class ReportTable extends Component
{

    public $reportType;


    public function render()
    {
        return view('livewire.report-table',[
            'areas' => SubscriptionArea::all(),
            'employees' => Employee::all(),
            'subscribers' => Subscriber::all(),
        ]);
    }


    public function selectReportType($reportType)
    {
        $this->reportType = $reportType;
    }
}
