<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Category;

class Batch4DeveloperSeeder extends Seeder
{
    public function run(): void
    {
        $convCat = Category::where('slug', 'converters')->first();
        if (!$convCat) $convCat = Category::first();

        $tools = [
            [
                'category_id' => $convCat->id,
                'name' => 'Base64 Encoder/Decoder',
                'slug' => 'base64-encoder-decoder',
                'description' => 'Encode and decode text strings using Base64 format with UTF-8 support.',
                'full_description' => 'Convert text strings to Base64 encoding or decode Base64 back to original text securely in your browser.',
                'icon' => 'code',
                'route_name' => 'tools.dev.base64',
                'processing_mode' => 'client',
                'component_key' => 'base64-encoder-decoder',
                'is_featured' => true,
                'seo_title' => 'Base64 Encoder & Decoder Online Free | ToolSathi',
                'seo_description' => 'Encode and decode text to Base64 instantly online with UTF-8 support.'
            ],
            [
                'category_id' => $convCat->id,
                'name' => 'URL Encoder/Decoder',
                'slug' => 'url-encoder-decoder',
                'description' => 'URL encode and decode query strings and special characters safely.',
                'full_description' => 'Safely encode or decode URL components and query parameters with UTF-8 support.',
                'icon' => 'link',
                'route_name' => 'tools.dev.url',
                'processing_mode' => 'client',
                'component_key' => 'url-encoder-decoder',
                'is_featured' => false,
                'seo_title' => 'URL Encoder & Decoder Online Free | ToolSathi',
                'seo_description' => 'URL encode and decode strings and parameters instantly online.'
            ],
            [
                'category_id' => $convCat->id,
                'name' => 'HTML Encoder/Decoder',
                'slug' => 'html-encoder-decoder',
                'description' => 'Convert special characters into HTML entities and decode safely.',
                'full_description' => 'Safely convert characters into HTML entities or decode entities back to plain text.',
                'icon' => 'file-code',
                'route_name' => 'tools.dev.html',
                'processing_mode' => 'client',
                'component_key' => 'html-encoder-decoder',
                'is_featured' => false,
                'seo_title' => 'HTML Entity Encoder & Decoder Online Free | ToolSathi',
                'seo_description' => 'Encode and decode HTML special characters and entities online.'
            ],
            [
                'category_id' => $convCat->id,
                'name' => 'UUID Generator',
                'slug' => 'uuid-generator',
                'description' => 'Generate single or multiple cryptographically secure UUID v4 strings.',
                'full_description' => 'Generate bulk UUID v4 identifiers using cryptographically secure random number generators.',
                'icon' => 'hash',
                'route_name' => 'tools.dev.uuid',
                'processing_mode' => 'client',
                'component_key' => 'uuid-generator',
                'is_featured' => true,
                'seo_title' => 'UUID v4 Generator Online Free - Bulk UUIDs | ToolSathi',
                'seo_description' => 'Generate secure random UUID v4 identifiers in single or bulk batches.'
            ],
            [
                'category_id' => $convCat->id,
                'name' => 'Hash Generator',
                'slug' => 'hash-generator',
                'description' => 'Generate SHA-1, SHA-256, SHA-384, and SHA-512 hashes from text.',
                'full_description' => 'Compute cryptographic checksums and hashes using the Web Crypto API.',
                'icon' => 'shield',
                'route_name' => 'tools.dev.hash',
                'processing_mode' => 'client',
                'component_key' => 'hash-generator',
                'is_featured' => false,
                'seo_title' => 'SHA-256 Hash Generator Online Free | ToolSathi',
                'seo_description' => 'Generate SHA-1, SHA-256, and SHA-512 cryptographic hashes from text.'
            ],
            [
                'category_id' => $convCat->id,
                'name' => 'JWT Decoder',
                'slug' => 'jwt-decoder',
                'description' => 'Decode JSON Web Token (JWT) headers and payloads securely locally.',
                'full_description' => 'Inspect JWT header, payload, expiration times, and claims locally in your browser.',
                'icon' => 'key',
                'route_name' => 'tools.dev.jwt',
                'processing_mode' => 'client',
                'component_key' => 'jwt-decoder',
                'is_featured' => false,
                'seo_title' => 'JWT Decoder Online Free - Inspect JSON Web Tokens | ToolSathi',
                'seo_description' => 'Decode and inspect JWT headers and payloads securely in your browser.'
            ],
            [
                'category_id' => $convCat->id,
                'name' => 'CSS Minifier',
                'slug' => 'css-minifier',
                'description' => 'Minify CSS stylesheets and reduce payload size instantly.',
                'full_description' => 'Compress and optimize CSS stylesheets by stripping whitespace and comments.',
                'icon' => 'file-text',
                'route_name' => 'tools.dev.css-minifier',
                'processing_mode' => 'client',
                'component_key' => 'css-minifier',
                'is_featured' => false,
                'seo_title' => 'CSS Minifier & Compressor Online Free | ToolSathi',
                'seo_description' => 'Minify CSS stylesheets online to reduce file size and speed up websites.'
            ],
            [
                'category_id' => $convCat->id,
                'name' => 'JavaScript Minifier',
                'slug' => 'javascript-minifier',
                'description' => 'Minify JavaScript code safely without execution.',
                'full_description' => 'Compress and optimize JavaScript source code payload securely.',
                'icon' => 'code',
                'route_name' => 'tools.dev.js-minifier',
                'processing_mode' => 'client',
                'component_key' => 'javascript-minifier',
                'is_featured' => false,
                'seo_title' => 'JavaScript Minifier Online Free - Compress JS | ToolSathi',
                'seo_description' => 'Minify JavaScript code online securely in your browser.'
            ],
            [
                'category_id' => $convCat->id,
                'name' => 'SQL Formatter',
                'slug' => 'sql-formatter',
                'description' => 'Format and beautify SQL queries with proper indentation.',
                'full_description' => 'Beautify SQL statements with capitalized keywords and clean indentation.',
                'icon' => 'database',
                'route_name' => 'tools.dev.sql-formatter',
                'processing_mode' => 'client',
                'component_key' => 'sql-formatter',
                'is_featured' => false,
                'seo_title' => 'SQL Formatter & Beautifier Online Free | ToolSathi',
                'seo_description' => 'Format and beautify SQL queries online for free with ToolSathi.'
            ],
            [
                'category_id' => $convCat->id,
                'name' => 'QR Code Scanner',
                'slug' => 'qr-code-scanner',
                'description' => 'Scan and decode QR codes from camera or uploaded images.',
                'full_description' => 'Decode QR code content from uploaded image files or device cameras.',
                'icon' => 'camera',
                'route_name' => 'tools.dev.qr-scanner',
                'processing_mode' => 'client',
                'component_key' => 'qr-code-scanner',
                'is_featured' => true,
                'seo_title' => 'QR Code Scanner Online Free - Decode QR Images | ToolSathi',
                'seo_description' => 'Scan and decode QR code images instantly online in your browser.'
            ]
        ];

        foreach ($tools as $toolData) {
            Tool::firstOrCreate(['slug' => $toolData['slug']], $toolData);
        }
    }
}
