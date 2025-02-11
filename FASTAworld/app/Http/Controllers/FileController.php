<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 

class FileController extends Controller
{
    // Adding files
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|fasta|max:2048',
                'name' => 'required|string|max:255', 
                'sequence_type' => 'required|string|in:dna,rna,protein',
            ]);
        
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $name = $request->input('name');            
                $filename = $file->getClientOriginalName();
                $type = $request->input('sequence_type');
                $user = Auth::user()->name;
                $user_id = Auth::id();
                $path = $file->store('uploads', 'public');

                File::create([
                    'name' => $name,
                    'filename' => $filename,
                    'type' => $type,
                    'user' => $user,
                    'user_id' => $user_id,
                    'file_path' => $path,
                    'analysis_path' => $path . '.json'
                ]);
                
                return redirect()->route('files')->with('success', 'File uploaded successfully!');
            }

            return redirect()->route('files')->with('error', 'No file uploaded.');
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            return redirect()->route('files')->with('error', 'File upload failed due to an error.');
        }
    }

    // Analyzing files
    public function analyze($id)
    {
        try {
            $file = File::findOrFail($id);
            $filePath = Storage::disk('public')->path($file->file_path);

            if (file_exists($filePath)) {
                $command = "python3 " . base_path('scripts/analyze_fasta.py') . " " . escapeshellarg($filePath);
                $output = shell_exec($command);

                if (!$output) {
                    throw new \Exception("Analysis script failed to execute.");
                }
            } else {
                return redirect()->route('files')->with('error', 'File not found.');
            }

            return redirect()->route('files')->with('success', 'File analyzed successfully.');
        } catch (\Exception $e) {
            Log::error('File analysis error: ' . $e->getMessage());
            return redirect()->route('files')->with('error', 'File analysis failed due to an error.');
        }
    }

    // Updating files
    public function update(Request $request, $id)
    {
        try {
            $file = File::findOrFail($id);

            $request->validate([
                'filename' => 'required|string|max:255', 
                'sequence_type' => 'required|string|in:dna,rna,protein',
            ]);

            $name = $request->input('filename');
            $type = $request->input('sequence_type');

            $file->update([
                'name' => $name,
                'type' => $type,
            ]);

            return redirect()->route('files')->with('success', 'File updated successfully.');
        } catch (\Exception $e) {
            Log::error('File update error: ' . $e->getMessage());
            return redirect()->route('files')->with('error', 'File update failed due to an error.');
        }
    }

    // Deleting files
    public function destroy($id)
    {
        try {
            $file = File::findOrFail($id);
            $filePath = Storage::disk('public')->path($file->file_path);
            
            if (file_exists($filePath)){
                Storage::delete('public/'. $file->file_path);
            } 

            $file->delete();

            return redirect()->route('files')->with('success', 'File deleted successfully!');
        } catch (\Exception $e) {
            Log::error('File delete error: ' . $e->getMessage());
            return redirect()->route('files')->with('error', 'File deletion failed due to an error.');
        }
    }

    // Showing files
    public function index()
    {
        try {
            $files = File::all();
            return view('files/database', compact('files'));
        } catch (\Exception $e) {
            Log::error('Error retrieving files: ' . $e->getMessage());
            return redirect()->route('files')->with('error', 'Failed to load files.');
        }
    }

    // Showing file details
    public function show($id)
    {
        try {
            $file = File::findOrFail($id);
            $filePath = Storage::disk(name: 'public')->path($file->file_path);
            $analysisPath = Storage::disk('public')->path($file->analysis_path);
        
            if (!file_exists($analysisPath)) {
                $this->analyze($id);
            }
            
            $analysis = json_decode(file_get_contents($analysisPath), true);

            return view('files/show', compact('file', 'analysis'));
        } catch (\Exception $e) {
            Log::error('Error showing file details: ' . $e->getMessage());
            return redirect()->route('files')->with('error', 'Failed to load file details.');
        }
    }

    // Download file
    public function download($id){
        $file = File::findOrFail($id);
        $file_path = storage_path('app/public/' . $file->file_path);
        $file_name = $file->filename;
        return response()->download($file_path, $file_name);
    }
}
