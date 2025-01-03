<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Bio\SeqIO;


class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|fasta|max:2048',
        ]);
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $type = $request->input('sequence_type');
            $path = $file->store('uploads', 'public');

            File::create([
                'filename' => $file->getClientOriginalName(),
                'type' => $type,
                'user' => Auth::user()->name,
                'file_path' => $path,
            ]);

            return redirect()->route('files.index')->with('success', 'File uploaded successfully!');
        }
     
        return redirect()->route('files.index')->with('error', 'No file uploaded.');

    }

    public function edit($id){

    }

    public function delete($id){
        $file = File::findOrFail($id);
        $filePath = storage_path('app/public/' . $file->file_path);  
        
        if (file_exists($filePath)){
            Storage::delete('public/'. $file->file_path);
        }

        $file->delete();

        return redirect()->route('files.index')->with('success', 'File deleted successfully!');
    }

    // Showing files
    public function index()
    {
        $files = File::all();
        return view('files/database', compact('files'));
    }
    

    // Showing file details
    public function show($id)
    {
        $file = File::findOrFail($id);
        $filePath = storage_path('app/public/' . $file->file_path);

        $gcContent = null;
        $nucleotideCounts = [];

        if (file_exists($filePath)) {
            $command = "python3 " . base_path('scripts/analyze_fasta.py') . " " . escapeshellarg($filePath);
            $output = shell_exec($command);
            $analysis = json_decode($output, true);

            $gcContent = $analysis['gc_content'] ?? null;
            $nucleotideCounts = $analysis['nucleotide_counts'] ?? [];
        }

        return view('files/show', compact('file', 'gcContent', 'nucleotideCounts'));
    }

}