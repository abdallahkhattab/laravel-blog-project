<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    //

    public function index(){
        return view ('layouts.team_members.index');
    }

    public function store(Request $request)
    {
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $memberdata = [

            'id' => $request->id,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,

            'image' => $fileName
        ];

        TeamMember::create($memberdata);

        return response()->json([
            'status' => 200
        ]);
    }


    public function fetchAll()
    {
        $members = TeamMember::all();
        $output = '';

        if ($members->count() > 0) {
            $output .= '
                <table  class="table table-striped table-sm text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>name in english</th>
                            <th>name in arabic</th>
                            <th>Description (English)</th>
                            <th>Description (Arabic)</th>
                            <th>Facebook</th>
                            <th>twitter</th>
                            <th>linkedin</th>
                            <th>youtube</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            ';

            foreach ($members as $member) {
                $output .= '
                    <tr>
                        <td>' . $member->id . '</td>
                        <td>' . $member->name_en . '</td>
                        <td>' . $member->name_ar . '</td>
                        <td style="max-width: 100px; word-wrap: break-word;">' . $member->description_en . '</td>
                        <td style="max-width: 100px; word-wrap: break-word;">' . $member->description_ar . '</td>
                        <td style="max-width: 100px; word-wrap: break-word;">' . $member->facebook . '</td>
                        <td style="max-width: 100px; word-wrap: break-word;">' . $member->twitter . '</td>
                        <td style="max-width: 100px; word-wrap: break-word;">' . $member->linkedin . '</td>
                        <td style="max-width: 100px; word-wrap: break-word;">' . $member->youtube . '</td>

                      
                        <td><img src="' . asset('storage/images/' . $member->image) . '" alt="testemonials Image" width="100" class="img-thumbnail"></td>
                       
                        <td>
                            <a href="#" id="' . $member->id . '" class="text-success mx-1 editIconM" data-bs-toggle="modal" data-bs-target="#editMembersModal"><i class="bi bi-pencil-square h4"></i></a>
                            <a href="#" id="' . $member->id . '" class="text-danger mx-1 deleteIconM"><i class="bi bi-trash h4"></i></a>
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
        $member = TeamMember::find($id);

        if (!$member) {
            return response()->json(['error' => 'member not found'], 404);

        }

        return response()->json($member);
    }



          // handle update an articleloyee ajax request
          public function update(Request $request)
          {
              $fileName = '';
              $member = TeamMember::find($request->id);
      
              if (!$member) {
                  return response()->json(['error' => 'Member not found'], 404);
              }

              if ($request->hasFile('image')) {
                  $file = $request->file('image');
                  $fileName = time() . '.' . $file->getClientOriginalExtension();
                  $file->storeAs('public/images', $fileName);
                  if ($member->image) {
                      Storage::delete('public/images/' . $member->image);
                  }
              } else {
                  $fileName = $member->image; // Use the existing image file name
              }

              $memberdata = [
                'id' => $request->id,
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
                'image' => $fileName
            ];
              $member->update($memberdata);
              return response()->json([
                  'status' => 200,
              ]);

          }


          public function delete(Request $request)
          {
              $id = $request->id;
              $member = TeamMember::find($id);
              if ($member) {
                  if (Storage::delete('public/images/' . $member->image)) {
                      TeamMember::destroy($id);
                      return response()->json([
                          'status' => 200,
                          'message' => 'Team member deleted successfully',
                      ]);
                  }
              }
              return response()->json([
                  'status' => 400,
                  'message' => 'Failed to delete team member',
              ], 400);

          }    
       
}
