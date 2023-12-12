<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $archive = Archive::find($id);
        $sources = Source::where('archive_id', $id)->paginate(10);

        return view('archives',[
            'archive' => $archive,
            'sources' => $sources
        ]);
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
                'title' => ['required', 'string'],
                'description' => ['required', 'string']
            ]);

            $archive = new Archive();
            $archive->reference = rand(10000, 99999);
            $archive->title = $request->title;
            $archive->description = $request->description;
            $archive->color = 'red';
            $archive->user_id = Auth::id();
            $archive->save();

            return redirect()->back()->with('success', 'Archive added successfully');
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'title' => ['required', 'string'],
                'description' => ['required', 'string']
            ]);

            $archive = Archive::find($id);
            $archive->title = $request->title;
            $archive->description = $request->description;
            $archive->save();

            return redirect()->back()->with('success', 'Archive updated successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $archive = Archive::find($id);
            $archive->delete();

            return redirect()->back()->with('success', 'Archive deleted successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
