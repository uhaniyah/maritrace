@extends('layouts.admin')
@section('title', 'Edit Kursus')
@section('page-title', 'Edit Kursus')
@section('page-subtitle', $course->title)

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-7">
        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kode Kursus <span class="text-red-500">*</span></label>
                    <input type="text" name="course_code" value="{{ old('course_code', $course->course_code) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm @error('course_code') border-red-500 @enderror" required>
                    @error('course_code')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Standar <span class="text-red-500">*</span></label>
                    <select name="standard_type" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                        @foreach(['STCW', 'IMO', 'Internal'] as $st)
                        <option value="{{ $st }}" {{ old('standard_type', $course->standard_type) === $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Kursus <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $course->title) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Kursus IMO</label>
                    <input type="text" name="imo_course_number" value="{{ old('imo_course_number', $course->imo_course_number) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                        @foreach(['Safety', 'Navigation', 'Radio Communications', 'Medical', 'Management', 'Tanker Operations', 'Security', 'Engineering'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $course->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Level <span class="text-red-500">*</span></label>
                    <select name="level" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                        @foreach(['Basic', 'Operational', 'Management', 'Rating'] as $lvl)
                        <option value="{{ $lvl }}" {{ old('level', $course->level) === $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Instruktur</label>
                    <select name="instructor_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        <option value="">Pilih Instruktur</option>
                        @foreach($instructors as $ins)
                        <option value="{{ $ins->id }}" {{ old('instructor_id', $course->instructor_id) == $ins->id ? 'selected' : '' }}>{{ $ins->full_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4">
                <div><label class="block text-sm font-semibold text-gray-700 mb-1">Durasi (Jam)</label><input type="number" name="duration_hours" value="{{ old('duration_hours', $course->duration_hours) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required></div>
                <div><label class="block text-sm font-semibold text-gray-700 mb-1">Durasi (Hari)</label><input type="number" name="duration_days" value="{{ old('duration_days', $course->duration_days) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required></div>
                <div><label class="block text-sm font-semibold text-gray-700 mb-1">Maks. Peserta</label><input type="number" name="max_participants" value="{{ old('max_participants', $course->max_participants) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required></div>
                <div><label class="block text-sm font-semibold text-gray-700 mb-1">Nilai Lulus (%)</label><input type="number" name="passing_score" value="{{ old('passing_score', $course->passing_score) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required></div>
            </div>
            <div><label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi <span class="text-red-500">*</span></label><textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>{{ old('description', $course->description) }}</textarea></div>
            <div><label class="block text-sm font-semibold text-gray-700 mb-1">Tujuan</label><textarea name="objectives" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('objectives', $course->objectives) }}</textarea></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-semibold text-gray-700 mb-1">Prasyarat</label><textarea name="prerequisites" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('prerequisites', $course->prerequisites) }}</textarea></div>
                <div><label class="block text-sm font-semibold text-gray-700 mb-1">Biaya (Rp)</label><input type="number" name="fee" value="{{ old('fee', $course->fee) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm"></div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                    @foreach(['active' => 'Aktif', 'draft' => 'Draft', 'inactive' => 'Nonaktif'] as $v => $l)
                    <option value="{{ $v }}" {{ old('status', $course->status) === $v ? 'selected' : '' }}>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('admin.courses.show', $course->id) }}" class="px-5 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-600 hover:bg-gray-50">Batal</a>
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-800"><i class="fas fa-save mr-2"></i>Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
