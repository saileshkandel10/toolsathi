<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Category;

class PhaseBNepaliToolsSeeder extends Seeder
{
    public function run(): void
    {
        $nepaliCat = Category::where('slug', 'nepali-tools')->first();
        if (!$nepaliCat) return;

        Tool::updateOrCreate(
            ['slug' => 'easy-nepali-typing'],
            [
                'category_id' => $nepaliCat->id,
                'name' => 'Easy Nepali Typing',
                'slug' => 'easy-nepali-typing',
                'description' => 'Type Nepali online using an English keyboard with real-time Roman-to-Unicode transliteration and suggestions.',
                'full_description' => 'Professional Romanized Nepali typing workspace with real-time transliteration, multiple typing modes, and Preeti export.',
                'icon' => 'edit-3',
                'route_name' => 'tools.nepali.easy-typing',
                'processing_mode' => 'client',
                'component_key' => 'easy-nepali-typing',
                'is_featured' => true,
                'seo_title' => 'Easy Nepali Typing Online – Roman to Nepali Unicode | ToolSathi',
                'seo_description' => 'Type Nepali online using an English keyboard. Convert Roman Nepali into Unicode with live suggestions, editing, copy and download features.'
            ]
        );

        Tool::updateOrCreate(
            ['slug' => 'nepali-voice-typing'],
            [
                'category_id' => $nepaliCat->id,
                'name' => 'Nepali Voice Typing',
                'slug' => 'nepali-voice-typing',
                'description' => 'Speak in Nepali and convert your speech into editable Nepali Unicode text.',
                'full_description' => 'Speech-to-text voice typing tool for Nepali language using supported browser speech recognition APIs.',
                'icon' => 'mic',
                'route_name' => 'tools.nepali.voice-typing',
                'processing_mode' => 'client',
                'component_key' => 'nepali-voice-typing',
                'is_featured' => true,
                'seo_title' => 'Nepali Voice Typing Online – Speech to Nepali Text | ToolSathi',
                'seo_description' => 'Speak in Nepali and convert your speech into editable Nepali Unicode text using supported browser speech recognition.'
            ]
        );
    }
}
