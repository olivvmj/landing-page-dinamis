<?php

namespace App\Http\Controllers;

use App\Models\Fitur;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FiturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["fitur"] = Fitur::all();
        
        return view('admin.fitur.index', $data);
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
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'fitur' => 'required',
            'desk_fitur' => 'required',
        ]);

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
            $path = 'landingpage/fitur/'.$filename;
            Storage::disk('local')->put($path , file_get_contents($image));
        }

        $fitur = Fitur::create([
            // 'id' => $fitur->id,
            'judul' => $request->judul,
            'subjudul' => $request->subjudul,
            'image' => $filename,
            'fitur' => $request->fitur,
            'desk_fitur' => $request->desk_fitur,
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
        $result = Fitur::find($id);
    
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
        // $Parkir = Fitur::where("id", $id)->update([
            
        //     $fitur->judul = $request->judul,
        //     $fitur->subjudul = $request->subjudul,
        //     $fitur->deskripsi = $request->deskripsi,
        //     $fitur->image = $request->hasFile('image') ? $request->file('image')->store('about') : $fitur->image,
        // ]);

        // return response()->json([
        //     'status' => true,
        //     'message' => 'Data berhasil dirubah'
        // ]);

        $fitur = Fitur::find($id);

    $validatedData = Validator::make($request->all(), [
        'judul' => 'required',
        'subjudul' => 'required',
        'image' => 'image|mimes:jpg,png,jpeg',
        'fitur' => 'required',
        'desk_fitur' => 'required',
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
        $path = 'landingpage/fitur/'.$filename;
        Storage::disk('local')->put($path, file_get_contents($image));

        if ($fitur->image && file_exists($fitur->image)) {
            unlink($fitur->image);
        }
        $fitur->image = $filename;
    }

    $fitur->judul = $request->judul;
    $fitur->subjudul = $request->subjudul;
    $fitur->fitur = $request->fitur;
    $fitur->desk_fitur = $request->desk_fitur;
    $fitur->save();

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
            $fitur = Fitur::findOrFail($id);
            
            // Delete the about
            $fitur->delete();
            
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
        $data = DB::table('fitur_parkirkan')
            ->get();
    
        return DataTables::of($data)->make();
    }
    
    
}
