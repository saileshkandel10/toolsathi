<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Category;

class Batch2ImageSeeder extends Seeder
{
    public function run(): void
    {
        $imageCat = Category::where('slug', 'image-tools')->first();
        if (!$imageCat) return;

        $tools = [
            [
                'category_id' => $imageCat->id,
                'name' => 'Background Remover',
                'slug' => 'background-remover',
                'description' => 'Remove image backgrounds instantly using AI processing.',
                'full_description' => 'Automatically remove backgrounds from portraits and product shots with professional precision.',
                'icon' => 'scissors',
                'route_name' => 'tools.image.background-remover',
                'processing_mode' => 'external_api',
                'component_key' => 'background-remover',
                'is_featured' => true,
                'seo_title' => 'AI Background Remover Online Free - Remove BG | ToolSathi',
                'seo_description' => 'Remove photo backgrounds automatically and download transparent PNGs with ToolSathi.'
            ],
            [
                'category_id' => $imageCat->id,
                'name' => 'Image to WebP',
                'slug' => 'image-to-webp',
                'description' => 'Convert JPG and PNG images to next-gen WebP format.',
                'full_description' => 'Optimize website performance by converting images to high-compression WebP format.',
                'icon' => 'image',
                'route_name' => 'tools.image.image-to-webp',
                'processing_mode' => 'client',
                'component_key' => 'image-to-webp',
                'is_featured' => true,
                'seo_title' => 'Image to WebP Converter Free - Compress & Convert | ToolSathi',
                'seo_description' => 'Convert JPG, PNG images to WebP format online in your browser.'
            ],
            [
                'category_id' => $imageCat->id,
                'name' => 'WebP to JPG',
                'slug' => 'webp-to-jpg',
                'description' => 'Convert WebP images into universally compatible JPG files.',
                'full_description' => 'Transform WebP images into JPG format with custom background color for transparency.',
                'icon' => 'file-image',
                'route_name' => 'tools.image.webp-to-jpg',
                'processing_mode' => 'client',
                'component_key' => 'webp-to-jpg',
                'is_featured' => false,
                'seo_title' => 'WebP to JPG Converter Free - Convert WebP to JPEG | ToolSathi',
                'seo_description' => 'Convert WebP images to JPG format online instantly for free.'
            ],
            [
                'category_id' => $imageCat->id,
                'name' => 'WebP to PNG',
                'slug' => 'webp-to-png',
                'description' => 'Convert WebP images to PNG format while preserving transparency.',
                'full_description' => 'Convert WebP files into lossless PNG images with alpha channel support.',
                'icon' => 'file-image',
                'route_name' => 'tools.image.webp-to-png',
                'processing_mode' => 'client',
                'component_key' => 'webp-to-png',
                'is_featured' => false,
                'seo_title' => 'WebP to PNG Converter Free - Lossless Conversion | ToolSathi',
                'seo_description' => 'Convert WebP to PNG format online while preserving transparency.'
            ],
            [
                'category_id' => $imageCat->id,
                'name' => 'Image Watermark',
                'slug' => 'image-watermark',
                'description' => 'Add custom text or logo watermarks to protect your photos.',
                'full_description' => 'Stamp text or image watermarks onto photos with adjustable opacity, position, and rotation.',
                'icon' => 'stamp',
                'route_name' => 'tools.image.image-watermark',
                'processing_mode' => 'client',
                'component_key' => 'image-watermark',
                'is_featured' => false,
                'seo_title' => 'Add Watermark to Image Online Free - Protect Photos | ToolSathi',
                'seo_description' => 'Stamp text and logo watermarks onto images securely in your browser.'
            ],
            [
                'category_id' => $imageCat->id,
                'name' => 'Image Blur',
                'slug' => 'image-blur',
                'description' => 'Apply adjustable blur effects to images or sensitive areas.',
                'full_description' => 'Blur photos and sensitive information effortlessly using HTML5 Canvas.',
                'icon' => 'eye-off',
                'route_name' => 'tools.image.image-blur',
                'processing_mode' => 'client',
                'component_key' => 'image-blur',
                'is_featured' => false,
                'seo_title' => 'Blur Image Online Free - Privacy Blur Tool | ToolSathi',
                'seo_description' => 'Apply adjustable blur effects to photos online with ToolSathi.'
            ],
            [
                'category_id' => $imageCat->id,
                'name' => 'Image Filters',
                'slug' => 'image-filters',
                'description' => 'Apply professional color filters, brightness, contrast, and sepia.',
                'full_description' => 'Enhance photos with adjustable brightness, contrast, grayscale, sepia, and saturation filters.',
                'icon' => 'sliders',
                'route_name' => 'tools.image.image-filters',
                'processing_mode' => 'client',
                'component_key' => 'image-filters',
                'is_featured' => false,
                'seo_title' => 'Photo Editor & Image Filters Free - Online Adjustments | ToolSathi',
                'seo_description' => 'Apply color filters, brightness, and contrast adjustments to images online.'
            ],
            [
                'category_id' => $imageCat->id,
                'name' => 'Passport Photo Maker',
                'slug' => 'passport-photo-maker',
                'description' => 'Crop and format photos to official passport size specifications.',
                'full_description' => 'Create compliant passport and visa photos with background color selection and custom dimensions.',
                'icon' => 'user',
                'route_name' => 'tools.image.passport-photo-maker',
                'processing_mode' => 'client',
                'component_key' => 'passport-photo-maker',
                'is_featured' => true,
                'seo_title' => 'Passport Photo Maker Online Free - Size & Crop | ToolSathi',
                'seo_description' => 'Create professional passport and ID photos online with ToolSathi.'
            ],
            [
                'category_id' => $imageCat->id,
                'name' => 'Image Metadata Viewer',
                'slug' => 'image-metadata-viewer',
                'description' => 'Inspect EXIF data, dimensions, format, and color properties of images.',
                'full_description' => 'Extract technical properties and EXIF metadata from uploaded image files.',
                'icon' => 'info',
                'route_name' => 'tools.image.image-metadata-viewer',
                'processing_mode' => 'client',
                'component_key' => 'image-metadata-viewer',
                'is_featured' => false,
                'seo_title' => 'EXIF & Image Metadata Viewer Online Free | ToolSathi',
                'seo_description' => 'Inspect EXIF metadata, camera settings, and dimensions of photos.'
            ],
            [
                'category_id' => $imageCat->id,
                'name' => 'Favicon Generator',
                'slug' => 'favicon-generator',
                'description' => 'Generate multi-resolution favicons, Apple touch icons, and web app manifests.',
                'full_description' => 'Create all required favicon formats and sizes from any logo image packaged as a ZIP download.',
                'icon' => 'globe',
                'route_name' => 'tools.image.favicon-generator',
                'processing_mode' => 'client',
                'component_key' => 'favicon-generator',
                'is_featured' => true,
                'seo_title' => 'Favicon Generator Free - Create ICO & PNG Favicons | ToolSathi',
                'seo_description' => 'Generate multi-resolution favicons and Apple touch icons for your website.'
            ]
        ];

        foreach ($tools as $toolData) {
            Tool::firstOrCreate(['slug' => $toolData['slug']], $toolData);
        }
    }
}
