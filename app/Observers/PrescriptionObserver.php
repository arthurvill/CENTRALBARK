<?php

namespace App\Observers;

use App\Models\Prescription;
use App\Services\ActivityLogsService;

class PrescriptionObserver
{
    protected $service;

    public function __construct(ActivityLogsService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Handle the Prescription "created" event.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return void
     */
    public function created(Prescription $prescription)
    {
        $this->service->log_activity(model:$prescription, event:'added', model_name:'Prescription', model_property_name: $prescription->drug);
    }

    /**
     * Handle the Prescription "updated" event.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return void
     */
    public function updated(Prescription $prescription)
    {
        $this->service->log_activity(model:$prescription, event:'updated', model_name:'Prescription', model_property_name: $prescription->drug);
    }

    /**
     * Handle the Prescription "deleted" event.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return void
     */
    public function deleted(Prescription $prescription)
    {
        $this->service->log_activity(model:$prescription, event:'deleted', model_name:'Prescription', model_property_name: $prescription->drug);
    }

    /**
     * Handle the Prescription "restored" event.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return void
     */
    public function restored(Prescription $prescription)
    {
        //
    }

    /**
     * Handle the Prescription "force deleted" event.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return void
     */
    public function forceDeleted(Prescription $prescription)
    {
        //
    }
}