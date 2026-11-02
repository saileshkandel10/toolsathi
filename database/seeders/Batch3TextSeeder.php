<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Category;

class Batch3TextSeeder extends Seeder
{
    public function run(): void
    {
        $textCat = Category::where('slug', 'text-tools')->first();
        if (!$textCat) return;

        $tools = [
            [
                'category_id' => $textCat->id,
                'name' => 'Case Converter',
                'slug' => 'case-converter',
                'description' => 'Convert text between uppercase, lowercase, title case, and sentence case.',
                'full_description' => 'Easily change text casing to uppercase, lowercase, title case, sentence case, or toggle case instantly.',
                'icon' => 'edit-3',
                'route_name' => 'tools.text.case-converter',
                'processing_mode' => 'client',
                'component_key' => 'case-converter',
                'is_featured' => true,
                'seo_title' => 'Case Converter Free - Uppercase, Lowercase & Title Case | ToolSathi',
                'seo_description' => 'Convert text case online to uppercase, lowercase, title case, and sentence case.'
            ],
            [
                'category_id' => $textCat->id,
                'name' => 'Remove Duplicate Lines',
                'slug' => 'remove-duplicate-lines',
                'description' => 'Clean lists by removing duplicate lines while preserving order.',
                'full_description' => 'Quickly filter text lists by eliminating duplicate entries, removing empty lines, and matching case.',
                'icon' => 'list',
                'route_name' => 'tools.text.remove-duplicate-lines',
                'processing_mode' => 'client',
                'component_key' => 'remove-duplicate-lines',
                'is_featured' => false,
                'seo_title' => 'Remove Duplicate Lines Free - Clean Lists Online | ToolSathi',
                'seo_description' => 'Remove duplicate lines from text lists instantly online with ToolSathi.'
            ],
            [
                'category_id' => $textCat->id,
                'name' => 'Text Sorter',
                'slug' => 'text-sorter',
                'description' => 'Sort text lines alphabetically, numerically, or by line length.',
                'full_description' => 'Organize text lists alphabetically (A-Z, Z-A), numerically, or by line length in ascending or descending order.',
                'icon' => 'arrow-down-up',
                'route_name' => 'tools.text.text-sorter',
                'processing_mode' => 'client',
                'component_key' => 'text-sorter',
                'is_featured' => false,
                'seo_title' => 'Text Sorter Online Free - Alphabetical & Numeric Sort | ToolSathi',
                'seo_description' => 'Sort lines of text alphabetically or numerically online for free.'
            ],
            [
                'category_id' => $textCat->id,
                'name' => 'Text Reverser',
                'slug' => 'text-reverser',
                'description' => 'Reverse text strings, words, word order, or line sequence.',
                'full_description' => 'Reverse entire text strings, individual words, word order, or line order while preserving breaks.',
                'icon' => 'rotate-ccw',
                'route_name' => 'tools.text.text-reverser',
                'processing_mode' => 'client',
                'component_key' => 'text-reverser',
                'is_featured' => false,
                'seo_title' => 'Text Reverser Free - Reverse Words & Letters Online | ToolSathi',
                'seo_description' => 'Reverse letters, words, and lines of text instantly online.'
            ],
            [
                'category_id' => $textCat->id,
                'name' => 'Find and Replace',
                'slug' => 'find-and-replace',
                'description' => 'Search and replace specific words or phrases in text with counts.',
                'full_description' => 'Find and replace text strings with case-sensitive and whole-word matching options.',
                'icon' => 'search',
                'route_name' => 'tools.text.find-and-replace',
                'processing_mode' => 'client',
                'component_key' => 'find-and-replace',
                'is_featured' => true,
                'seo_title' => 'Find and Replace Text Online Free | ToolSathi',
                'seo_description' => 'Find and replace text strings instantly online with match counts.'
            ],
            [
                'category_id' => $textCat->id,
                'name' => 'JSON Formatter',
                'slug' => 'json-formatter',
                'description' => 'Format, beautify, and minify JSON data with syntax validation.',
                'full_description' => 'Beautify messy JSON data, validate syntax structure, and minify payloads easily.',
                'icon' => 'code',
                'route_name' => 'tools.text.json-formatter',
                'processing_mode' => 'client',
                'component_key' => 'json-formatter',
                'is_featured' => true,
                'seo_title' => 'JSON Formatter & Beautifier Online Free | ToolSathi',
                'seo_description' => 'Format, validate, and minify JSON payloads instantly in your browser.'
            ],
            [
                'category_id' => $textCat->id,
                'name' => 'JSON Validator',
                'slug' => 'json-validator',
                'description' => 'Verify JSON syntax validity and pinpoint parsing errors.',
                'full_description' => 'Check JSON string validity and receive clear parsing error reports.',
                'icon' => 'check-circle',
                'route_name' => 'tools.text.json-validator',
                'processing_mode' => 'client',
                'component_key' => 'json-validator',
                'is_featured' => false,
                'seo_title' => 'JSON Validator Free - Check JSON Syntax | ToolSathi',
                'seo_description' => 'Validate JSON data structure and detect syntax errors online.'
            ],
            [
                'category_id' => $textCat->id,
                'name' => 'XML Formatter',
                'slug' => 'xml-formatter',
                'description' => 'Format, beautify, and validate XML markup documents.',
                'full_description' => 'Beautify XML markup with custom indentation and syntax validation.',
                'icon' => 'file-code',
                'route_name' => 'tools.text.xml-formatter',
                'processing_mode' => 'client',
                'component_key' => 'xml-formatter',
                'is_featured' => false,
                'seo_title' => 'XML Formatter & Beautifier Online Free | ToolSathi',
                'seo_description' => 'Format and validate XML markup documents instantly.'
            ],
            [
                'category_id' => $textCat->id,
                'name' => 'HTML Formatter',
                'slug' => 'html-formatter',
                'description' => 'Format and beautify HTML code with proper indentation.',
                'full_description' => 'Beautify HTML source code and structure markup cleanly.',
                'icon' => 'code',
                'route_name' => 'tools.text.html-formatter',
                'processing_mode' => 'client',
                'component_key' => 'html-formatter',
                'is_featured' => false,
                'seo_title' => 'HTML Formatter & Beautifier Free | ToolSathi',
                'seo_description' => 'Format HTML code and structure markup online for free.'
            ],
            [
                'category_id' => $textCat->id,
                'name' => 'Markdown to HTML',
                'slug' => 'markdown-to-html',
                'description' => 'Convert Markdown text into clean rendered HTML with live preview.',
                'full_description' => 'Convert Markdown syntax into HTML markup with live preview and sanitization.',
                'icon' => 'file-text',
                'route_name' => 'tools.text.markdown-to-html',
                'processing_mode' => 'client',
                'component_key' => 'markdown-to-html',
                'is_featured' => true,
                'seo_title' => 'Markdown to HTML Converter Online Free | ToolSathi',
                'seo_description' => 'Convert Markdown to HTML with live preview and syntax support.'
            ]
        ];

        foreach ($tools as $toolData) {
            Tool::firstOrCreate(['slug' => $toolData['slug']], $toolData);
        }
    }
}
