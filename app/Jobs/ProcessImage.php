<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\File;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ProcessImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $fileName;
    private $quality = 75;
    private $path;

    /**
     * Create a new job instance.
     */
    public function __construct($path, $fileName)
    {

        $this->fileName = $fileName;
        $this->path = $path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $file = file_get_contents($this->path);
        $uploadedFile = imagecreatefromstring($file);


        $size = getimagesize($this->path);

        $width = $this->getResize($size[0]);
        $height = $this->getResize($size[1]);

        $thumb = imagecreatetruecolor($width, $height);
        imagecopyresampled($thumb, $uploadedFile, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
        imagejpeg($thumb, storage_path('app/').$this->fileName, $this->quality);
        imagedestroy($thumb);
        imagedestroy($uploadedFile);

        #overwrite full image with resize
        $img = Crypt::encrypt(file_get_contents(storage_path('app/').$this->fileName));
        Storage::put($this->fileName, $img);
    }

    /**
     * @param $size
     * @return int
     */
    private function getResize($size) : int
    {
        return (int) ceil($size / 8);
    }
}
