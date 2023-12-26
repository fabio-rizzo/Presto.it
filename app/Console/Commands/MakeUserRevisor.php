<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserRevisor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presto:makeUserRevisor {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rendi un utente Revisore';

    /**
     * Execute the console command.
     */
    
    public function __contruct(){
        parent::__construct();
    }
    
     public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();
        if (!$user) {
            $this->error('Utente non trovato');
            return;
        }

        $user->role = 'revisor';
        $user->save();
        $this->info("L'utente {$user->name} è ora un revisore.");
    }
}
