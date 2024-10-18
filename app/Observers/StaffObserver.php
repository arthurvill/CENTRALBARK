<?php

namespace App\Observers;

use App\Models\Staff;
use App\Services\ActivityLogsService;

class StaffObserver
{
    protected $service;

    public function __construct(ActivityLogsService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Handle the Staff "created" event.
     *
     * @param  \App\Models\Staff  $staff
     * @return void
     */
    public function created(Staff $staff)
    {
        $this->service->log_activity(model:$staff, event:'added', model_name:'Staff', model_property_name: $staff->full_name);
    }

    /**
     * Handle the Staff "updated" event.
     *
     * @param  \App\Models\Staff  $staff
     * @return void
     */
    public function updated(Staff $staff)
    {
        $this->service->log_activity(model:$staff, event:'updated', model_name:'Staff', model_property_name: $staff->full_name);
    }

    /**
     * Handle the Staff "deleted" event.
     *
     * @param  \App\Models\Staff  $staff
     * @return void
     */
    public function deleted(Staff $staff)
    {
        $this->service->log_activity(model:$staff, event:'deleted', model_name:'Staff', model_property_name: $staff->full_name);
    }

    /**
     * Handle the Staff "restored" event.
     *
     * @param  \App\Models\Staff  $staff
     * @return void
     */
    public function restored(Staff $staff)
    {
        //
    }

    /**
     * Handle the Staff "force deleted" event.
     *
     * @param  \App\Models\Staff  $staff
     * @return void
     */
    public function forceDeleted(Staff $staff)
    {
        //
    }
}