@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="gpaTool()">
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ url('/') }}" class="hover:text-[#E83E46]">Home</a>
        <span>/</span>
        <a href="{{ url('/' . $category->slug) }}" class="hover:text-[#E83E46]">{{ $category->name }}</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">{{ $tool->name }}</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8 mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-[#E83E46] flex items-center justify-center">
                <i data-lucide="{{ $tool->icon ?? 'award' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="space-y-4 mb-6">
            <template x-for="(sub, index) in subjects" :key="index">
                <div class="flex items-center space-x-4 bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <input type="text" x-model="sub.name" placeholder="Subject Name" class="bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm flex-grow">
                    <input type="number" x-model.number="sub.credits" placeholder="Credits" class="w-24 bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <select x-model.number="sub.grade" class="w-28 bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm">
                        <option value="4.0">A (4.0)</option>
                        <option value="3.6">A- (3.6)</option>
                        <option value="3.0">B (3.0)</option>
                        <option value="2.0">C (2.0)</option>
                        <option value="1.0">D (1.0)</option>
                        <option value="0.0">F (0.0)</option>
                    </select>
                    <button @click="subjects.splice(index, 1)" class="text-red-500 font-bold text-lg">&times;</button>
                </div>
            </template>
        </div>

        <div class="flex space-x-4 mb-6">
            <button @click="subjects.push({name:'', credits:3, grade:4.0})" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold px-4 py-2 rounded-xl text-sm transition">+ Add Subject</button>
            <button @click="calculateGpa" class="bg-[#E83E46] text-white font-semibold px-6 py-2 rounded-xl text-sm hover:bg-[#d23239] transition">Calculate GPA</button>
        </div>

        <div class="p-6 bg-red-50 rounded-2xl border border-red-100 text-center" x-show="gpa !== null" x-cloak>
            <div class="text-xs font-semibold text-[#E83E46] uppercase mb-1">Cumulative GPA</div>
            <div class="text-3xl font-extrabold text-gray-900" x-text="gpa"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function gpaTool() {
    return {
        subjects: [
            { name: 'Mathematics', credits: 4, grade: 4.0 },
            { name: 'Physics', credits: 3, grade: 3.6 }
        ],
        gpa: '3.83',
        calculateGpa() {
            let totalPoints = 0;
            let totalCredits = 0;
            for (let s of this.subjects) {
                totalPoints += (parseFloat(s.grade) || 0) * (parseFloat(s.credits) || 0);
                totalCredits += parseFloat(s.credits) || 0;
            }
            this.gpa = totalCredits > 0 ? (totalPoints / totalCredits).toFixed(2) : '0.00';
        }
    }
}
</script>
@endpush
@endsection