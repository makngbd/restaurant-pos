<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user = new \App\User([
            'email' => 'mak@gmail.com',
            'password' => bcrypt('khan')
        ]);
        $user->save();
    }

}
