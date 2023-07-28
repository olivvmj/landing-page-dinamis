<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["about"] = About::all();
        
        return view('landing-page.about.index', $data);
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
    
    // public function store(Request $request)
    // {

    //     // Membuat data Validator baru
    //     $about = About::create([
    //         'judul' => $request->judul,
    //         'deskripsi' => $request->deskripsi,
    //         'image' => $data,
    //     ]);

        
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Success Add Data!',
    //     ]);
    // }

    public function store(Request $request)
    {
        $about = About::create([
            'id' => $about->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'image' => $data,
        ]);

        if ($request->hasfile("image"))
        {
            $data = $request->file("image")->store("about");
        }

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
        $about = About::find($id);

        if (!$about) {
            return response()->json(['message' => 'Data not found.'], 404);
        }

        // Mengupdate atribut-atribut
        $about->judul = $request->judul;
        $about->deskripsi = $request->deskripsi;
        $about->image = $request->hasFile('image') ? $request->file('image')->store('about') : $about->image;

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
