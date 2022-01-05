<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = [
            ['name'=>'sujan', 'subject'=>'cse', 'division'=>'Evening'],
            ['name'=>'shimul', 'subject'=>'software', 'division'=>'morning'],
            ['name'=>'manik', 'subject'=>'it', 'division'=>'day'],
            ['name'=>'himon', 'subject'=>'computer', 'division'=>'day night'],
        ];


        Student::insert($student);
    }
}
