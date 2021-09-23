<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Category;
use App\Models\Diagnosis;
use App\Models\Discharge;
use App\Models\Drug;
use App\Models\Formulation;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Schema::disableForeignKeyConstraints();

        User::truncate();
        Patient::truncate();
        Discharge::truncate();
        Diagnosis::truncate();
        Category::truncate();
        Drug::truncate();
        Formulation::truncate();
        Bill::truncate();

        DB::table('drug_formulation')->delete();
        DB::table('bill_drug')->delete();

        Schema::enableForeignKeyConstraints();

        User::flushEventListeners();
        Patient::flushEventListeners();
        Discharge::flushEventListeners();
        Diagnosis::flushEventListeners();
        Category::flushEventListeners();
        Drug::flushEventListeners();
        Formulation::flushEventListeners();
        Bill::flushEventListeners();


        $usersQuantity = 5;
        $patientsQuantity = 20;
        $formulationsQuantity = 10;
        $drugsQuantity = 30;
        $dischargesQuantity = 10;
        $diagnosisQuantity = 10;
        $categoriesQuantity = 5;
        $billsQuantity = 25;

        User::factory($usersQuantity)->create();
        Patient::factory($patientsQuantity)->create();
        Discharge::factory($dischargesQuantity)->create();
        Diagnosis::factory($diagnosisQuantity)->create();
        Category::factory($categoriesQuantity)->create();
        Formulation::factory($formulationsQuantity)->create();
        Bill::factory($billsQuantity)->create();
        Drug::factory($drugsQuantity)->create()->each(
            function($drug){
                $formulations = Formulation::all()->random(mt_rand(1, 3))->pluck('id');
                $drug->formulations()->attach($formulations);

                $bills = Bill::all()->random(mt_rand(1, 5))->pluck('id');
                $drug->bills()->attach($bills);
            }
        );

    }
}
