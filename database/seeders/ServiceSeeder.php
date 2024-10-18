<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $activity_log_service)
    {
        $services = array(

            // Vaccines
            [
                'id' => 1,
                'service_category_id' => 1,
                'name' => '5 in 1 Vaccine',
                'description' => "A combinationvaccine thatprotects dogs fromdistemper,hepatitis,parvovirus,parainfluenza, andleptospirosis.",
                'fee' => "₱300",
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'service_category_id' => 1,
                'name' => 'Rabbies vaccine',
                'description' => "A single-dosevaccine thatprotects pets andhumans from thedeadly rabies virus..
                ",
                'fee' => "₱120",
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'service_category_id' => 1,
                'name' => 'Kennel cough vaccine',
                'description' => "Prevents dogs fromcontracting thehighly contagiousrespiratory diseaseknown as kennelcough",
                'fee' => "₱320",
                'created_at' => now(),
            ],
            [
                'id' => 4,
                'service_category_id' => 1,
                'name' => 'Feline vaccine or 4 in 1 ',
                'description' => "A vaccine for catsthat guards againstrhinotracheitis,calicivirus,panleukopenia, andchlamydia.",
                'fee' => "₱650",
                'created_at' => now(),
            ],

            // Deworming
            [
                'id' => 5,
                'service_category_id' => 2,
                'name' => 'Drontal Pluswormrid andalbendazole',
                'description' => "A dewormingtreatment thateffectively removesa variety of internalparasites in pets.",
                'fee' => "₱50",
                'created_at' => now(),
            ],
            [
                'id' => 6,
                'service_category_id' => 2,
                'name' => 'Simparica',
                'description' => "An oral tablet thatprovides longlasting protectionagainst fleas andticks in dogs.",
                'fee' => "₱385",
                'created_at' => now(),
            ],

            // Surgery
            [
                'id' => 7,
                'service_category_id' => 3,
                'name' => 'Spay Surgery - Dog',
                'description' => "A surgicalprocedure toremove thereproductive organsof female animals,preventingpregnancy.",
                'fee' => "₱2700",
                'created_at' => now(),
            ],
            [
                'id' => 8,
                'service_category_id' => 3,
                'name' => 'Spay Surgery - Cat',
                'description' => "A surgicalprocedure toremove thereproductive organsof female animals,preventingpregnancy.",
                'fee' => "₱2200",
                'created_at' => now(),
            ],
            [
                'id' => 9,
                'service_category_id' => 3,
                'name' => 'Neauter Surgery - Dog',
                'description' => "A surgicalprocedure toremove the testiclesof male animals,preventingreproduction.",
                'fee' => "₱1500",
                'created_at' => now(),
            ],
            [
                'id' => 10,
                'service_category_id' => 3,
                'name' => 'Neauter Surgery - Cat',
                'description' => "A surgicalprocedure toremove the testiclesof male animals,preventingreproduction.",
                'fee' => "₱900",
                'created_at' => now(),
            ],
            [
                'id' => 11,
                'service_category_id' => 3,
                'name' => 'Eye enucleation',
                'description' => "Surgical removal ofa damaged orinfected eye toprevent furthercomplications.",
                'fee' => "₱2500",
                'created_at' => now(),
            ],
            [
                'id' => 12,
                'service_category_id' => 3,
                'name' => 'Hematoma Repair',
                'description' => "A procedure todrain and repairblood accumulationin the ear, typicallycaused by trauma.",
                'fee' => "₱2500",
                'created_at' => now(),
            ],
            [
                'id' => 13,
                'service_category_id' => 3,
                'name' => 'Cherry Eye Correction',
                'description' => "A surgery toreposition the glandof the third eyelid,commonly knownas 'cherry eye' indogs.",
                'fee' => "₱2500",
                'created_at' => now(),
            ],
            [
                'id' => 14,
                'service_category_id' => 3,
                'name' => 'CS Surgery',
                'description' => "A cesarean sectionto safely deliverpuppies or kittenswhen natural birthis not possible.",
                'fee' => "₱12000",
                'created_at' => now(),
            ],
        );

        Service::insert($services);

        Service::all()->each(function($service) use($activity_log_service) {
            // $service
            // ->addMedia(public_path("/img/image_not_found.svg"))
            // ->preservingOriginal()
            // ->toMediaCollection('service_images');
            // $service
            // ->addMedia(public_path("/tmp_files/services/$service->id.jpg"))
            // ->preservingOriginal()
            // ->toMediaCollection('service_images');

            $activity_log_service->log_activity(model:$service, event:'added', model_name: 'Service', model_property_name: $service->name);
        });
    }
}