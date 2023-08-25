<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('comments')->get();
        return view('layouts.articles.index', compact('articles'));
    
        return view('layouts.articles.index');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function store(Request $request)
    {
       
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);
        

        $articleData = [
            'id' => $request->id,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
            'image' => $fileName,
        ];

        Article::create($articleData);

        return response()->json([
            'status' => 200
        ]);
    }

    public function fetchAll()
    {
        $articles = Article::all();
        $output = '';

        if ($articles->count() > 0) {
            $output .= '
                <table class="table table-striped table-sm text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title (English)</th>
                            <th>Title (Arabic)</th>
                            <th>Description (English)</th>
                            <th>Description (Arabic)</th>
                            <th>Image</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            ';


            foreach ($articles as $article) {
                $output .= '
                    <tr>
                        <td>' . $article->id . '</td>
                        <td>' . $article->title_en . '</td>
                        <td>' . $article->title_ar . '</td>
                        <td style="max-width: 300px; word-wrap: break-word;">' . $article->description_en . '</td>
                        <td style="max-width: 300px; word-wrap: break-word;">' . $article->description_ar . '</td>
                        <td><img src="' . asset('storage/images/' . $article->image) . '" alt="Article Image" width="100" class="img-thumbnail"></td>
                        <td style="max-width: 300px; word-wrap: break-word;">' . $article->status . '</td>

                        <td>
                            <a href="#" id="' . $article->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editArticlesModal"><i class="bi bi-pencil-square h4"></i></a>
                            <a href="#" id="' . $article->id . '" class="text-danger mx-1 deleteIconA"><i class="bi bi-trash h4"></i></a>
                        </td>
                    </tr>
                ';
            }

            $output .= '
                    </tbody>
                </table>
            ';

            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle edit article ajax

    public function edit($id)
    {
        $article = Article::find($id);
        return response()->json($article);
    }


    // handle update an articleloyee ajax request
    public function update(Request $request)
    {
        $fileName = '';
        $article = Article::find($request->id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($article->image) {
                Storage::delete('public/images/' . $article->image);
            }
        } else {
            $fileName = $request->image;
        }


        $articleData = [
            'id' => $request->id,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'status'=>$request->status,
            'image' => $fileName,
        ];
        $article->update($articleData);
        return response()->json([
            'status' => 200,
        ]);
    }


    //handle delete ajax request

    public function delete(Request $request)
    {
        $id = $request->id;
        $article = Article::find($id);
        if ($article) {
            if (Storage::delete('public/images/' . $article->image)) {
                Article::destroy($id);
                return response()->json([
                    'status' => 200,
                    'message' => 'Article deleted successfully',
                ]);
            }
        }
        return response()->json([
            'status' => 400,
            'message' => 'Failed to delete the article',
        ], 400);
    }
     
}

