<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Announcement;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\Watermark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CreateAnnouncement extends Component
{
    use WithFileUploads;


    public $temporary_images;

    public $images = [];

    #[Rule('required')]
    public $title;

    #[Rule('required')]
    public $description;

    #[Rule('required')]
    public $price;

    #[Rule('required')]
    public $category;

    public $categories;


    public function mount()
    {
        $this->categories = \App\Models\Category::all();
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required|max:5000',
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
        

        //se lutente che crea l'annuncio è admin o revisore lannuncio risultera gia revisionato, e andra nella pagina degli annunci 
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'revisor') {
            // se admin o revisore 
            $announcement = Announcement::create([
                'title' => $this->title,
                'description' => $this->description,
                'price' => $this->price,
                'category' => $this->category,
                'is_accepted' => true,
            ]);
        } else {
            // se user semplice
            $announcement = Announcement::create([
                'title' => $this->title,
                'description' => $this->description,
                'price' => $this->price,
                'category' => $this->category,
            ]);
        }


        //allega all'annuncio creato "category_id" e "user_id" dell'utende in questione
        $announcement->category_id = $this->category;
        $announcement->user_id = auth()->user()->id;
        $announcement->save();

        //immagini
        if (count($this->images)) {
            foreach ($this->images as $image) {
                // $announcement->images()->create(['path' => $image->store('images', 'public')]);
                $newFileName = "announcements/{$announcement->id}";
                $newImage = $announcement->images()->create(['path' => $image->store($newFileName, 'public')]);

                /* RemoveFaces::withChain([
                    new Watermark($newImage->id),
                    new ResizeImage($newImage->path, 1200, 1200),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id)
                ])->dispatch($newImage->id); */
                 dispatch(new ResizeImage($newImage->path, 1200, 1200)); // da usare nel caso in cui bloccano GoogleVision
            }

            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        //resetta i campi del form
        $this->newUser();

        session()->flash('success', __('ui.AnnCorrect'));
        // $update = $this->only('title', 'description', 'price', 'image');
        // Announcement::create($this->only('title', 'description', 'price', 'image'));
    }


    public function updatedTemporaryImages()
    {
        if ($this->validate([
            'temporary_images' => 'required|array|min:1',
        ], [
            'temporary_images.required' => __('ui.tempImgReq'),
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
    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }

    //richiamandola resetta i campi del form
    public function newUser()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category = '';
        $this->images = [];
        $this->temporary_images = [];
    }


    public function render()
    {
        return view('livewire.create-announcement');
    }
}
