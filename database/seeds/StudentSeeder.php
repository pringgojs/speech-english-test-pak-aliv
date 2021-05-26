<?php

use App\User;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Andrew K. Elvin',
                'identity_number' => 'S0009',
                'user_id' => 2,
                'password' => strtolower('Andrew')
            ],
            [
                'name' => 'Sativa O. Rize',
                'identity_number' => 'S0008',
                'user_id' => 3,
                'password' => strtolower('Sativa')
            ]
        ];
        
        foreach ($data as $key => $value) {
            
            $user = User::insert([
                'name' => $value['name'],
                'username' => strtolower(explode(' ', $value['name'])[0]),
                'email' => strtolower(explode(' ', $value['name'])[0]).'@gmail.com',
                'password' => bcrypt(strtolower(explode(' ', $value['name'])[0])),
            ]);

            
            $users = User::where('id', '>', 1)->get();
            foreach ($users as $key => $user) {
                $user->attachRole(2);
                
            }
            Student::insert($value);
        }
        
        
    }
}
