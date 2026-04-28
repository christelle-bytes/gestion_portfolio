<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index(){
        $portfolios = Portfolio::with(['user', 'portfolioImage'])->latest()->get();
        // dd($portfolios);
        return Inertia::render("portfolio/List" , ["portfolios"=> $portfolios]);
    }

    public function create(){
        return Inertia::render("portfolio/Create");
    }

     public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'languages'=>'required|array',
            'images.*'=>'image'
        ]);
 
        $portfolio = Portfolio::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'languages'=> $request-> languages,
            'user_id'=>auth()->id()
        ]);
 
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $path = $image->store('portfolios','public');
 
                PortfolioImage::create([
                    'portfolio_id'=>$portfolio->id,
                    'path'=>$path
                ]);
            }
        }
 
        return redirect()->route('portfolios.index');
    }
}
