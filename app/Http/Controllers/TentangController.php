<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["about"] = About::all();
        
        return view('admin.about.index', $data);
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
            'judul' => 'required',
            'subjudul' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg',
        ]);

        // dd($request);

        if($validatedData->stopOnFirstFailure()->fails()) 
        
        return response()->json([
            'status' => false,
            'message' => $validatedData->errors()->first(),
        ], 200);

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $path = 'landingpage/tentang/';
        //     $nameFile = md5($image->getClientOriginalName() . rand(rand(231, 992), 123882)) . "." . $image->getClientOriginalExtension();
        //     Storage::disk('local')->put($path . $nameFile, file_get_contents($image));
        //     $imagePath = $path . $nameFile;
        // } else {
        //     $imagePath = '';
        // }
        

        if ($request->hasfile("image"))
        {    
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = Carbon::now()->format('YmdHis').'.'.$extension;
            $path = 'landingpage/tentang/'.$filename;
            Storage::disk('local')->put($path , file_get_contents($image));
        }

        $about = About::create([
            // 'id' => $about->id,
            'judul' => $request->judul,
            'subjudul' => $request->subjudul,
            'deskripsi' => $request->deskripsi,
            'image' => $filename,
        ]);

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
        $result = About::find($id);
    
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
        // $Parkir = About::where("id", $id)->update([
            
        //     $about->judul = $request->judul,
        //     $about->subjudul = $request->subjudul,
        //     $about->deskripsi = $request->deskripsi,
        //     $about->image = $request->hasFile('image') ? $request->file('image')->store('about') : $about->image,
        // ]);

        // return response()->json([
        //     'status' => true,
        //     'message' => 'Data berhasil dirubah'
        // ]);

        $about = About::find($id);

    $validatedData = Validator::make($request->all(), [
        'judul' => 'required',
        'subjudul' => 'required',
        'deskripsi' => 'required',
        'image' => 'image|mimes:jpg,png,jpeg',
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
        $path = 'landingpage/tentang/'.$filename;
        Storage::disk('local')->put($path, file_get_contents($image));

        if ($about->image && file_exists($about->image)) {
            unlink($about->image);
        }
        $about->image = $filename;
    }

    $about->judul = $request->judul;
    $about->subjudul = $request->subjudul;
    $about->deskripsi = $request->deskripsi;
    $about->save();

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
        
        try {
            // Find the about by ID
            $about = About::findOrFail($id);
            
            // Delete the about
            $about->delete();
            
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
        $data = DB::table('about_parkirkan')
            ->get();
    
        return DataTables::of($data)->make();
    }
    
    
}
