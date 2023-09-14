<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\DetailSection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DetailSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section = Section::all();
        
        $detail = DetailSection::join('section', 'section.id', '=', 'section_detail.section_id')
                    ->get();

        return view('admin.detail.index', compact('section', 'detail'));
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

        $validatedData = Validator::make($request->all(),[
            'menu_section' => 'required',
            'image'=> 'required|image|mimes:jpg,png,jpeg',
            'title'=> 'sometimes',
            'desc'=> 'sometimes',
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
            $path = 'landingpage/detail/'.$filename;
            Storage::disk('local')->put($path , file_get_contents($image));
        }

        $detail = DetailSection::create([
            'section_id' => $request->menu_section,
            'image'=> $filename,
            'title'=> $request->title,
            'desc'=> $request->desc,
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
        $result = DetailSection::find($id);
    
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

        $detail = DetailSection::find($id);

        $validatedData = Validator::make($request->all(),[
            'menu_section' => 'required',
            'image'=> 'required|image|mimes:jpg,png,jpeg',
            'title'=> 'sometimes',
            'desc'=> 'sometimes',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validatedData->errors()->first(),
            ], 200);
        }

        if ($request->hasFile("image")) {   
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = Carbon::now()->format('YmdHis').'.'.$extension;
            $path = 'landingpage/detail/'.$filename;
            Storage::disk('local')->put($path, file_get_contents($image));

            if ($detail->image && file_exists($detail->image)) {
                unlink($detail->image);
            }
            $detail->image = $filename;
        }

        $detail->section_id = $request->input('menu_section');
        $detail->image= $filename;
        $detail->title= $request->title;
        $detail->desc= $request->desc;
        $detail->save();

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
            $detail = DetailSection::findOrFail($id);
            
            // Delete the about
            $detail->delete();
            
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
        $data = DB::table('section_detail')
            ->join('section', 'section.id', '=', 'section_detail.section_id')
            ->select('section_detail.id AS detail_id', 'section.id AS section_id', 'section.menu', 'section_detail.image', 'section_detail.title', 'section_detail.desc')
            ->get();

        // dd($data);
        return DataTables::of($data)->make();
    }
    
    
}

