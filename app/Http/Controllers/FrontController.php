<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TeamTNT\TNTSearch\TNTSearch;

class FrontController extends Controller
{
    public function home() {
        /* $announcements = Announcement::paginate(28)->get() ->sortByDesc('created_at');*/
        
        /* ordina gli annunci e li separa in paggine da 28 card */
        $announcements = Announcement::where('is_accepted', true)->orderByDesc('created_at')->paginate(4);
        

        return view('home', [
            'announcements' => $announcements,
        ]);
    }

    
    public function categoryShow(Category $category){

        /* ordina con data (piu recente - piu vecchio) gli annunci + separa le pagine a 10 annunci*/
        $announcements = Announcement::where('is_accepted', true)->where('category_id',$category->id)->orderByDesc('created_at')->paginate(10);
        /* dd($announcements); */
        return view('categoryShow',[
            'category' => $category,
            'announcements'=> $announcements,
        ]);
        
    }
    public function announcementUserShow(User $user, Category $category){
    
        /* ordina con data (piu recente - piu vecchio) gli annunci + separa le pagine a 10 annunci*/
        $announcements = Announcement::where('is_accepted', true)->where('user_id',$user->id)->orderByDesc('created_at')->paginate(10);
        
        return view('announcementUserShow',[
            'category' => $category,
            'user' => $user,
            'announcements'=> $announcements,
        ]);
        
    }

    public function searchAnnouncements(Request $request){

        if(!isset($request->category)){
            //senza categoria
            $announcements = Announcement::search($request->searched)           //!query di rcerca
                                            ->where('is_accepted', true)        //se rivisionato (accettato) o meno    
                                            ->orderBy('created_at', 'desc')    //ordina per data e ora (disendente)
                                            ->paginate(28);                    //28 annunci per pagina

        }elseif(!isset($request->searched)){
            //senza campo search
            $announcements = Announcement::where('category_id',$request->category)  //?ricerca per categoria
                                            ->where('is_accepted', true)            //se rivisionato (accettato) o meno  
                                            ->orderBy('created_at', 'desc')         //ordina per data e ora (disendente)
                                            ->paginate(28);                         //28 annunci per pagina
        }else{
            //con tutto
            
            $announcements = Announcement::search($request->searched)                   //!query di rcerca
                                            ->where('category_id',$request->category)   //?ricerca per categoria
                                            ->where('is_accepted', true)                //se rivisionato (accettato) o meno 
                                            ->orderBy('created_at', 'desc')             //ordina per data e ora (disendente)
                                            ->paginate(28);                             //28 annunci per pagina
            
        }


        
        return view('home', compact('announcements'));
    }

    public function setLanguage($lang){
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
