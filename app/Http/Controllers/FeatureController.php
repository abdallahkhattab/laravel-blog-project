<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feature;
use Illuminate\Support\Facades\Storage;
class FeatureController extends Controller
{
    
    public function index(){
        return view('layouts.features.index');
    }


    public function store(Request $request)
    {
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $featureData = [
            'id' => $request->id,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'image' => $fileName
        ];

        Feature::create($featureData);

        return response()->json([
            'status' => 200
        ]);
    }

    public function fetchAll()
    {
        $features = Feature::all();
        $output = '';

        if ($features->count() > 0) {
            $output .= '
                <table  class="table table-striped table-sm text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title (English)</th>
                            <th>Title (Arabic)</th>
                            <th>Description (English)</th>
                            <th>Description (Arabic)</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            ';


            foreach ($features as $feature) {
                $output .= '
                    <tr>
                        <td>' . $feature->id . '</td>
                        <td>' . $feature->title_en . '</td>
                        <td>' . $feature->title_ar . '</td>
                        <td style="max-width: 300px; word-wrap: break-word;">' . $feature->description_en . '</td>
                        <td style="max-width: 300px; word-wrap: break-word;">' . $feature->description_ar . '</td>
                        <td><img src="' . asset('storage/images/' . $feature->image) . '" alt="features Image" width="100" class="img-thumbnail"></td>
                        <td>
                            <a href="#" id="' . $feature->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editFeaturesModal"><i class="bi bi-pencil-square h4"></i></a>
                            <a href="#" id="' . $feature->id . '" class="text-danger mx-1 deleteIconF"><i class="bi bi-trash h4"></i></a>
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
    public function edit($id)
    {
        $feature = Feature::find($id);

        if (!$feature) {
            return response()->json(['error' => 'Feature not found'], 404);
        }

        return response()->json($feature);
    }

      // handle update an articleloyee ajax request
      public function update(Request $request)
      {
          $fileName = '';
          $article = Feature::find($request->id);
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
              'image' => $fileName
          ];
          $article->update($articleData);
          return response()->json([
              'status' => 200,
          ]);
      }

      public function delete(Request $request)
      {
          $id = $request->id;
          $feature = Feature::find($id);
          if ($feature) {
              if (Storage::delete('public/images/' . $feature->image)) {
                  Feature::destroy($id);
                  return response()->json([
                      'status' => 200,
                      'message' => 'Feature deleted successfully',
                  ]);
              }
          }
          return response()->json([
              'status' => 400,
              'message' => 'Failed to delete the feature',
          ], 400);
      }
}
