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
    //Adding files
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|fasta|max:2048',
        ]);
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $filename = $file->getClientOriginalName();
            $type = $request->input('sequence_type');
            $user = Auth::user()->name;
            $user_id = Auth::id();
            $path = $file->store('uploads', 'public');

            File::create([
                'filename' => $filename,
                'type' => $type,
                'user' => $user,
                'user_id' => $user_id,
                'file_path' => $path,
            ]);

            return redirect()->route('files.index')->with('success', 'File uploaded successfully!');
        }
     
        return redirect()->route('files.index')->with('error', 'No file uploaded.');

    }

    //Updating files

    public function update(Request $request, $id){
        $file = File::findOrFail($id);

        $filename = $request->input('filename');
        $type = $request->input('sequence_type');

        $file->update([
            'filename' => $filename,
            'type' => $type,
        ]);

        return redirect()->route('files.index')->with('success', 'File updated successfully.');

    }

    // Deleting files

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