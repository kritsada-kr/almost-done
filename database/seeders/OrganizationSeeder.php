<?php

namespace Database\Seeders;

use App\Models\OrganizationTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $organizationTag = OrganizationTag::first();
        if (!$organizationTag) {
            $this->command->line("Generating Organizations");
            $organizationTags = ['สำนักทะเบียนและประมวลผล', 'สำนักบริหารการศึกษา', 'สำนักงานมหาวิทยาลัย',
                'สำนักส่งเสริมและฝึกอบรม', 'สำนักบริการคอมพิวเตอร์', 'สำนักหอสมุด', 'สำนักงานสภามหาวิทยาลัยเกษตรศาสตร์',
                'สถานพยาบาลมหาวิทยาลัยเกษตรศาสตร์', 'อื่นๆ'];
            collect($organizationTags)->each(function ($organizationTag_name, $key) {
                $organizationTag = new OrganizationTag();
                $organizationTag->name = $organizationTag_name;
                $organizationTag->save();
            });
        }
    }
}
