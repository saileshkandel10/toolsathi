<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;

class ToolSeoSeeder extends Seeder
{
    public function run(): void
    {
        $seoData = [
            'merge-pdf' => [
                'seo_title' => 'Merge PDF Online Free - Combine PDF Files Instantly | ToolSathi',
                'seo_description' => 'Combine multiple PDF files into a single document in seconds with ToolSathi free online PDF merger. Fast, secure, and client-side processing.',
                'full_description' => 'ToolSathi Merge PDF is a powerful, secure, and completely free online utility that allows you to combine multiple PDF files into one clean document without uploading your sensitive files to a server. Operating entirely in your browser using cutting-edge client-side technology, it ensures 100% privacy and lightning-fast speed. Simply drag and drop your PDFs, reorder them as needed, and click merge to download your unified document instantly.'
            ],
            'split-pdf' => [
                'seo_title' => 'Split PDF Online - Extract Pages from PDF Free | ToolSathi',
                'seo_description' => 'Split PDF documents or extract specific page ranges quickly and securely with ToolSathi free online PDF splitter.',
                'full_description' => 'Extract specific pages or break large PDF files into smaller documents effortlessly with ToolSathi Split PDF. Designed for maximum security, your files are processed locally in your browser. Whether you need single pages, custom ranges like 1-3, or individual files, our tool delivers accurate results in seconds.'
            ],
            'compress-pdf' => [
                'seo_title' => 'Compress PDF Online Free - Reduce PDF File Size | ToolSathi',
                'seo_description' => 'Reduce PDF file size while maintaining high document quality with ToolSathi free online PDF compressor.',
                'full_description' => 'Need to email or upload a bulky PDF? ToolSathi Compress PDF optimizes document structures and removes unnecessary data streams to shrink your file size safely in your browser. No registration required, 100% free and private.'
            ],
            'preeti-to-unicode' => [
                'seo_title' => 'Preeti to Unicode Converter - Free Nepali Font Converter | ToolSathi',
                'seo_description' => 'Convert legacy Preeti font text to standard Nepali Unicode instantly with ToolSathi accurate Preeti to Unicode converter.',
                'full_description' => 'ToolSathi Preeti to Unicode converter is the most accurate legacy font converter for the Nepali language. Transform old Preeti text into modern Nepali Unicode for social media, news portals, and official documents with perfect handling of matras, conjuncts, and reph.'
            ],
            'nepali-date-converter' => [
                'seo_title' => 'Nepali Date Converter - BS to AD & AD to BS | ToolSathi',
                'seo_description' => 'Convert Bikram Sambat (BS) to Gregorian English calendar (AD) and vice versa instantly with ToolSathi Nepali date converter.',
                'full_description' => 'Accurately convert dates between Bikram Sambat (B.S.) and Gregorian calendar (A.D.) with ToolSathi Nepali Date Converter. Built with verified calendar datasets for seamless government, banking, and personal date calculations.'
            ],
            'age-calculator' => [
                'seo_title' => 'Age Calculator - Calculate Exact Age in Years & Months | ToolSathi',
                'seo_description' => 'Calculate precise age in years, months, weeks, days, hours, and minutes from your date of birth with ToolSathi age calculator.',
                'full_description' => 'ToolSathi Age Calculator gives you the exact age breakdown down to the day, hour, and minute. Perfect for official forms, genealogy, and birthday countdowns. Fast, free, and accurate.'
            ],
            'password-generator' => [
                'seo_title' => 'Secure Password Generator - Create Strong Passwords | ToolSathi',
                'seo_description' => 'Generate secure, random cryptographic passwords with custom uppercase, lowercase, numbers, and symbols using ToolSathi password generator.',
                'full_description' => 'Protect your online accounts with ToolSathi Secure Password Generator. Customize length and character sets to generate uncrackable cryptographic passwords instantly.'
            ],
            'qr-code-generator' => [
                'seo_title' => 'Free QR Code Generator - Create Custom QR Codes | ToolSathi',
                'seo_description' => 'Generate high-resolution custom QR codes for URLs, text, and Wi-Fi instantly with ToolSathi free QR code generator.',
                'full_description' => 'Create scannable, high-resolution QR codes for website URLs, business cards, Wi-Fi networks, and plain text with ToolSathi QR Code Generator. Download PNG instantly.'
            ],
            'word-counter' => [
                'seo_title' => 'Word & Character Counter - Free Online Text Stats | ToolSathi',
                'seo_description' => 'Count words, characters, sentences, and reading time in real-time with ToolSathi free online word and character counter.',
                'full_description' => 'ToolSathi Word Counter provides instant text statistics including word count, character count, sentence count, and estimated reading time. Ideal for writers, students, and SEO professionals.'
            ],
            'emi-calculator' => [
                'seo_title' => 'EMI Calculator - Loan Monthly Installment Calculator | ToolSathi',
                'seo_description' => 'Calculate loan monthly installments (EMI), total interest, and payment breakdown with ToolSathi free EMI loan calculator.',
                'full_description' => 'Plan your finances effectively with ToolSathi EMI Calculator. Calculate monthly mortgage or loan payments, total interest payable, and amortization schedules in seconds.'
            ]
        ];

        foreach ($seoData as $slug => $data) {
            Tool::where('slug', $slug)->update($data);
        }
    }
}
