@extends('layouts.admin')
@section('title', 'Detail Sertifikat')
@section('page-title', 'Detail Sertifikat')
@section('page-subtitle', $certificate->certificate_number)

@section('content')
<div class="grid grid-cols-3 gap-6">
    <div class="col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-7">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Informasi Sertifikat</h3>
                    <p class="text-sm text-gray-500">Diterbitkan oleh {{ $certificate->issuing_authority }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.certificates.edit', $certificate->id) }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-200"><i class="fas fa-edit mr-2"></i>Edit</a>
                    @if($certificate->file_path)
                    <a href="{{ $certificate->file_url }}" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700"><i class="fas fa-download mr-2"></i>Unduh</a>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-y-4 text-sm">
                <div class="text-gray-500">Nomor Sertifikat</div>
                <div class="font-semibold text-gray-800">{{ $certificate->certificate_number }}</div>
                
                <div class="text-gray-500">Peserta Didik</div>
                <div class="font-semibold text-gray-800">
                    <a href="{{ route('admin.students.show', $certificate->student_id) }}" class="text-blue-600 hover:underline">{{ $certificate->student->full_name }}</a>
                </div>
                
                <div class="text-gray-500">Kursus / Diklat</div>
                <div class="font-semibold text-gray-800">{{ $certificate->course->title }}</div>
                
                <div class="text-gray-500">Regulasi STCW</div>
                <div class="font-semibold text-gray-800">{{ $certificate->stcw_regulation ?: '-' }}</div>
                
                <div class="text-gray-500">Tanggal Terbit</div>
                <div class="font-semibold text-gray-800">{{ $certificate->issued_date->format('d M Y') }}</div>
                
                <div class="text-gray-500">Tanggal Kedaluwarsa</div>
                <div class="font-semibold text-gray-800">{{ $certificate->expiry_date->format('d M Y') }}</div>
                
                <div class="text-gray-500">Status</div>
                <div>
                    @php 
                        $statusClass = [
                            'valid' => 'bg-green-100 text-green-700',
                            'expired' => 'bg-red-100 text-red-700',
                            'revoked' => 'bg-gray-100 text-gray-700',
                            'suspended' => 'bg-yellow-100 text-yellow-700'
                        ][$certificate->status] ?? 'bg-gray-100 text-gray-700';
                    @endphp
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase {{ $statusClass }}">{{ $certificate->status }}</span>
                </div>
            </div>

            @if($certificate->notes)
            <div class="mt-8 pt-6 border-t">
                <h4 class="text-sm font-bold text-gray-800 mb-2">Catatan</h4>
                <p class="text-sm text-gray-600 italic">"{{ $certificate->notes }}"</p>
            </div>
            @endif
        </div>

        @if($certificate->file_path)
        <div class="bg-white rounded-xl shadow-sm p-7">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Pratinjau Dokumen</h3>
            @php $ext = pathinfo($certificate->file_path, PATHINFO_EXTENSION); @endphp
            @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                <img src="{{ $certificate->file_url }}" class="w-full rounded-lg shadow-sm border">
            @else
                <div class="bg-gray-50 rounded-lg p-10 text-center border border-dashed">
                    <i class="fas fa-file-pdf text-5xl text-red-500 mb-4"></i>
                    <p class="text-sm text-gray-600 mb-4">Dokumen PDF tersedia</p>
                    <a href="{{ $certificate->file_url }}" target="_blank" class="text-blue-600 font-bold hover:underline">Buka di Tab Baru</a>
                </div>
            @endif
        </div>
        @endif
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-6 text-center">
            <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-certificate text-3xl"></i>
            </div>
            <h4 class="font-bold text-gray-800">Verifikasi Sertifikat</h4>
            <p class="text-xs text-gray-500 mb-4 px-4">Scan kode QR atau gunakan tautan publik untuk verifikasi keaslian sertifikat ini.</p>
            <div class="bg-gray-100 p-4 rounded-lg inline-block mb-4">
                {{-- Mock QR --}}
                <i class="fas fa-qrcode text-6xl text-gray-800"></i>
            </div>
            <button class="w-full border border-blue-600 text-blue-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-50">Salin Tautan Verifikasi</button>
        </div>
    </div>
</div>
@endsection
