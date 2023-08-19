<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    //

    public function index(){
        return view('layouts.setting.index');
    }

    public function store(Request $request)
    {
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $servicedata = [

            'id' => $request->id,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'logo' => $fileName
        ];

       Service::create($servicedata);

        return response()->json([
            'status' => 200

        ]);
    }


    public function fetchAll()
    {
        $services = Service::all();
        $output = '';

        if ($services->count() > 0) {
            $output .= '
                <table  class="table table-striped table-sm text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>name in english</th>
                            <th>name in arabic</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            ';

            foreach ($services as $service) {
                $output .= '
                    <tr>
                        <td>' . $service->id . '</td>
                        <td>' . $service->name_en . '</td>
                        <td>' . $service->name_ar . '</td>
                      

                      
                        <td><img src="' . asset('storage/images/' . $service->logo) . '" alt="testemonials Image" width="100" class="img-thumbnail"></td>
                       
                        <td>
                            <a href="#" id="' . $service->id . '" class="text-success mx-1 editIconS" data-bs-toggle="modal" data-bs-target="#editServicesModal"><i class="bi bi-pencil-square h4"></i></a>
                            <a href="#" id="' . $service->id . '" class="text-danger mx-1 deleteIconS"><i class="bi bi-trash h4"></i></a>
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
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        return response()->json($service);

    }


// update service data by id

          // handle update an articleloyee ajax request
          public function update(Request $request)
          {
              $fileName = '';
              $services = Service::find($request->id);
      
              if (!$services) {
                  return response()->json(['error' => 'Service not found'], 404);
              }

              if ($request->hasFile('image')) {
                  $file = $request->file('image');
                  $fileName = time() . '.' . $file->getClientOriginalExtension();
                  $file->storeAs('public/images', $fileName);
                  if ($services->logo) {
                      Storage::delete('public/images/' . $services->logo);
                  }
              } else {
                  $fileName = $services->logo; // Use the existing image file name
              }

              $data = [
                'id' => $request->id,
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'logo' => $fileName
            ];
              $services->update($data);
              return response()->json([
                  'status' => 200,
              ]);

          }


          public function delete(Request $request)
          {
              $id = $request->id;
              $services = Service::find($id);
              if ($services) {
                  if (Storage::delete('public/images/' . $services->logo)) {
                    Service::destroy($id);
                      return response()->json([
                          'status' => 200,
                          'message' => 'Team services deleted successfully',
                      ]);
                  }
              }
              return response()->json([
                  'status' => 400,
                  'message' => 'Failed to delete team services',
              ], 400);

          }    
}



