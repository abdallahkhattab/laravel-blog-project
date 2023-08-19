<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlanController extends Controller
{
    //

    public function index(){
        return view('layouts.plan.index');
    }

   
    public function store(Request $request){
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);
  
        $planData = [
            'id' => $request->id,
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'image' => $fileName,
            'price' => $request->price,
            'title_time_ar' => $request->title_time_ar,
            'title_time_en' => $request->title_time_en,
            'hdd_en' => $request->hdd_en,
            'email_num'=>$request->email_num,
            'subdomain_num'=>$request->subdomain_num,
            'database_num'=>$request->database_num,
            'support_type'=>$request->support_type,
             
        ];

        Plan::create($planData);

        return response()->json([
            'status' => 200
        ]);
    }

    

    public function fetchAll()
    {
        $plans = Plan::all();
        $output = '';

        if ($plans->count() > 0) {
            $output .= '
                <table  class="table table-striped table-sm text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>title in english</th>
                            <th>title in arabic</th>
                            <th>title time (English)</th>
                            <th>title time (Arabic)</th>
                            <th>price</th>
                            <th>hdd space</th>
                            <th>email number</th>
                            <th>subdomain number</th>
                            <th>database number</th>
                            <th>support type</th>
                            <th>image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            ';

            foreach ($plans as $plan) {
                $output .= '
                    <tr>
                        <td>' . $plan->id . '</td>
                        <td>' . $plan->title_en . '</td>
                        <td>' . $plan->title_ar . '</td>
                        <td style="max-width: 300px; word-wrap: break-word;">' . $plan->title_time_en . '</td>
                        <td style="max-width: 300px; word-wrap: break-word;">' . $plan->title_time_ar . '</td>
                        <td>' . $plan->price . '</td>
                        <td>' . $plan->hdd_en . '</td>
                        <td>' . $plan->email_num . '</td>
                        <td>' . $plan->subdomain_num. '</td>
                        <td>' . $plan->database_num . '</td>
                        <td>' . $plan->support_type . '</td>

                        <td><img src="' . asset('storage/images/' . $plan->image) . '" alt="plans Image" width="100" class="img-thumbnail"></td>
                        <td>
                            <a href="#" id="' . $plan->id . '" class="text-success mx-1 editIconP" data-bs-toggle="modal" data-bs-target="#editPlansModal"><i class="bi bi-pencil-square h4"></i></a>
                            <a href="#" id="' . $plan->id . '" class="text-danger mx-1 deleteIconP"><i class="bi bi-trash h4"></i></a>
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
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json(['error' => 'plan not found'], 404);

        }

        return response()->json($plan);
    }

    public function update(Request $request)
    {
        $fileName = '';
        $plans = Plan::find($request->id);

        if (!$plans) {
            return response()->json(['error' => 'Plan not found'], 404);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($plans->image) {
                Storage::delete('public/images/' . $plans->image);
            }
        } else {
            $fileName = $plans->image; // Use the existing image file name
        }

        $plandata = [
          'title_en' => $request->title_en,
          'title_ar' => $request->title_ar,
          'title_time_en' => $request->title_time_en,
          'title_time_ar' => $request->title_time_ar,
          'hdd_en' => $request->title_time_ar,
          'email_num'=>$request->email_num,
          'subdomain_num'=>$request->subdomain_num,
          'database_num'=>$request->database_num,
          'support_type'=>$request->support_type,
          'image' => $fileName
      ];
        $plans->update($plandata);
        return response()->json([
            'status' => 200,
        ]);

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $plan = Plan::find($id);
        if ($plan) {
            if (Storage::delete('public/images/' . $plan->image)) {
                Plan::destroy($id);
                return response()->json([
                    'status' => 200,
                    'message' => 'Plan deleted successfully',
                ]);
            }
        }
        return response()->json([
            'status' => 400,
            'message' => 'Failed to delete the Plan',
        ], 400);
    }

    
}
