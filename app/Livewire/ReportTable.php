<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SubscriptionArea;

class ReportTable extends Component
{

    public $reportType;


    public function render()
    {
        return view('livewire.report-table',[
            'areas' => SubscriptionArea::all(),
        ]);
    }


    public function selectReportType($reportType)
    {
        $this->reportType = $reportType;
    }
}
