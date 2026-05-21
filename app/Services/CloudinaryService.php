<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\UploadedFile;

class CloudinaryService
{
    /**
     * Upload an image to Cloudinary using their raw REST API.
     * This avoids any composer package version conflicts.
     *
     * @param UploadedFile $file The file to upload
     * @param string $folder Optional folder name in Cloudinary
     * @return string|null Returns the secure URL if successful, null otherwise.
     */
    public static function upload(UploadedFile $file, $folder = '')
    {
        $url = env('CLOUDINARY_URL');
        if (!$url) {
            \Log::error('CLOUDINARY_URL is not set in .env');
            return null;
        }

        // Parse cloudinary://API_KEY:API_SECRET@CLOUD_NAME
        preg_match('/cloudinary:\/\/([^:]+):([^@]+)@(.+)/', $url, $matches);
        if (count($matches) !== 4) {
            \Log::error('Invalid CLOUDINARY_URL format');
            return null;
        }

        $apiKey = $matches[1];
        $apiSecret = $matches[2];
        $cloudName = $matches[3];

        $timestamp = time();
        
        // Parameters to sign must be sorted alphabetically
        $paramsToSign = "timestamp={$timestamp}";
        if ($folder) {
            $paramsToSign = "folder={$folder}&timestamp={$timestamp}";
        }
        
        $signature = sha1($paramsToSign . $apiSecret);

        $postData = [
            'api_key' => $apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ];
        
        if ($folder) {
            $postData['folder'] = $folder;
        }

        $response = Http::attach(
            'file', file_get_contents($file->getRealPath()), $file->getClientOriginalName()
        )->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", $postData);

        if ($response->successful()) {
            return $response->json('secure_url');
        }

        \Log::error('Cloudinary upload failed: ' . $response->body());
        return null;
    }
}
