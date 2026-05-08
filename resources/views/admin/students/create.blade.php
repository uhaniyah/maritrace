@extends('layouts.admin')
@section('title', 'Tambah Peserta')
@section('page-title', 'Tambah Peserta Didik Baru')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-7">
        <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">NIM / ID Peserta <span class="text-red-500">*</span></label>
                    <input type="text" name="student_id" value="{{ old('student_id') }}" placeholder="STD-2024-001" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm @error('student_id') border-red-500 @enderror" required>
                    @error('student_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm @error('full_name') border-red-500 @enderror" required>
                    @error('full_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm @error('email') border-red-500 @enderror" required>
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">No. Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kewarganegaraan <span class="text-red-500">*</span></label>
                    <input type="text" name="nationality" value="{{ old('nationality', 'Indonesia') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jabatan / Pangkat <span class="text-red-500">*</span></label>
                    <select name="rank" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                        <option value="">Pilih Jabatan</option>
                        @foreach(['Taruna Tingkat I','Taruna Tingkat II','Taruna Tingkat III','Taruna Tingkat IV','Rating/AB','Mualim III','Mualim II','Mualim I','Chief Officer','Nakhoda','Masinis III','Masinis II','Masinis I','KKM','Bosun','Serang'] as $r)
                        <option value="{{ $r }}" {{ old('rank') === $r ? 'selected' : '' }}>{{ $r }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Buku Pelaut</label>
                    <input type="text" name="seaman_book" value="{{ old('seaman_book') }}" placeholder="SB-XXXXXX" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Scan Buku Pelaut (PDF/Gambar)</label>
                <input type="file" name="seaman_book_file" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm @error('seaman_book_file') border-red-500 @enderror">
                <p class="text-gray-500 text-xs mt-1">Maksimal 5MB. Format: PDF, JPG, PNG.</p>
                @error('seaman_book_file')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Perusahaan Pelayaran</label>
                    <input type="text" name="company" value="{{ old('company') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kapal</label>
                    <select name="vessel_type" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        <option value="">Pilih Jenis Kapal</option>
                        @foreach(['Bulk Carrier','Container Ship','Oil Tanker','Chemical Tanker','LNG Carrier','General Cargo','Ferry/Ro-Ro','Tugboat','Offshore Vessel','Passenger Ship'] as $v)
                        <option value="{{ $v }}" {{ old('vessel_type') === $v ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
                <textarea name="address" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('address') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                    <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    <option value="graduated" {{ old('status') === 'graduated' ? 'selected' : '' }}>Lulus</option>
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('admin.students.index') }}" class="px-5 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-600">Batal</a>
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-800"><i class="fas fa-save mr-2"></i>Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
