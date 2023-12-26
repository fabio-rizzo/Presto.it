<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\BecomeRevisor;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

class RevisorController extends Controller
{
    //prende il primo annuncio da revisionare e poi lo inserisce come accettato o rifiutato e passa avanti al prossimo da revisionare
    public function index(){  
        $announcement = Announcement::where('is_accepted', null);
        $announcement_to_check = Announcement::where('is_accepted', null)->first();
        return view('revisor.index', [
            'announcement_to_check' => $announcement_to_check,
            'announcement' => $announcement
        ]);
    }
    //metodo scritto all'interno di models/announcement.php
    public function acceptAnnouncement(Announcement $announcement){
        $announcement->setAccepted(true); 
        return redirect()->back()->with('success', __('ui.annAcc'));
    }

    public function rejectAnnouncement(Announcement $announcement){
        $announcement->setAccepted(false);
        return redirect()->back()->with('error', __('ui.annRef'));
    }

    public function DestroyAnnouncement(Announcement $announcement){
        $announcement->delete();
        return redirect()->back()->with('error', __('ui.annRef'));
    }

    public function becomeRevisor(){
        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user()));

        
        if(auth()->user()->role == 'revisor'){
            return redirect()->back()->with('error', __('ui.alrRev'));

        }elseif(auth()->user()->role == 'admin'){
            return redirect()->back()->with('error', __('ui.alrAdm'));

        }
        return redirect()->back()->with('success', __('ui.ricOK'));
    }

    public function makeRevisor(User $user){
        Artisan::call('presto:makeUserRevisor', ["email"=>$user->email]);
        return redirect('/')->with('success', __('ui.revOK3'));
    }
}
