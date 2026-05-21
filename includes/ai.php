<?php

// Ideally, this should come from a secure configuration or .env file.
// Since we are building boilerplate, we'll keep it as a constant for easy replacement.
define('OPENROUTER_API_KEY', 'YOUR_OPENROUTER_API_KEY');

/**
 * Generate a caption using OpenRouter API
 *
 * @param string $topic The topic or description for the post
 * @param string $platform The target platform (e.g., 'Instagram', 'Facebook')
 * @return string|false The generated caption, or false on failure
 */
function generateCaptionWithAI($topic, $platform = 'Instagram') {
    $url = 'https://openrouter.ai/api/v1/chat/completions';

    $prompt = "Write a highly engaging and conversational $platform post caption about: $topic. Include appropriate emojis and hashtags.";

    $data = [
        'model' => 'google/gemini-2.5-flash', // Using Gemini 2.5 Flash as a sensible default text model
        'messages' => [
            [
                'role' => 'user',
                'content' => $prompt
            ]
        ]
    ];

    $ch = curl_init($url);

    $headers = [
        'Authorization: Bearer ' . OPENROUTER_API_KEY,
        'HTTP-Referer: https://yoursite.com', // Optional but recommended by OpenRouter
        'X-Title: BrandPulse AI Platform', // Optional but recommended by OpenRouter
        'Content-Type: application/json'
    ];

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Suppress SSL errors for local dev environment if needed, but in prod should be true
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if(curl_errno($ch)){
        // In a real app, log curl_error($ch)
        curl_close($ch);
        return false;
    }

    curl_close($ch);

    if ($httpCode >= 200 && $httpCode < 300) {
        $responseData = json_decode($response, true);
        if (isset($responseData['choices'][0]['message']['content'])) {
            return trim($responseData['choices'][0]['message']['content']);
        }
    }

    return false;
}
?>