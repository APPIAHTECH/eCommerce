<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= array(
            [
                'name'=>'Stephen',
                'last_name' => 'Appiah Frimpong',
                'email'=>'eunisaesea@gmail.com',
                'user'=>'monsterkrod',
                'password'=>\Hash::make('123456'),
                'type'=>'admin',
                'active'=>1,
                'adress'=>'Av Font menor. Simat de la valldigna',
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime
            ],
            [
                'name'=>'Adela',
                'last_name' => 'Torres Blanc',
                'email'=>'atblanc@gmail.com',
                'user'=>'atblanc',
                'password'=>\Hash::make('123$%&'),
                'type'=>'user',
                'active'=>1,
                'adress'=>'Martí l`Humà. València',
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime
            ]
        );
        User::insert($data);
    }
}
