<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'images.*'=>'image|mimes:jpeg,jng|max:2048'
        ]);
 
        $portfolio = Portfolio::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'languages'=> $request->languages,
            'user_id'=>Auth::id()
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


    public function edit(Portfolio $portfolio)
    {
        if(Auth::user()->id !== $portfolio->user_id){
            abort(403);
            
        }
        
        $portfolio->load('portfolioImage');
 
        return Inertia::render('portfolio/Edit',[
            'portfolio'=>$portfolio
        ]);
    }
 
    public function update(Request $request, Portfolio $portfolio)
    {

        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'languages'=>'required|array',
            'images.*'=>'image'
        ]);

        if(Auth::user()->role !== 'admin' && Auth::id() !== $portfolio->user_id){
            abort(403);
        }
 
        $portfolio->update($request->only('title','description','languages'));
 
        return redirect()->route('portfolios.index');
    }

    public function destroy(Portfolio $portfolio){
        // dd($portfolio);
        $portfolio->delete();
        return back();
    }

    public function show(){

    }
}
