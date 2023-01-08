<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class FileController extends Controller {

    public function upload(Request $request, Patient $patient)
    {
        try
        {
            // Validate the request
            $request->validate([
                'file' => 'required|file|mimes:jpeg,png,jpg|max:1024',
            ]);

            // Store the file in blob storage
            $path = $request->file->store('public');

            // Create a new File record
            $file = File::create([
                'path'       => $path,
                'model_id'   => $patient->id,
                'model_type' => Patient::class,
            ]);

            // Return a success response
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            // Log the error
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
