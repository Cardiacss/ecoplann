<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class WasteDetectionService
{
    protected $apiEndpoint;

    public function __construct()
    {
        // Gunakan endpoint dari .env
        $this->apiEndpoint = env('ECO_API_ENDPOINT', 'http://127.0.0.1:5000');
    }

    public function detectWaste($imageFile)
    {
        try {
            $imagePath = $imageFile->store('temp', 'public');

            $response = Http::attach(
                'image',
                file_get_contents(Storage::disk('public')->path($imagePath)),
                basename($imagePath)
            )->post("{$this->apiEndpoint}/predict");

            if (!$response->successful()) {
                throw new \Exception('Failed to process image');
            }

            $result = $response->json();

            if (!isset($result['prediction_label']) || !isset($result['recycle_info'])) {
                throw new \Exception('Invalid response from API');
            }

            $detectionData = [
                'user_id' => auth()->id(),
                'image_path' => $imagePath,
                'waste_type' => $result['prediction_label'],
                'recycle_info' => $result['recycle_info'],
                'created_at' => now()->toDateTimeString(),
                'points_earned' => $result['points_earned'] ?? 10
            ];

            // Update user points
            $user = auth()->user();
            $user->points += $detectionData['points_earned'];
            $user->save();

            return [
                'status' => 'success',
                'data' => $detectionData,
                'document_id' => uniqid() // temporary ID
            ];

        } catch (\Exception $e) {
            \Log::error('Waste detection error: ' . $e->getMessage());
            throw $e;
        } finally {
            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
    }

    public function getDetectionHistory($userId = null)
    {
        // Temporary: return empty array
        return [];
    }
}
