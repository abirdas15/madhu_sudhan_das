<?php

namespace Bulkly\Http\Controllers;

use Illuminate\Http\Request;
use Bulkly\BufferPosting;
use Bulkly\SocialPostGroups;

class HistoryController extends Controller
{
    public function index(Request $request){
        $keywords = $request->keywords;
        $date = $request->date;
        $group = $request->group;
        
        if($group){
            $bufferPosting = BufferPosting::with('groupInfo','accountInfo')
                        ->orWhereHas('groupInfo', function($query) use ($group) {
                            $query->where('type',$group);
                        })->paginate(10);
        }else if($date){
            $bufferPosting = BufferPosting::with('groupInfo','accountInfo')
            ->where('sent_at','LIKE','%'.$date.'%')
                        ->paginate(10);
        }else{
            $bufferPosting = BufferPosting::with('groupInfo','accountInfo')
                        ->where('post_text','LIKE','%'.$keywords.'%')
                        ->orWhere('sent_at','LIKE','%'.$keywords.'%')
                        ->orWhereHas('groupInfo', function($query) use ($keywords,$group) {
                            $query->where('name', 'LIKE', '%' . $keywords . '%');
                            $query->orWhere('type', 'LIKE', '%' . $keywords . '%');
                        })->paginate(10);
        }
        $groups = SocialPostGroups::get();
        if($request->ajax()){
            return view('history.view-posting',[
                'bufferPosting'=>$bufferPosting,
                'groups'=>$groups
            ]);
        }
        return view('history.index',[
            'bufferPosting'=>$bufferPosting,
            'groups'=>$groups
        ]);
    }
}
