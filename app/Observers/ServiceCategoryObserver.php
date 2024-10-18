<?php

namespace App\Observers;

use App\Models\ServiceCategory;
use App\Services\ActivityLogsService;

class ServiceCategoryObserver
{
    protected $service;

    public function __construct(ActivityLogsService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Handle the ServiceCategory "created" event.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return void
     */
    public function created(ServiceCategory $serviceCategory)
    {
        $this->service->log_activity(model:$serviceCategory, event:'added', model_name:'Service Category', model_property_name: $serviceCategory->name);
    }

    /**
     * Handle the ServiceCategory "updated" event.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return void
     */
    public function updated(ServiceCategory $serviceCategory)
    {
        $this->service->log_activity(model:$serviceCategory, event:'updated', model_name:'Service Category', model_property_name: $serviceCategory->name);
    }

    /**
     * Handle the ServiceCategory "deleted" event.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return void
     */
    public function deleted(ServiceCategory $serviceCategory)
    {
        $this->service->log_activity(model:$serviceCategory, event:'deleted', model_name:'Service Category', model_property_name: $serviceCategory->name);
    }

    /**
     * Handle the ServiceCategory "restored" event.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return void
     */
    public function restored(ServiceCategory $serviceCategory)
    {
        //
    }

    /**
     * Handle the ServiceCategory "force deleted" event.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return void
     */
    public function forceDeleted(ServiceCategory $serviceCategory)
    {
        //
    }
}