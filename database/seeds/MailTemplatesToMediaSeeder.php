<?php

use Illuminate\Database\Seeder;

class MailTemplatesToMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tmpPath = public_path("uploads");
        $synchronizer = new App\Drivers\FolderToDb\Synchronizer();
        $directories = $synchronizer->synchronizeWithFiles($tmpPath);


//        $tmpPath = public_path("uploads/");
//        $displayFiles = [];
//        foreach (\File::allFiles($tmpPath) as $file) {
//            $path = $file->getRelativePath();
//            $media = \MediaUploader::importPath("local", $path . "/" . $file->getFilename());
//            $displayFiles["path"][] = $path;
//            $path = explode("/", $file->getRelativePath());
//            $displayFiles["folder"][] = $path[count($path) - 1];
//        }
//        $uniquePathFolders = array_unique($displayFiles["path"]);
//        $uniqueFolders = array_unique($displayFiles["folder"]);
//
//        $mailsFolder = \App\Core\Models\Folder::create(["name" => "mails", "path_on_disk" => "mails"]);
//        $personalFolder = $mailsFolder->create(["name" => "personal", "path_on_disk" => "mails/personal"]);
//        $defaultFolder = $mailsFolder->children()->create(["name" => "default", "path_on_disk" => "mails/default"]);
//
//        foreach (\File::directories($tmpPath) as $folder) {
//            echo $folder . "\n";
//        }
//
//        foreach ($uniqueFolders as $key => $folder) {
////            echo "folder - " . $folder . " | created \n";
//            if (\App\Core\Models\Folder::where("name", $folder)->count() == 0) {
//                $directory = $defaultFolder->children()->create(["name" => $uniqueFolders[$key], "path_on_disk" => $uniquePathFolders[$key]]);
//                foreach (\App\Core\Models\Media::all() as $item) {
//                    if ($item->directory == $uniquePathFolders[$key]) {
//                        $item->directory_id = $directory->id;
//                        $item->save();
//                    }
//                }
//            } else {
//
//            }
//        }
//    }
    }
}
