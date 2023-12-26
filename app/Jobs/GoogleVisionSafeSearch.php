<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GoogleVisionSafeSearch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $announcement_image_id;
    /**
     * Create a new job instance.
     */
    public function __construct($announcement_image_id)
    {
        $this->announcement_image_id = $announcement_image_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //predniamo l'img. dallo storage
        $i = Image::find($this->announcement_image_id);

        //se non la trova termina lesecuzione del job
        if(!$i){
            return;
        }

        //ricuperimao il file 
        $image = file_get_contents(storage_path('app/public/' . $i->path));

        /* imposta la variabile di ambiente  GOOGLE_APPLICATION_CREDENTIALS al path del credentials file*/
        /* GOOGLE_APPLICATION_CREDENTIALS conterra le credenziali per entrare nel servizio google, 
        credenziali che sono scritte in google_credential.json, file scaricato a parte*/
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));
        
        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->safeSearchDetection($image);
        $imageAnnotator->close();

        //respons sull'immagine, con adult, spoof, medical, violence o racy in percentuale
        $safe = $response->getSafeSearchAnnotation();

        //percentuali singole
        $adult = $safe->getAdult();
        $medical = $safe->getMedical();
        $spoof = $safe->getSpoof();
        $violence = $safe->getViolence();
        $racy = $safe->getRacy();

        /* conterra un valore da 0 a 5 (id aray) piu il numero è alto piu ci sara possibilita 
        di immagini non idonee */
        //0 unknown, 1 very unlikely, 2 unlikely, 3 possible, 4 likely, 5 and very likely
        //classi di bootstrap
        $likelihoodName = [
            'text-secondary fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle',
            'text-warning fas fa-circle', 'taxt-warning fas fa-circle', 'text-danger fas fa-circle'
        ];

        $i->adult = $likelihoodName[$adult];
        $i->medical = $likelihoodName[$medical];
        $i->spoof = $likelihoodName[$spoof];
        $i->violence = $likelihoodName[$violence];
        $i->racy= $likelihoodName[$racy];

        //salvataggio nel DataBase
        $i->save();
    }
}
