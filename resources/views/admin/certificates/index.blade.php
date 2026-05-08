@extends('layouts.admin')
@section('title', 'Daftar Sertifikat')
@section('page-title', 'Manajemen Sertifikat')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <form action="{{ route('admin.certificates.index') }}" method="GET" class="flex gap-3">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor atau nama..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm w-64 focus:ring-2 focus:ring-blue-500 outline-none">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg text-sm outline-none">
                <option value="">Semua Status</option>
                <option value="valid" {{ request('status') == 'valid' ? 'selected' : '' }}>Valid</option>
                <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
            </select>
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-800 transition-colors">Filter</button>
        </form>
        <a href="{{ route('admin.certificates.create') }}" class="bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-800 shadow-md shadow-blue-200 transition-all flex items-center gap-2">
            <i class="fas fa-plus"></i> Terbitkan Sertifikat
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 font-bold uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Sertifikat</th>
                    <th class="px-6 py-4">Peserta</th>
                    <th class="px-6 py-4">Kursus</th>
                    <th class="px-6 py-4">Tgl Terbit</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($certificates as $cert)
                <tr class="hover:bg-gray-50/80 transition-colors">
                    <td class="px-6 py-4 font-semibold text-gray-800">
                        {{ $cert->certificate_number }}
                        @if($cert->file_path)
                        <i class="fas fa-paperclip ml-1 text-blue-400" title="Ada Lampiran"></i>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $cert->student->full_name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $cert->course->title }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $cert->issued_date->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        @php 
                            $statusClass = [
                                'valid' => 'bg-green-100 text-green-700',
                                'expired' => 'bg-red-100 text-red-700',
                                'revoked' => 'bg-gray-100 text-gray-700',
                                'suspended' => 'bg-yellow-100 text-yellow-700'
                            ][$cert->status] ?? 'bg-gray-100 text-gray-700';
                        @endphp
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $statusClass }}">{{ $cert->status }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.certificates.show', $cert->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Detail"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.certificates.edit', $cert->id) }}" class="p-2 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors" title="Edit"><i class="fas fa-edit"></i></a>
                            @if($cert->file_path)
                            <a href="{{ $cert->file_url }}" target="_blank" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Lihat Dokumen"><i class="fas fa-file-alt"></i></a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic font-medium bg-gray-50/30">Belum ada data sertifikat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($certificates->hasPages())
    <div class="p-6 border-t border-gray-100 bg-gray-50/30">
        {{ $certificates->links() }}
    </div>
    @endif
</div>
@endsection
