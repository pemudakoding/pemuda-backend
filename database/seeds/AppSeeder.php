<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('apps')->insert(
            [
                'app_name'  => 'Shayna Shop',
                'logo'      => '',
                'email'     => 'pemudakoding@gmail.com',
                'number'    => '0851-5542-9967',
                'address'   => 'Jl Kedondong 2, Palu,Palu Barat',
                'facebook'  => 'https://facebook.com/127.0.0.1.id',
                'instagram' => 'https://instagram.com/PemudaKoding',
                'twitter'   => 'https://twitter.com/PengetikExpress',
            ]
        );
    }
}
