<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(
            ['email' => 'admin@toolsathi.com'],
            [
                'name' => 'ToolSathi Admin',
                'password' => bcrypt('password'),
            ]
        );

        // Default Settings
        $settings = [
            'site_name' => 'ToolSathi',
            'site_tagline' => 'Your Digital Tools Companion.',
            'primary_color' => '#E83E46',
            'charcoal_color' => '#242B36',
        ];

        // Default Ad Slots
        $adSlots = [
            ['name' => 'Homepage Banner', 'identifier' => 'homepage', 'code' => '<!-- Ad Slot Homepage -->', 'is_active' => true],
            ['name' => 'Category Page Banner', 'identifier' => 'category-page', 'code' => '<!-- Ad Slot Category -->', 'is_active' => true],
            ['name' => 'Tool Page Ad', 'identifier' => 'tool-page', 'code' => '<!-- Ad Slot Tool -->', 'is_active' => true],
            ['name' => 'Sidebar Widget', 'identifier' => 'sidebar', 'code' => '<!-- Ad Slot Sidebar -->', 'is_active' => true],
            ['name' => 'Footer Banner', 'identifier' => 'footer', 'code' => '<!-- Ad Slot Footer -->', 'is_active' => true],
        ];

        foreach ($adSlots as $slot) {
            \App\Models\AdSlot::firstOrCreate(['identifier' => $slot['identifier']], $slot);
        }

        // Categories (Required 7 categories)
        $pdfCat = \App\Models\Category::firstOrCreate(
            ['slug' => 'pdf-tools'],
            ['name' => 'PDF Tools', 'icon' => 'file-text', 'description' => 'Merge, split, compress, and convert PDF files securely.', 'sort_order' => 1]
        );

        $nepaliCat = \App\Models\Category::firstOrCreate(
            ['slug' => 'nepali-tools'],
            ['name' => 'Nepali Tools', 'icon' => 'calendar', 'description' => 'Nepali date converter, Unicode typing, and Nepali number to words.', 'sort_order' => 2]
        );

        $imageCat = \App\Models\Category::firstOrCreate(
            ['slug' => 'image-tools'],
            ['name' => 'Image Tools', 'icon' => 'image', 'description' => 'Compress, resize, crop, and convert image formats.', 'sort_order' => 3]
        );

        $calcCat = \App\Models\Category::firstOrCreate(
            ['slug' => 'calculators'],
            ['name' => 'Calculators', 'icon' => 'calculator', 'description' => 'Age calculator, percentage, EMI loan calculator, and financial tools.', 'sort_order' => 4]
        );

        $textCat = \App\Models\Category::firstOrCreate(
            ['slug' => 'text-tools'],
            ['name' => 'Text Tools', 'icon' => 'align-left', 'description' => 'Word counter, case converter, hash generator, and password generator.', 'sort_order' => 5]
        );

        $convCat = \App\Models\Category::firstOrCreate(
            ['slug' => 'converters'],
            ['name' => 'Converters', 'icon' => 'repeat', 'description' => 'JSON to CSV, Markdown to HTML, Base64 encoder, and QR generator.', 'sort_order' => 6]
        );

        $otherCat = \App\Models\Category::firstOrCreate(
            ['slug' => 'other-utilities'],
            ['name' => 'Other Utilities', 'icon' => 'tool', 'description' => 'Miscellaneous web utilities, generators, and developer helpers.', 'sort_order' => 7]
        );

        // Tools
        $tools = [
            // PDF Tools (12 tools)
            ['category_id' => $pdfCat->id, 'name' => 'Merge PDF', 'slug' => 'merge-pdf', 'description' => 'Combine multiple PDF files into a single document in seconds.', 'icon' => 'files', 'route_name' => 'tools.pdf.merge', 'is_featured' => true, 'component_key' => 'merge-pdf'],
            ['category_id' => $pdfCat->id, 'name' => 'Split PDF', 'slug' => 'split-pdf', 'description' => 'Extract pages or split a PDF into multiple separate files.', 'icon' => 'scissors', 'route_name' => 'tools.pdf.split', 'is_featured' => false, 'component_key' => 'split-pdf'],
            ['category_id' => $pdfCat->id, 'name' => 'Compress PDF', 'slug' => 'compress-pdf', 'description' => 'Reduce PDF file size while maintaining high quality.', 'icon' => 'minimize-2', 'route_name' => 'tools.pdf.compress', 'is_featured' => true, 'component_key' => 'compress-pdf'],
            ['category_id' => $pdfCat->id, 'name' => 'PDF to JPG', 'slug' => 'pdf-to-jpg', 'description' => 'Convert PDF pages into high-resolution JPG image files.', 'icon' => 'image', 'route_name' => 'tools.pdf.pdf-to-jpg', 'is_featured' => false, 'component_key' => 'pdf-to-jpg'],
            ['category_id' => $pdfCat->id, 'name' => 'JPG to PDF', 'slug' => 'jpg-to-pdf', 'description' => 'Convert JPG and PNG images into a professional PDF document.', 'icon' => 'file-plus', 'route_name' => 'tools.pdf.jpg-to-pdf', 'is_featured' => true, 'component_key' => 'jpg-to-pdf'],
            ['category_id' => $pdfCat->id, 'name' => 'Rotate PDF', 'slug' => 'rotate-pdf', 'description' => 'Rotate PDF pages 90, 180, or 270 degrees easily.', 'icon' => 'rotate-cw', 'route_name' => 'tools.pdf.rotate', 'is_featured' => false, 'component_key' => 'rotate-pdf'],
            ['category_id' => $pdfCat->id, 'name' => 'Protect PDF', 'slug' => 'protect-pdf', 'description' => 'Encrypt and password-protect your confidential PDF documents.', 'icon' => 'lock', 'route_name' => 'tools.pdf.protect', 'is_featured' => false, 'component_key' => 'protect-pdf'],
            ['category_id' => $pdfCat->id, 'name' => 'Unlock PDF', 'slug' => 'unlock-pdf', 'description' => 'Remove password security and encryption from PDF files.', 'icon' => 'unlock', 'route_name' => 'tools.pdf.unlock', 'is_featured' => false, 'component_key' => 'unlock-pdf'],
            ['category_id' => $pdfCat->id, 'name' => 'Add Watermark', 'slug' => 'add-watermark', 'description' => 'Stamp text or image watermarks across your PDF pages.', 'icon' => 'stamp', 'route_name' => 'tools.pdf.watermark', 'is_featured' => false, 'component_key' => 'add-watermark'],
            ['category_id' => $pdfCat->id, 'name' => 'Add Page Numbers', 'slug' => 'add-page-numbers', 'description' => 'Insert professional page numbers into any PDF document.', 'icon' => 'hash', 'route_name' => 'tools.pdf.page-numbers', 'is_featured' => false, 'component_key' => 'add-page-numbers'],
            ['category_id' => $pdfCat->id, 'name' => 'Organize PDF', 'slug' => 'organize-pdf', 'description' => 'Rearrange, sort, or delete pages within your PDF.', 'icon' => 'layout', 'route_name' => 'tools.pdf.organize', 'is_featured' => false, 'component_key' => 'organize-pdf'],
            ['category_id' => $pdfCat->id, 'name' => 'Extract PDF Pages', 'slug' => 'extract-pdf-pages', 'description' => 'Extract specific pages or page ranges into a new PDF.', 'icon' => 'external-link', 'route_name' => 'tools.pdf.extract', 'is_featured' => false, 'component_key' => 'extract-pdf-pages'],

            // Nepali Tools (10 tools)
            ['category_id' => $nepaliCat->id, 'name' => 'Preeti to Unicode Converter', 'slug' => 'preeti-to-unicode', 'description' => 'Convert legacy Preeti font text to standard Nepali Unicode effortlessly.', 'icon' => 'type', 'route_name' => 'tools.nepali.preeti-to-unicode', 'is_featured' => true, 'component_key' => 'preeti-to-unicode'],
            ['category_id' => $nepaliCat->id, 'name' => 'Unicode to Preeti Converter', 'slug' => 'unicode-to-preeti', 'description' => 'Convert standard Nepali Unicode text back to legacy Preeti font encoding.', 'icon' => 'repeat', 'route_name' => 'tools.nepali.unicode-to-preeti', 'is_featured' => false, 'component_key' => 'unicode-to-preeti'],
            ['category_id' => $nepaliCat->id, 'name' => 'Nepali Typing Tool', 'slug' => 'nepali-typing', 'description' => 'Easy online Nepali typing tool with instant preview and copy options.', 'icon' => 'edit-3', 'route_name' => 'tools.nepali.typing', 'is_featured' => true, 'component_key' => 'nepali-typing'],
            ['category_id' => $nepaliCat->id, 'name' => 'English to Nepali Transliteration', 'slug' => 'english-to-nepali', 'description' => 'Type English phonetics and automatically transliterate into Nepali.', 'icon' => 'globe', 'route_name' => 'tools.nepali.english-to-nepali', 'is_featured' => false, 'component_key' => 'english-to-nepali'],
            ['category_id' => $nepaliCat->id, 'name' => 'Nepali Date Converter', 'slug' => 'nepali-date-converter', 'description' => 'Convert Bikram Sambat (B.S.) to Gregorian (A.D.) accurately.', 'icon' => 'calendar', 'route_name' => 'tools.nepali.date-converter', 'is_featured' => true, 'component_key' => 'nepali-date-converter'],
            ['category_id' => $nepaliCat->id, 'name' => 'BS to AD Converter', 'slug' => 'bs-to-ad', 'description' => 'Convert Bikram Sambat dates to English AD calendar dates.', 'icon' => 'arrow-right-circle', 'route_name' => 'tools.nepali.bs-to-ad', 'is_featured' => false, 'component_key' => 'bs-to-ad'],
            ['category_id' => $nepaliCat->id, 'name' => 'AD to BS Converter', 'slug' => 'ad-to-bs', 'description' => 'Convert Gregorian AD dates to Bikram Sambat (BS) Nepali dates.', 'icon' => 'arrow-left-circle', 'route_name' => 'tools.nepali.ad-to-bs', 'is_featured' => false, 'component_key' => 'ad-to-bs'],
            ['category_id' => $nepaliCat->id, 'name' => 'Nepali Calendar', 'slug' => 'nepali-calendar', 'description' => 'Interactive Nepali calendar with months, days, and public holidays.', 'icon' => 'calendar-days', 'route_name' => 'tools.nepali.calendar', 'is_featured' => true, 'component_key' => 'nepali-calendar'],
            ['category_id' => $nepaliCat->id, 'name' => 'Nepali Number Converter', 'slug' => 'nepali-number-converter', 'description' => 'Convert numbers into Nepali words and Nepali currency format.', 'icon' => 'file-digit', 'route_name' => 'tools.nepali.number-to-words', 'is_featured' => false, 'component_key' => 'nepali-number-to-words'],
            ['category_id' => $nepaliCat->id, 'name' => 'Nepali Text Counter', 'slug' => 'nepali-text-counter', 'description' => 'Count words, characters, and sentences in Nepali text instantly.', 'icon' => 'bar-chart', 'route_name' => 'tools.nepali.text-counter', 'is_featured' => false, 'component_key' => 'nepali-text-counter'],

            // Image Tools (7 tools)
            ['category_id' => $imageCat->id, 'name' => 'Image Compressor', 'slug' => 'image-compressor', 'description' => 'Compress PNG, JPG, and WebP images instantly in your browser.', 'icon' => 'image', 'route_name' => 'tools.image.compressor', 'is_featured' => true, 'component_key' => 'image-compressor'],
            ['category_id' => $imageCat->id, 'name' => 'Image Resizer', 'slug' => 'image-resizer', 'description' => 'Resize images by dimensions or percentage with exact ratios.', 'icon' => 'maximize-2', 'route_name' => 'tools.image.resizer', 'is_featured' => false, 'component_key' => 'image-resizer'],
            ['category_id' => $imageCat->id, 'name' => 'Image Cropper', 'slug' => 'image-cropper', 'description' => 'Crop photos and pictures easily to any aspect ratio.', 'icon' => 'crop', 'route_name' => 'tools.image.cropper', 'is_featured' => false, 'component_key' => 'image-cropper'],
            ['category_id' => $imageCat->id, 'name' => 'PNG to JPG', 'slug' => 'png-to-jpg', 'description' => 'Convert transparent PNG images to JPG format securely.', 'icon' => 'file-image', 'route_name' => 'tools.image.png-to-jpg', 'is_featured' => false, 'component_key' => 'png-to-jpg'],
            ['category_id' => $imageCat->id, 'name' => 'JPG to PNG', 'slug' => 'jpg-to-png', 'description' => 'Convert JPG images to PNG format instantly.', 'icon' => 'file-image', 'route_name' => 'tools.image.jpg-to-png', 'is_featured' => false, 'component_key' => 'jpg-to-png'],
            ['category_id' => $imageCat->id, 'name' => 'Image to PDF', 'slug' => 'image-to-pdf', 'description' => 'Convert multiple JPG or PNG images into a PDF document.', 'icon' => 'file-plus', 'route_name' => 'tools.image.image-to-pdf', 'is_featured' => true, 'component_key' => 'image-to-pdf'],
            ['category_id' => $imageCat->id, 'name' => 'Image Format Converter', 'slug' => 'image-format-converter', 'description' => 'Convert images between PNG, JPG, and WebP formats.', 'icon' => 'repeat', 'route_name' => 'tools.image.format-converter', 'is_featured' => false, 'component_key' => 'image-format-converter'],

            // Calculator Tools (6 tools)
            ['category_id' => $calcCat->id, 'name' => 'Age Calculator', 'slug' => 'age-calculator', 'description' => 'Calculate precise age in years, months, weeks, days, hours, and minutes.', 'icon' => 'clock', 'route_name' => 'tools.calc.age', 'is_featured' => true, 'component_key' => 'age-calculator'],
            ['category_id' => $calcCat->id, 'name' => 'Percentage Calculator', 'slug' => 'percentage-calculator', 'description' => 'Quickly calculate discounts, markups, increases, and percentages.', 'icon' => 'percent', 'route_name' => 'tools.calc.percentage', 'is_featured' => false, 'component_key' => 'percentage-calculator'],
            ['category_id' => $calcCat->id, 'name' => 'EMI Calculator', 'slug' => 'emi-calculator', 'description' => 'Calculate loan monthly installments, interest, and amortization schedule.', 'icon' => 'dollar-sign', 'route_name' => 'tools.calc.emi', 'is_featured' => true, 'component_key' => 'emi-calculator'],
            ['category_id' => $calcCat->id, 'name' => 'Date Difference Calculator', 'slug' => 'date-difference-calculator', 'description' => 'Calculate exact number of days, weeks, months between two dates.', 'icon' => 'calendar-range', 'route_name' => 'tools.calc.date-difference', 'is_featured' => false, 'component_key' => 'date-difference-calculator'],
            ['category_id' => $calcCat->id, 'name' => 'Time Calculator', 'slug' => 'time-calculator', 'description' => 'Add or subtract hours, minutes, and seconds between times.', 'icon' => 'watch', 'route_name' => 'tools.calc.time', 'is_featured' => false, 'component_key' => 'time-calculator'],
            ['category_id' => $calcCat->id, 'name' => 'Unit Converter', 'slug' => 'unit-converter', 'description' => 'Convert units of length, weight, temperature, and area.', 'icon' => 'sliders', 'route_name' => 'tools.calc.unit', 'is_featured' => false, 'component_key' => 'unit-converter'],

            // Text Tools & Other Utilities
            ['category_id' => $textCat->id, 'name' => 'Word Counter', 'slug' => 'word-counter', 'description' => 'Count words, characters, sentences, and reading time in real-time.', 'icon' => 'bar-chart-2', 'route_name' => 'tools.text.word-counter', 'is_featured' => true, 'component_key' => 'word-counter'],
            ['category_id' => $textCat->id, 'name' => 'Character Counter', 'slug' => 'character-counter', 'description' => 'Count characters and spaces in text instantly.', 'icon' => 'hash', 'route_name' => 'tools.text.character-counter', 'is_featured' => false, 'component_key' => 'character-counter'],
            ['category_id' => $textCat->id, 'name' => 'Password Generator', 'slug' => 'password-generator', 'description' => 'Generate secure, random cryptographic passwords with custom options.', 'icon' => 'lock', 'route_name' => 'tools.text.password-generator', 'is_featured' => true, 'component_key' => 'password-generator'],
            ['category_id' => $textCat->id, 'name' => 'Nepali Text Counter', 'slug' => 'nepali-text-counter', 'description' => 'Count words and characters in Nepali Unicode text.', 'icon' => 'bar-chart', 'route_name' => 'tools.text.nepali-text-counter', 'is_featured' => false, 'component_key' => 'nepali-text-counter'],

            // Other Utilities / Converters
            ['category_id' => $convCat->id, 'name' => 'QR Code Generator', 'slug' => 'qr-code-generator', 'description' => 'Generate high-resolution custom QR codes for URLs, text, and WiFi.', 'icon' => 'qr-code', 'route_name' => 'tools.conv.qr', 'is_featured' => true, 'component_key' => 'qr-code-generator'],
        ];

        foreach ($tools as $toolData) {
            \App\Models\Tool::firstOrCreate(['slug' => $toolData['slug']], $toolData);
        }

        $this->call(ToolSeoSeeder::class);
        $this->call(Batch1PdfSeeder::class);
        $this->call(Batch2ImageSeeder::class);
        $this->call(Batch3TextSeeder::class);
        $this->call(Batch4DeveloperSeeder::class);
        $this->call(Batch5CalculatorSeeder::class);
        $this->call(NepaliUnicodeSeeder::class);
        $this->call(Module5AgeCalculatorSeeder::class);
        $this->call(Module6LandConverterSeeder::class);
        $this->call(VehicleTaxRulesSeeder::class);
        $this->call(Module8VehicleTaxSeeder::class);
        $this->call(NepaliFontsSeeder::class);
        $this->call(PhaseBNepaliToolsSeeder::class);
        $this->call(DocumentEditorSeeder::class);
        $this->call(ImageMakerSeeder::class);
    }
}
