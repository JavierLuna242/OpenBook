<?php

namespace App\Http\Controllers;

use App\Models\AcademicMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AcademicMaterialController extends Controller
{
    /**
     * Display a listing of the materials for the authenticated tutor.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role !== 'tutor') {
            return redirect()->route('dashboard.student');
        }

        $materials = AcademicMaterial::where('tutor_id', $user->id)->latest()->get();

        return view('dashboard.tutor.materials', compact('user', 'materials'));
    }

    /**
     * Store a newly uploaded material in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'tutor') {
            return redirect()->route('dashboard.student');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'document' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,zip,rar,txt|max:10240', // 10MB max
        ]);

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            
            // Store the file in the public disk under 'academic_materials' folder
            $path = $file->store('academic_materials', 'public');
            
            // Calculate size in readable format
            $bytes = $file->getSize();
            $units = ['B', 'KB', 'MB', 'GB', 'TB'];
            $i = 0;
            while ($bytes >= 1024 && $i < count($units) - 1) {
                $bytes /= 1024;
                $i++;
            }
            $sizeFormatted = round($bytes, 2) . ' ' . $units[$i];

            AcademicMaterial::create([
                'tutor_id' => $user->id,
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $path,
                'file_type' => $file->getClientOriginalExtension(),
                'file_size' => $sizeFormatted,
            ]);

            return redirect()->route('dashboard.tutor.materials')->with('success', '¡Material académico subido exitosamente!');
        }

        return back()->withErrors(['document' => 'El archivo es obligatorio.']);
    }

    /**
     * Download the specified material.
     */
    public function download(AcademicMaterial $material)
    {
        // Check if the file exists
        if (!Storage::disk('public')->exists($material->file_path)) {
            return back()->with('error', 'El archivo no se encuentra disponible.');
        }

        // Return the file for download
        return Storage::disk('public')->download($material->file_path, $material->title . '.' . $material->file_type);
    }

    /**
     * Remove the specified material from storage.
     */
    public function destroy(AcademicMaterial $material)
    {
        $user = Auth::user();
        
        // Ensure only the owner can delete it
        if ($material->tutor_id !== $user->id) {
            abort(403);
        }

        // Delete from storage
        if (Storage::disk('public')->exists($material->file_path)) {
            Storage::disk('public')->delete($material->file_path);
        }

        // Delete from database
        $material->delete();

        return redirect()->route('dashboard.tutor.materials')->with('success', '¡Material académico eliminado correctamente!');
    }
}
