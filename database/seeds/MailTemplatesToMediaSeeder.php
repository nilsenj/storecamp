<?php

use Illuminate\Database\Seeder;

class MailTemplatesToMediaSeeder extends Seeder
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
        $uploadsPath = public_path("uploads");
        $mailsPath = public_path("mails");
        $this->synchronizer->synchronizeWithFiles($uploadsPath, "local");
        $this->synchronizer->synchronizeWithFiles($mailsPath, "mails");
    }
}
