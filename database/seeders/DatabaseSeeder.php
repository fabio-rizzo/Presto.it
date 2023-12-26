<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* 
        \App\Models\User::factory(20)->create(); */
        $this->categories();
        /* \App\Models\Announcement::factory(50)->create();*/
        $this->rols(); 
        $this->user();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
    //?create admin
    private function user(){
        \App\Models\User::create([
            'name' => 'Admin',
            'lastName' => 'ad',
            'role' => 'admin',
            'email' => 'admin@prova.com',
            'password' => 'ciaociao',
            'email_verified_at' => now()
        ]);
        \App\Models\User::create([
            'name' => 'Revisor',
            'lastName' => 'rev',
            'role' => 'revisor',
            'email' => 'revisor@prova.com',
            'password' => 'ciaociao',
            'email_verified_at' => now()
        ]);
        \App\Models\User::create([
            'name' => 'User',
            'lastName' => 'us',
            'role' => 'editor',
            'email' => 'user@prova.com',
            'password' => 'ciaociao',
            'email_verified_at' => now()
        ]);
    }
    //?create categories
    private function categories(){
        \App\Models\Category::create(['name'=>'Elettronica']);
        \App\Models\Category::create(['name'=>'Abbigliamento e Accessori']);
        \App\Models\Category::create(['name'=>'Casa e Giardino']);
        \App\Models\Category::create(['name'=>'Veicoli']);
        \App\Models\Category::create(['name'=>'Sport e Tempo Libero']);
        \App\Models\Category::create(['name'=>'Libri, Film e Musica']);
        \App\Models\Category::create(['name'=>'Arte e Collezionismo']);
        \App\Models\Category::create(['name'=>'Casa e Cucina']);
        \App\Models\Category::create(['name'=>'Giochi e Giocattoli']);
        \App\Models\Category::create(['name'=>'Lavoro e Servizi']);
    }
    //?link categories to announcement
    private function categoriesToannouncement(){

        $announcement = \App\Models\Announcement::all();

        // Creare un array con numeri da 1 a 10
        $numbers = range(1, 10);
        // Mescolare l'array
        shuffle($numbers);
        // Estrae il primo "1" numero 
        $randomNumbers = array_slice($numbers, 0, 1);

            //attacca una categoria random agli articoli
            foreach($announcement as $announcements){
                $announcement->categories()->attach([$randomNumbers]);
            }
            
    }
    private function rols(){
        \App\Models\Role::create(['name'=>'admin']);
        \App\Models\Role::create(['name'=>'revisor']);
        \App\Models\Role::create(['name'=>'editor']);
    }
}
