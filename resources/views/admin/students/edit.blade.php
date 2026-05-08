@extends('layouts.admin')
@section('title', 'Edit Peserta')
@section('page-title', 'Edit Data Peserta Didik')
@section('page-subtitle', $student->full_name)

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-7">
        <form action="{{ route('admin.students.update', $student->id) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">NIM / ID Peserta</label>
                    <input type="text" name="student_id" value="{{ old('student_id', $student->student_id) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                    @error('student_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $student->full_name) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $student->email) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth?->format('Y-m-d')) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kewarganegaraan</label>
                    <input type="text" name="nationality" value="{{ old('nationality', $student->nationality) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jabatan / Pangkat</label>
                    <select name="rank" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm" required>
                        @foreach(['Taruna Tingkat I','Taruna Tingkat II','Taruna Tingkat III','Taruna Tingkat IV','Rating/AB','Mualim III','Mualim II','Mualim I','Chief Officer','Nakhoda','Masinis III','Masinis II','Masinis I','KKM','Bosun','Serang'] as $r)
                        <option value="{{ $r }}" {{ old('rank', $student->rank) === $r ? 'selected' : '' }}>{{ $r }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Buku Pelaut</label>
                    <input type="text" name="seaman_book" value="{{ old('seaman_book', $student->seaman_book) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Perusahaan</label>
                    <input type="text" name="company" value="{{ old('company', $student->company) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kapal</label>
                    <select name="vessel_type" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        <option value="">Pilih Jenis Kapal</option>
                        @foreach(['Bulk Carrier','Container Ship','Oil Tanker','Chemical Tanker','LNG Carrier','General Cargo','Ferry/Ro-Ro','Tugboat','Offshore Vessel','Passenger Ship'] as $v)
                        <option value="{{ $v }}" {{ old('vessel_type', $student->vessel_type) === $v ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
                <textarea name="address" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">{{ old('address', $student->address) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                    @foreach(['active' => 'Aktif', 'inactive' => 'Nonaktif', 'graduated' => 'Lulus'] as $v => $l)
                    <option value="{{ $v }}" {{ old('status', $student->status) === $v ? 'selected' : '' }}>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('admin.students.show', $student->id) }}" class="px-5 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-600">Batal</a>
                <button type="submit" class="bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-800"><i class="fas fa-save mr-2"></i>Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
