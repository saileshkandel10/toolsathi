@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <h1 class="text-3xl font-extrabold text-[#242B36] mb-6">{{ $page->title }}</h1>
        <div class="prose max-w-none text-gray-700 space-y-4 text-sm leading-relaxed">
            {!! nl2br(e($page->content)) !!}
        </div>
    </div>
</div>
@endsection