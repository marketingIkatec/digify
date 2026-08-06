<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PageBlock;
use App\Services\HubspotCampaignService;

class IndexController extends Controller
{
    public function index(Request $request){
        $item = Page::where(['slug' => 'index',
                             'status' => true])->first();

        return view('pages.index', compact('item'));
    }
}
