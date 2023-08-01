<?php

namespace App\Http\Controllers;

use App\Models\Manfaat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManfaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["manfaat"] = Manfaat::all();
        
        return view('admin.manfaat.index', $data);
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

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'manfaat' => 'required',
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
            $path = 'landingpage/manfaat/'.$filename;
            Storage::disk('local')->put($path , file_get_contents($image));
        }

        $manfaat = Manfaat::create([
            // 'id' => $about->id,
            'judul' => $request->judul,
            'subjudul' => $request->subjudul,
            'image' => $filename,
            'manfaat' => $request->manfaat,
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
        $result = Manfaat::find($id);
    
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
        $manfaat = Manfaat::find($id);

        if (!$manfaat) {
            return response()->json(['message' => 'Data not found.'], 404);
        }

        // Mengupdate atribut-atribut
        $manfaat->judul = $request->judul;
        $manfaat->subjudul = $request->subjudul;
        $manfaat->image = $request->hasFile('image') ? $request->file('image')->store('about') : $about->image;
        $manfaat->manfaat = $request->manfaat;

        // Simpan perubahan
        $about->save();

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
            $manfaat = Manfaat::findOrFail($id);
            
            // Delete the about
            $manfaat->delete();
            
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
        $data = DB::table('manfaat_parkirkan')
            ->get();
    
        return DataTables::of($data)->make();
    }
    
    
}
