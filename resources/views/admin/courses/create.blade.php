@extends('layouts.admin')
@section('title', 'Tambah Kursus')
@section('page-title', 'Tambah Kursus Baru')
@section('page-subtitle', 'Buat program pelatihan STCW/IMO baru')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-7">
        <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-5">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kode Kursus <span class="text-red-500">*</span></label>
                    <input type="text" name="course_code" value="{{ old('course_code') }}" placeholder="BST-001" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm @error('course_code') border-red-500 @enderror" required>
                    @error('course_code')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Standar <span class="text-red-500">*</span></label>
                    <select name="standard_type" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm @error('standard_type') border-red-500 @enderror" required>
                        <option value="">Pilih Standar</option>
                        <option value="STCW" {{ old('standard_type') === 'STCW' ? 'selected' : '' }}>STCW</option>
                        <option value="IMO" {{ old('standard_type') === 'IMO' ? 'selected' : '' }}>IMO</option>
                        <option value="Internal" {{ old('standard_type') === 'Internal' ? 'selected' : '' }}>Internal</option>
                    </select>
                    @error('standard_type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Kursus <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Basic Safety Training (BST)" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm @error('title') border-red-500 @enderror" required>
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Kursus IMO</label>
                    <input type="text" name="imo_course_number" value="{{ old('imo_course_number') }}" placeholder="IMO 1.19" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                        <option value="">Pilih Kategori</option>
                        @foreach(['Safety', 'Navigation', 'Radio Communications', 'Medical', 'Management', 'Tanker Operations', 'Security', 'Engineering'] as $cat)
                        <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Level <span class="text-red-500">*</span></label>
                    <select name="level" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                        <option value="">Pilih Level</option>
                        @foreach(['Basic', 'Operational', 'Management', 'Rating'] as $lvl)
                        <option value="{{ $lvl }}" {{ old('level') === $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Instruktur</label>
                    <select name="instructor_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        <option value="">Pilih Instruktur</option>
                        @foreach($instructors as $ins)
                        <option value="{{ $ins->id }}" {{ old('instructor_id') == $ins->id ? 'selected' : '' }}>{{ $ins->full_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Durasi (Jam) <span class="text-red-500">*</span></label>
                    <input type="number" name="duration_hours" value="{{ old('duration_hours') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required min="1">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Durasi (Hari) <span class="text-red-500">*</span></label>
                    <input type="number" name="duration_days" value="{{ old('duration_days') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required min="1">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Maks. Peserta <span class="text-red-500">*</span></label>
                    <input type="number" name="max_participants" value="{{ old('max_participants', 20) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required min="1">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nilai Lulus (%) <span class="text-red-500">*</span></label>
                    <input type="number" name="passing_score" value="{{ old('passing_score', 75) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required min="0" max="100">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Kursus <span class="text-red-500">*</span></label>
                <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tujuan Pembelajaran</label>
                <textarea name="objectives" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('objectives') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Prasyarat</label>
                    <textarea name="prerequisites" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('prerequisites') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Biaya Pelatihan (Rp)</label>
                    <input type="number" name="fee" value="{{ old('fee') }}" step="50000" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                    <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('admin.courses.index') }}" class="px-5 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-600 hover:bg-gray-50">Batal</a>
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-800"><i class="fas fa-save mr-2"></i>Simpan Kursus</button>
            </div>
        </form>
    </div>
</div>
@endsection
