<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Feature;
use App\Models\Plan;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testemonial;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index() {
        $articles = Article::all(); // Fetch all articles from the database. You can modify the query based on your needs.
        $features = Feature::all();
        $testimonials = Testemonial::all();
        $teamMembers = TeamMember::all();
        $services = Service::all();
        $plans = Plan::all();
        return view('layouts.front.index',compact('articles','features','testimonials','teamMembers','services','plans'));

        }

        public function form1submit(Request $request){

            $request->validate([
            'name'=>'required',
            'email'=>'required'
            ]);
            $name = $request->old('name');
            $email = $request->old('email');
            dd($request->all());
        }

        
}
