<?php

namespace App\Http\Controllers;

use App\Models\Testemonial;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestemonialController extends Controller
{
    //

    public function index(){
        return view('layouts.testemonials.index');
    }


    public function store(Request $request){
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $testemonialData = [
            'id' => $request->id,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'title_job_en' => $request->title_job_en,
            'title_job_ar' => $request->title_job_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            // Get the rating value from the form
            'rate' => $request->input('rating'),
            'avatar' => $fileName
        ];

        Testemonial::create($testemonialData);

        return response()->json([
            'status' => 200
        ]);
    }


    public function fetchAll()
    {
        $testemonials = Testemonial::all();
        $output = '';

        if ($testemonials->count() > 0) {
            $output .= '
                <table  class="table table-striped table-sm text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>name in english</th>
                            <th>name in arabic</th>
                            <th>Description (English)</th>
                            <th>Description (Arabic)</th>
                            <th>title job in english</th>
                            <th>title job in arabic</th>
                            <th>Avatar</th>
                            <th>rating</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            ';

            foreach ($testemonials as $testemonial) {
                $output .= '
                    <tr>
                        <td>' . $testemonial->id . '</td>
                        <td>' . $testemonial->name_en . '</td>
                        <td>' . $testemonial->name_ar . '</td>
                        <td style="max-width: 300px; word-wrap: break-word;">' . $testemonial->description_en . '</td>
                        <td style="max-width: 300px; word-wrap: break-word;">' . $testemonial->description_ar . '</td>
                        <td>' . $testemonial->title_job_en . '</td>
                        <td>' . $testemonial->title_job_ar . '</td>
                        <td><img src="' . asset('storage/images/' . $testemonial->avatar) . '" alt="testemonials Image" width="100" class="img-thumbnail"></td>
                        <td>' . $testemonial->rate . '</td>
                        <td>
                            <a href="#" id="' . $testemonial->id . '" class="text-success mx-1 editIconT" data-bs-toggle="modal" data-bs-target="#editTestemonialsModal"><i class="bi bi-pencil-square h4"></i></a>
                            <a href="#" id="' . $testemonial->id . '" class="text-danger mx-1 deleteIconT"><i class="bi bi-trash h4"></i></a>
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
        $testemonial = Testemonial::find($id);

        if (!$testemonial) {
            return response()->json(['error' => 'testemonials not found'], 404);
        }

        return response()->json($testemonial);
    }

    

      // handle update an articleloyee ajax request
      public function update(Request $request)
      {
          $fileName = '';
          $testemonial = Testemonial::find($request->testemonial_id);
  
          if (!$testemonial) {
              return response()->json(['error' => 'Testemonial not found'], 404);
          }
  
          if ($request->hasFile('image')) {
              $file = $request->file('image');
              $fileName = time() . '.' . $file->getClientOriginalExtension();
              $file->storeAs('public/images', $fileName);
              if ($testemonial->avatar) {
                  Storage::delete('public/images/' . $testemonial->avatar);
              }
          } else {
              $fileName = $testemonial->avatar; // Use the existing image file name
          }
  
          $testemonialData = [
              'name_en' => $request->name_en,
              'name_ar' => $request->name_ar,
              'title_job_en' => $request->title_job_en,
              'title_job_ar' => $request->title_job_ar,
              'description_en' => $request->description_en,
              'description_ar' => $request->description_ar,
              'rate' => $request->input('rating'),
              'avatar' => $fileName,
          ];
  
          $testemonial->update($testemonialData);
          return response()->json([
              'status' => 200,
          ]);
      }
      

      public function delete(Request $request)
      {
          $id = $request->id;
          $testemonial = Testemonial::find($id);
          if ($testemonial) {
              if (Storage::delete('public/images/' . $testemonial->avatar)) {
                  Testemonial::destroy($id);
                  return response()->json([
                      'status' => 200,
                      'message' => 'Testemonial deleted successfully',
                  ]);
              }
          }
          return response()->json([
              'status' => 400,
              'message' => 'Failed to delete the testemonial',
          ], 400);
      }
}
