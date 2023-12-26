<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image as SpatieImage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class Watermark implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $announcement_image_id;

    /**
     * Create a new job instance.
     */
    public function __construct($newImage)
    {
        $this->announcement_image_id = $newImage;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $i = Image::find($this->announcement_image_id);
        if (!$i) {
            return;
        }

        $srcPath = storage_path('app/public/' . $i->path);

            $image = SpatieImage::load($srcPath);

            $image->watermark(base_path('resources/img/logoB.png'))
                ->watermarkPosition('bottom-right')
                ->watermarkPadding(10, 10)
                ->watermarkWidth($image->getWidth()*0.35, Manipulations::UNIT_PIXELS)
                ->watermarkHeight($image->getHeight()*0.09, Manipulations::UNIT_PIXELS)
                ->watermarkPosition(Manipulations::POSITION_CENTER)
                ->watermarkOpacity(50)
                ->watermarkFit(Manipulations::FIT_STRETCH);
            $image->save($srcPath);
        
    }
}
