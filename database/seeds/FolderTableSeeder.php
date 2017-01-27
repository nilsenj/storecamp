<?php

use Illuminate\Database\Seeder;

class FolderTableSeeder extends Seeder
{
    protected $synchronizer;
    public function __construct(\App\Drivers\FolderToDb\Synchronizer $synchronizer)
    {
        $this->synchronizer = $synchronizer;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
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

        $uploadsPath = public_path("uploads");
        $this->synchronizer->synchronizeWithFiles($uploadsPath, "local");
    }
}
