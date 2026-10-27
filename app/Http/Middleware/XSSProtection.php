<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XSSProtection
{
    /**
     * Fields that should skip XSS protection (e.g., rich text editors)
     */
    protected $except = [
        'question',
        'description',
        'about',
        'career',
        'earn',
        'benefit',
        'curriculum',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $input = $request->all();

        array_walk_recursive($input, function(&$value, $key) {
            // Skip XSS protection for specific fields
            if (in_array($key, $this->except)) {
                return;
            }

            // Only clean string values
            if (is_string($value)) {
                $value = $this->cleanInput($value);
            }
        });

        $request->merge($input);

        return $next($request);
    }

    /**
     * Clean the input value
     */
    protected function cleanInput($value)
    {
        // Remove null bytes
        $value = str_replace(chr(0), '', $value);

        // Remove script tags
        $value = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $value);

        // Remove event handlers (onclick, onerror, etc.)
        $value = preg_replace('/\s*on\w+\s*=\s*["\']?[^"\']*["\']?/i', '', $value);

        // Remove javascript: protocol
        $value = preg_replace('/javascript:/i', '', $value);

        // Remove data: protocol (can be used for XSS)
        $value = preg_replace('/data:text\/html/i', '', $value);

        // Remove vbscript: protocol
        $value = preg_replace('/vbscript:/i', '', $value);

        // Encode special characters
        $value = htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8', false);

        return $value;
    }
}