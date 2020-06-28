<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FoldersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user = DB::table('users')->first();

        $tities = ['プライベート', '仕事', '旅行'];

        foreach ($tities as $title) {
            DB::table('folders')->insert([
                'title'      => $title,
                'user_id'    => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
