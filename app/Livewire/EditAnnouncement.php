<?php

namespace App\Livewire;

use App\Models\Image;
use App\Jobs\Watermark;
use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Announcement;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EditAnnouncement extends Component
{
    use WithFileUploads;


    public $temporary_images;

    public $images = [];
    public $storageImages;

    #[Rule('required')]
    public $title;

    #[Rule('required')]
    public $description;

    #[Rule('required')]
    public $price;

    #[Rule('required')]
    public $category;

    public $categories;

    //annuncio da modificare
    public $editAnnouncement;
    /* //seleziona la categoria corrente nel select
    public $categorySelected; */

    public function mount()
    {

        $this->categories = \App\Models\Category::all();
        $announcement = Announcement::find($this->editAnnouncement->id);
        


        if ($announcement) {
            $this->editAnnouncement->id = $announcement->id;
            $this->title = $announcement->title;
            $this->description = $announcement->description;
            $this->price = $announcement->price;
            $this->category = $announcement->category_id;

            // Recupera le immagini esistenti e assegnale a $this->images
            $this->storageImages = $announcement->images;
            /* //assegna a categorySelected la categoria dell'annuncio per selezionarla nel select
            $this->categorySelected = $announcement->category_id; */
            
        }
    }

    public function deleteAnnouncement(Announcement $announcement){
        $announcement->delete();
        session()->flash('success', __('ui.cancellaAnn'));
        $this->mount();
        return redirect()->route('announcement.create');
    }

    public function updateAnnouncement()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
            // 'images.*' => 'required|image'
        ], [
            'title.required' => __('ui.titReq'),
            'description.required' => __('ui.desReq'),
            'price.required' => __('ui.priReq'),
            'category.required' => __('ui.catReq'),
            // 'images.required' => __('ui.imag'),
            // 'images.image' => __('ui.imagImg'),
            // 'images.max' => __('ui.imagMax')
        ]);

        $announcement = Announcement::find($this->editAnnouncement->id);

        if ($announcement) {

            //se lutente che crea l'annuncio è admin o revisore lannuncio risultera gia revisionato, e andra nella pagina degli annunci 
            if (auth()->user()->role == 'admin' || auth()->user()->role == 'revisor') {
                // se admin o revisore 
                $announcement->update([
                    'title' => $this->title,
                    'description' => $this->description,
                    'price' => $this->price,
                    'category_id' => $this->category,
                    'is_accepted' => true,
                ]);
            } else {
                // se user semplice
                $announcement->update([
                    'title' => $this->title,
                    'description' => $this->description,
                    'price' => $this->price,
                    'category_id' => $this->category,
                    'is_accepted' => null,
                ]);
                
            }

            // ... (Codice per gestire le immagini come nella creazione)
            //allega all'annuncio creato "category_id" e "user_id" dell'utende in questione
        /* $announcement->category_id = $this->category->id; */
        /* $announcement->user_id = auth()->user()->id; */
        /* $announcement->save(); */

        //immagini
        if (count($this->images)) {
            
            foreach ($this->images as $image) {
                // $announcement->images()->create(['path' => $image->store('images', 'public')]);
                $newFileName = "announcements/{$announcement->id}";
                $newImage = $announcement->images()->create(['path' => $image->store($newFileName, 'public')]);

                RemoveFaces::withChain([
                    new Watermark($newImage->id),
                    new ResizeImage($newImage->path, 1200, 1200),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id)
                ])->dispatch($newImage->id);
            }
            /* $this->images = [];
            File::deleteDirectory(storage_path('/app/livewire-tmp'));
            $this->storageImages = $announcement->images; */
        }

            session()->flash('success', __('ui.AnnCorrect'));
            return redirect()->route('announcement.create');
        } else {
            session()->flash('error', 'qualcosa è andato storto nella modifica dell\'annuncio');
        }
    }


    public function updatedTemporaryImages()
    {
        if ($this->validate([
            'temporary_images' => 'array|min:1',/* required| */
        ], [
            /* 'temporary_images.required' => __('ui.tempImgReq'), */
            'temporary_images.array' => __('ui.tempImgReq'),
            'temporary_images.min' => __('ui.tempImgReq'),
        ])) {
            foreach ($this->temporary_images as $index => $image) {
                $this->validate([
                    "temporary_images.{$index}" => 'image|max:1024'
                ], [
                    "temporary_images.{$index}.image" => __('ui.tempImgImg'),
                    "temporary_images.{$index}.max" => __('ui.tempImgMax')
                ]);
                $this->images[] = $image;
            }
        }
        
    }

    // Rimuovi un'immagine temporanea
    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }

    public function removeStorageImage($key)
    {
        /* dd($image); */

        if ($this->storageImages->has($key)) {

            //! Path del file da eliminare
            $pathInfo = pathinfo($this->storageImages->get($key)->path);

            //? Troviamo il nome del file, partendo dal suo path
            $fileName = $pathInfo['basename'];

            //? Troviamo il nome della cartella in cui è il file e pure quella piu su (es: announcement/55) partendo dal suo path
            $folderPath = dirname($this->storageImages->get($key)->path);

            
            
            if (File::exists("storage/{$this->storageImages->get($key)->path}")) {
                File::delete("storage/{$this->storageImages->get($key)->path}");

                if (File::exists("storage/{$folderPath}/crop_1200x1200_{$fileName}")) {
                    File::delete("storage/{$folderPath}/crop_1200x1200_{$fileName}");
                }
            }

            $this->storageImages->get($key)->delete();
            $this->storageImages->forget($key);   
            
            
        }
        

    }

    public function render()
    {
        return view('livewire.edit-announcement');
    }
}
