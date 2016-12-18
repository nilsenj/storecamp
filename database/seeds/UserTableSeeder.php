<?php

use Illuminate\Database\Seeder;
use App\Core\Entities\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        $user = User::UpdateOrCreate([
            'name' => 'moes',

            'email' => 'mmoes@combird.nl',

            'password' => 'moes-dev-01'
        ]);

        $user->attachRole(1);

        $user = User::UpdateOrCreate([
            'name' => 'nilsenj',

            'email' => 'nikoleivan@gmail.com',

            'password' => 'nilsenj-dev-01'
        ]);

        $user->attachRole(2);
    }
}
