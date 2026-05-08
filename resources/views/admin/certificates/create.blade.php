@extends('layouts.admin')
@section('title', 'Terbitkan Sertifikat')
@section('page-title', 'Terbitkan Sertifikat Baru')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-7">
        <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Peserta Didik <span class="text-red-500">*</span></label>
                    <select name="student_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm @error('student_id') border-red-500 @enderror" required>
                        <option value="">Pilih Peserta</option>
                        @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->full_name }} ({{ $student->student_id }})</option>
                        @endforeach
                    </select>
                    @error('student_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kursus / Diklat <span class="text-red-500">*</span></label>
                    <select name="course_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm @error('course_id') border-red-500 @enderror" required>
                        <option value="">Pilih Kursus</option>
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                        @endforeach
                    </select>
                    @error('course_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Sertifikat <span class="text-red-500">*</span></label>
                    <input type="text" name="certificate_number" value="{{ old('certificate_number') }}" placeholder="Ex: 6201/STCW/2024" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm @error('certificate_number') border-red-500 @enderror" required>
                    @error('certificate_number')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Otoritas Penerbit <span class="text-red-500">*</span></label>
                    <input type="text" name="issuing_authority" value="{{ old('issuing_authority', 'Politeknik Pelayaran Barombong') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Terbit <span class="text-red-500">*</span></label>
                    <input type="date" name="issued_date" value="{{ old('issued_date', date('Y-m-d')) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Kedaluwarsa <span class="text-red-500">*</span></label>
                    <input type="date" name="expiry_date" value="{{ old('expiry_date') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Regulasi STCW</label>
                    <input type="text" name="stcw_regulation" value="{{ old('stcw_regulation') }}" placeholder="Ex: Regulation VI/1" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                        <option value="valid" {{ old('status') == 'valid' ? 'selected' : '' }}>Valid</option>
                        <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="revoked" {{ old('status') == 'revoked' ? 'selected' : '' }}>Dicabut</option>
                        <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Ditangguhkan</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">File Sertifikat (PDF/Gambar)</label>
                <input type="file" name="certificate_file" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm @error('certificate_file') border-red-500 @enderror">
                <p class="text-gray-500 text-xs mt-1">Maksimal 5MB. Format: PDF, JPG, PNG.</p>
                @error('certificate_file')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Catatan Tambahan</label>
                <textarea name="notes" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('notes') }}</textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('admin.certificates.index') }}" class="px-5 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-600">Batal</a>
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-800"><i class="fas fa-certificate mr-2"></i>Terbitkan Sertifikat</button>
            </div>
        </form>
    </div>
</div>
@endsection
