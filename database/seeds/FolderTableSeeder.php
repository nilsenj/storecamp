<?php

use Illuminate\Database\Seeder;

class FolderTableSeeder extends Seeder
{
    public function run()
    {
        \App\Core\Models\Folder::create([
            'name' => '',
            'parent_id' => null,
            'locked' => true
        ]);

        \App\Core\Models\Folder::create([
            'name' => '',
            'parent_id' => null,
            'disk' => 'mails',
            'locked' => true
        ]);
    }
}
