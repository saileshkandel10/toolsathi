<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Category;

class DocumentEditorSeeder extends Seeder
{
    public function run(): void
    {
        $nepaliCat = Category::where('slug', 'nepali-tools')->first();
        if (!$nepaliCat) return;

        Tool::updateOrCreate(
            ['slug' => 'nepali-document-editor'],
            [
                'category_id' => $nepaliCat->id,
                'name' => 'Nepali Online Document Editor',
                'slug' => 'nepali-document-editor',
                'description' => 'Create, edit, format, and download Nepali and English documents online with rich text formatting and DOCX/PDF export.',
                'full_description' => 'Professional browser-based Nepali word processor supporting Romanized typing, Unicode editing, formatting, and document exports.',
                'icon' => 'file-text',
                'route_name' => 'tools.nepali.document-editor',
                'processing_mode' => 'client',
                'component_key' => 'nepali-document-editor',
                'is_featured' => true,
                'seo_title' => 'Nepali Online Document Editor – Type, Edit and Download Nepali Documents | ToolSathi',
                'seo_description' => 'Create, edit, format and download Nepali and English documents online. Type in Nepali using Romanized typing, format your documents and export them as DOCX, PDF or TXT.'
            ]
        );
    }
}
