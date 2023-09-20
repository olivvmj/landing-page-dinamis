<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SectionType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type = SectionType::all();
        
        $section = Section::join('section_type', 'section_type.id', '=', 'section.type_id')
                    ->get();

        return view('admin.section.index', compact('type', 'section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
        // dd($request->all());

        $validatedData = Validator::make($request->all(),[
            'type_section' => 'required',
            'title'=> 'required',
            'title_highlight'=> 'required',
            'menu'=> 'required',
            'image'=> 'sometimes|image|mimes:jpg,png,jpeg',
        ]);

        if($validatedData->stopOnFirstFailure()->fails()) 
        
        return response()->json([
            'status' => false,
            'message' => $validatedData->errors()->first(),
        ], 200);

        if ($request->hasfile("image"))
        {    
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = Carbon::now()->format('YmdHis').'.'.$extension;
            $path = 'landingpage/section/'.$filename;
            Storage::disk('local')->put($path , file_get_contents($image));
        }

        $section = Section::create([
            'type_id' => $request->type_section,
            'title'=> $request->title,
            'title_highlight'=> $request->title_highlight,
            'menu'=> $request->menu,
            'description'=> $request->description,
            'image'=> $filename,
            'section_code' => Str::uuid()
        ]);
        
        // dd($request);
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil disimpan!',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Section::find($id);
    
        if ($result) {
            return response()->json(['data' => $result]);
        } else {
            return response()->json(['message' => 'Data not found.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        
    public function update(Request $request, $id)
    {
        $section = Section::find($id);

        $validatedData = Validator::make($request->all(), [
            'type_section' => 'required',
            'title'=> 'required',
            'title_highlight'=> 'required',
            'menu'=> 'required',
            // 'image'=> 'required|image|mimes:jpg,png,jpeg'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validatedData->errors()->first(),
            ], 200);
        }

        $section->type_id = $request->input('type_section');
        $section->title= $request->title;
        $section->title_highlight= $request->title_highlight;
        $section->menu= $request->menu;
        $section->description= $request->description;
        if ($request->hasFile("image")) {   
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = Carbon::now()->format('YmdHis').'.'.$extension;
            $path = 'landingpage/section/'.$filename;
            Storage::disk('local')->put($path, file_get_contents($image));

            if ($detail->image && file_exists($detail->image)) {
                unlink($detail->image);
            }else{
            }
        }
        // $section->image= $filename;
        $section->save();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dirubah'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        // dd($id);
        try {
            // Find the about by ID
            $section = Section::findOrFail($id);
            
            // Delete the about
            $section->delete();
            
            DB::commit();
    
            return response()->json([
                'status' => true,
                'message' => 'Success Delete Data!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
    
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete data. Error: ' . $e->getMessage(),
            ]);
        }
    }

    public function datatable(Request $request)
    {
        $data = DB::table('section')
            ->join('section_type', 'section_type.id', '=', 'section.type_id')
            ->select('section.id AS section_id', 'section_type.id AS type_id', 'section.title', 'section.title_highlight', 'section.menu', 'section.description', 'section.image', 'section_type.type_name')
            ->get();

        // dd($data);
        return DataTables::of($data)->make();
    }
    
    
}

