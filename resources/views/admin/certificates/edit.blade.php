@extends('layouts.admin')
@section('title', 'Edit Sertifikat')
@section('page-title', 'Edit Data Sertifikat')
@section('page-subtitle', $certificate->certificate_number)

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-7">
        <form action="{{ route('admin.certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Peserta Didik</label>
                    <select name="student_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                        @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ old('student_id', $certificate->student_id) == $student->id ? 'selected' : '' }}>{{ $student->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kursus / Diklat</label>
                    <select name="course_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id', $certificate->course_id) == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Sertifikat</label>
                    <input type="text" name="certificate_number" value="{{ old('certificate_number', $certificate->certificate_number) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Otoritas Penerbit</label>
                    <input type="text" name="issuing_authority" value="{{ old('issuing_authority', $certificate->issuing_authority) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Terbit</label>
                    <input type="date" name="issued_date" value="{{ old('issued_date', $certificate->issued_date->format('Y-m-d')) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Kedaluwarsa</label>
                    <input type="date" name="expiry_date" value="{{ old('expiry_date', $certificate->expiry_date->format('Y-m-d')) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Regulasi STCW</label>
                    <input type="text" name="stcw_regulation" value="{{ old('stcw_regulation', $certificate->stcw_regulation) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                        @foreach(['valid' => 'Valid', 'expired' => 'Expired', 'revoked' => 'Dicabut', 'suspended' => 'Ditangguhkan'] as $v => $l)
                        <option value="{{ $v }}" {{ old('status', $certificate->status) == $v ? 'selected' : '' }}>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">File Sertifikat (PDF/Gambar)</label>
                @if($certificate->file_path)
                <div class="mb-2 text-xs text-blue-600">
                    <a href="{{ $certificate->file_url }}" target="_blank" class="hover:underline"><i class="fas fa-file-pdf mr-1"></i> Lihat Sertifikat Saat Ini</a>
                </div>
                @endif
                <input type="file" name="certificate_file" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm @error('certificate_file') border-red-500 @enderror">
                <p class="text-gray-500 text-xs mt-1">Kosongkan jika tidak ingin mengubah file. Maksimal 5MB.</p>
                @error('certificate_file')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Catatan Tambahan</label>
                <textarea name="notes" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('notes', $certificate->notes) }}</textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('admin.certificates.show', $certificate->id) }}" class="px-5 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-600">Batal</a>
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-800"><i class="fas fa-save mr-2"></i>Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
