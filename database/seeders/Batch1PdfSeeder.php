<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Category;

class Batch1PdfSeeder extends Seeder
{
    public function run(): void
    {
        $pdfCat = Category::where('slug', 'pdf-tools')->first();
        if (!$pdfCat) return;

        $tools = [
            [
                'category_id' => $pdfCat->id,
                'name' => 'PDF to Word',
                'slug' => 'pdf-to-word',
                'description' => 'Convert PDF documents into editable Word (DOCX) files securely.',
                'full_description' => 'ToolSathi PDF to Word converter extracts text and layout formatting into clean Microsoft Word DOCX documents.',
                'icon' => 'file-text',
                'route_name' => 'tools.pdf.pdf-to-word',
                'processing_mode' => 'server',
                'component_key' => 'pdf-to-word',
                'is_featured' => true,
                'seo_title' => 'PDF to Word Converter Free - Edit PDF as DOCX | ToolSathi',
                'seo_description' => 'Convert PDF documents to editable Word DOCX format online for free with ToolSathi.'
            ],
            [
                'category_id' => $pdfCat->id,
                'name' => 'PDF to Excel',
                'slug' => 'pdf-to-excel',
                'description' => 'Extract tables and data from PDF into editable Excel spreadsheets.',
                'full_description' => 'Convert PDF tabular data into structured Excel XLSX spreadsheets instantly.',
                'icon' => 'table',
                'route_name' => 'tools.pdf.pdf-to-excel',
                'processing_mode' => 'server',
                'component_key' => 'pdf-to-excel',
                'is_featured' => false,
                'seo_title' => 'PDF to Excel Converter Free - Extract Tables to XLSX | ToolSathi',
                'seo_description' => 'Convert PDF tables into Excel spreadsheets online for free with ToolSathi.'
            ],
            [
                'category_id' => $pdfCat->id,
                'name' => 'PDF to PowerPoint',
                'slug' => 'pdf-to-powerpoint',
                'description' => 'Convert PDF presentations into editable PPTX slide decks.',
                'full_description' => 'Transform PDF pages into professional PowerPoint slide presentations.',
                'icon' => 'presentation',
                'route_name' => 'tools.pdf.pdf-to-powerpoint',
                'processing_mode' => 'server',
                'component_key' => 'pdf-to-powerpoint',
                'is_featured' => false,
                'seo_title' => 'PDF to PowerPoint Converter Free - PPTX Slides | ToolSathi',
                'seo_description' => 'Convert PDF documents to PowerPoint PPTX slide decks online.'
            ],
            [
                'category_id' => $pdfCat->id,
                'name' => 'Word to PDF',
                'slug' => 'word-to-pdf',
                'description' => 'Convert DOC and DOCX Word documents into professional PDF files.',
                'full_description' => 'Convert Microsoft Word documents into secure, standardized PDF files instantly.',
                'icon' => 'file-code',
                'route_name' => 'tools.pdf.word-to-pdf',
                'processing_mode' => 'server',
                'component_key' => 'word-to-pdf',
                'is_featured' => true,
                'seo_title' => 'Word to PDF Converter Free - DOCX to PDF | ToolSathi',
                'seo_description' => 'Convert Word documents to PDF online for free with ToolSathi.'
            ],
            [
                'category_id' => $pdfCat->id,
                'name' => 'Excel to PDF',
                'slug' => 'excel-to-pdf',
                'description' => 'Convert XLS and XLSX spreadsheets into formatted PDF documents.',
                'full_description' => 'Transform Excel spreadsheets into clean, printable PDF documents.',
                'icon' => 'file-spreadsheet',
                'route_name' => 'tools.pdf.excel-to-pdf',
                'processing_mode' => 'server',
                'component_key' => 'excel-to-pdf',
                'is_featured' => false,
                'seo_title' => 'Excel to PDF Converter Free - XLSX to PDF | ToolSathi',
                'seo_description' => 'Convert Excel spreadsheets to PDF online with ToolSathi.'
            ],
            [
                'category_id' => $pdfCat->id,
                'name' => 'PowerPoint to PDF',
                'slug' => 'powerpoint-to-pdf',
                'description' => 'Convert PPT and PPTX slide presentations into PDF documents.',
                'full_description' => 'Convert PowerPoint presentations into universally viewable PDF files.',
                'icon' => 'file-slides',
                'route_name' => 'tools.pdf.powerpoint-to-pdf',
                'processing_mode' => 'server',
                'component_key' => 'powerpoint-to-pdf',
                'is_featured' => false,
                'seo_title' => 'PowerPoint to PDF Converter Free - PPTX to PDF | ToolSathi',
                'seo_description' => 'Convert PowerPoint slides to PDF online with ToolSathi.'
            ],
            [
                'category_id' => $pdfCat->id,
                'name' => 'PDF Page Size Converter',
                'slug' => 'pdf-page-size',
                'description' => 'Change PDF page dimensions between A4, Letter, Legal, and Custom sizes.',
                'full_description' => 'Resize PDF pages to standard paper formats like A4, Letter, or custom dimensions securely in your browser.',
                'icon' => 'maximize',
                'route_name' => 'tools.pdf.pdf-page-size',
                'processing_mode' => 'client',
                'component_key' => 'pdf-page-size',
                'is_featured' => false,
                'seo_title' => 'PDF Page Size Converter Free - Change to A4/Letter | ToolSathi',
                'seo_description' => 'Change PDF page dimensions online in your browser for free.'
            ],
            [
                'category_id' => $pdfCat->id,
                'name' => 'Repair PDF',
                'slug' => 'repair-pdf',
                'description' => 'Recover data from corrupted or damaged PDF document files.',
                'full_description' => 'Analyze and reconstruct damaged or corrupted PDF structure trees locally in your browser.',
                'icon' => 'tool',
                'route_name' => 'tools.pdf.repair-pdf',
                'processing_mode' => 'client',
                'component_key' => 'repair-pdf',
                'is_featured' => false,
                'seo_title' => 'Repair Damaged PDF Online Free - Fix Corrupted PDF | ToolSathi',
                'seo_description' => 'Recover data and fix corrupted PDF files online with ToolSathi.'
            ],
            [
                'category_id' => $pdfCat->id,
                'name' => 'Compare PDF',
                'slug' => 'compare-pdf',
                'description' => 'Compare two PDF documents side-by-side to highlight text differences.',
                'full_description' => 'Detect text changes and differences between two PDF files instantly.',
                'icon' => 'git-compare',
                'route_name' => 'tools.pdf.compare-pdf',
                'processing_mode' => 'client',
                'component_key' => 'compare-pdf',
                'is_featured' => false,
                'seo_title' => 'Compare PDF Documents Online Free - Diff Tool | ToolSathi',
                'seo_description' => 'Compare two PDF files side by side and find text differences.'
            ],
            [
                'category_id' => $pdfCat->id,
                'name' => 'PDF Metadata Editor',
                'slug' => 'pdf-metadata-editor',
                'description' => 'View and edit PDF title, author, subject, keywords, and creation dates.',
                'full_description' => 'Modify document properties and metadata tags of any PDF file directly in your browser.',
                'icon' => 'edit',
                'route_name' => 'tools.pdf.pdf-metadata-editor',
                'processing_mode' => 'client',
                'component_key' => 'pdf-metadata-editor',
                'is_featured' => false,
                'seo_title' => 'PDF Metadata Editor Free - Change PDF Properties | ToolSathi',
                'seo_description' => 'Edit PDF title, author, and keywords online without installation.'
            ]
        ];

        foreach ($tools as $toolData) {
            Tool::firstOrCreate(['slug' => $toolData['slug']], $toolData);
        }
    }
}
