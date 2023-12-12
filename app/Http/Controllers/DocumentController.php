<?php

namespace App\Http\Controllers;

use App\Models\DigitalDocument;
use App\Models\Source;
use Illuminate\Http\Request;
use PDF;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        return view('document.create-document',[
            'archive_id'=> $id
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
    public function store(Request $request, $id)
    {
        try{
            $request->validate([
                'name' => ['required','string'],
                'doc' => ['required'],
            ]);

            $content = $request->doc;
            $archive_id = $id;

            $doc = new DigitalDocument();
            $doc->archive_id = $archive_id;
            $doc->document = $content;
            $doc->filename = $request->name;
            $doc->save();

            $src = new Source();
            $src->archive_id = $archive_id;
            $src->title = $request->name;
            $src->source_type = "Digital Document";
            $src->details = $doc->id;
            $src->save();




            return redirect()->route('archive',$archive_id)->with('success','Document saved successfully.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $dd = DigitalDocument::findOrfail($id);
            $content = $dd->document;
            PDF::loadHTML($content)
                ->setPaper('A4', 'portrait')
                ->setWarnings(false)
                ->save($dd->filename.'.pdf');

            return response()->file($dd->filename.'.pdf');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
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
