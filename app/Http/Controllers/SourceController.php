<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'archive_id' => ['required', 'integer'],
                'title' => ['required', 'string'],
                'source_type' => ['required', 'string'],
                'file' => ['required_unless:source_type,website', 'file', 'mimes:jpeg,png,pdf,txt,docx,csv,xlx,xlxs', 'max:2048'],
                'url' => ['required_if:source_type,website']
            ]);

            $file = $request->file('file');
            if($file){
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public', $fileName);
            }

            $src = new Source();
            $src->archive_id = $request->archive_id;
            $src->title = $request->title;
            if($request->file('file')){
                $src->filename = $fileName;
            }
            $src->source_type = $request->source_type;

            if(isset($request->url)){
                $src->details = $request->url;
            }

            $src->save();

            return redirect()->back()->with('success', 'Source added successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function download(Request $request)
    {
        $path = 'public/'.$request->file_name;
        if (Storage::disk('local')->exists($path)) {
            return response()->download(storage_path("app/{$path}"));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
