<?php
// app/Http/Controllers/WasteDetectionController.php

namespace App\Http\Controllers;

use App\Services\WasteDetectionService;
use Illuminate\Http\Request;

class WasteDetectionController extends Controller
{
    protected $wasteService;

    public function __construct(WasteDetectionService $wasteService)
    {
        $this->wasteService = $wasteService;
    }

    public function show()
    {
        return view('waste.detect');
    }
    public function process(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // max 5MB
        ]);

        try {
            // Simpan gambar ke storage
            $imagePath = $request->file('image')->store('waste-images', 'public');

            // Kirim gambar ke API untuk deteksi
            $result = $this->wasteService->detectWaste($request->file('image'));

            // Simpan data ke sesi untuk digunakan di result()
            session([
                'temp_image_path' => $imagePath,
                'detection_result' => $result, // Simpan hasil deteksi
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Image processed successfully',
                'redirect' => route('waste.result', ['id' => $result['document_id']]),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process image: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function result($id)
    {
        // Ambil data dari sesi
        $imagePath = session('temp_image_path');
        $result = session('detection_result');

        if (!$imagePath || !$result || !isset($result['data'])) {
            return redirect()->route('waste.detect')->with('error', 'Detection result not found.');
        }

        $detectionData = $result['data'];

        $wasteDetection = (object)[
            'waste_type' => $detectionData['waste_type'] ?? 'Unknown',
            'recycle_info' => $detectionData['recycle_info'] ?? 'No information available',
            'points_earned' => $detectionData['points_earned'] ?? 0,
            'image_path' => $imagePath,
            'created_at' => $detectionData['created_at'] ?? now(),
        ];

        return view('waste.result', compact('wasteDetection'));
    }
}
