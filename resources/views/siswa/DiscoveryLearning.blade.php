@extends('template.main')
@section('container')
@if ($materi == 'sistem-koordinasi-manusia')
    @if ($tahap == 'stimulasi')
        @include('siswa.sistemKoordinasi.Stimulasi')
    @endif
    @if ($tahap == 'identifikasi-masalah')
        @include('siswa.sistemKoordinasi.IdentifikasiMasalah')
    @endif
    @if ($tahap == 'pengumpulan-data')
        @include('siswa.sistemKoordinasi.PengumpulanData')
    @endif
    @if ($tahap == 'pengolahan-data')
        @include('siswa.sistemKoordinasi.PengolahanData')
    @endif
    @if ($tahap == 'verifikasi')
        @include('siswa.sistemKoordinasi.Verifikasi')
    @endif
    @if ($tahap == 'generalization')
        @include('siswa.sistemKoordinasi.Kesimpulan')
    @endif
@endif
@if ($materi == 'alat-indra-manusia')
    @if ($tahap == 'stimulasi')
        @include('siswa.alatIndra.Stimulasi')
    @endif
    @if ($tahap == 'identifikasi-masalah')
        @include('siswa.alatIndra.IdentifikasiMasalah')
    @endif
    @if ($tahap == 'pengumpulan-data')
        @include('siswa.alatIndra.PengumpulanData')
    @endif
    @if ($tahap == 'pengolahan-data')
        @include('siswa.alatIndra.PengolahanData')
    @endif
    @if ($tahap == 'verifikasi')
        @include('siswa.alatIndra.Verifikasi')
    @endif
    @if ($tahap == 'generalization')
        @include('siswa.alatIndra.Kesimpulan')
    @endif
@endif
@if ($materi == 'hormon-manusia')
    @if ($tahap == 'stimulasi')
        @include('siswa.hormon.Stimulasi')
    @endif
    @if ($tahap == 'identifikasi-masalah')
        @include('siswa.hormon.IdentifikasiMasalah')
    @endif
    @if ($tahap == 'pengumpulan-data')
        @include('siswa.hormon.PengumpulanData')
    @endif
    @if ($tahap == 'pengolahan-data')
        @include('siswa.hormon.PengolahanData')
    @endif
    @if ($tahap == 'verifikasi')
        @include('siswa.hormon.Verifikasi')
    @endif
    @if ($tahap == 'generalization')
        @include('siswa.hormon.Kesimpulan')
    @endif
@endif
@if ($materi == 'homeostasis-manusia')
    @if ($tahap == 'stimulasi')
        @include('siswa.homeostasis.Stimulasi')
    @endif
    @if ($tahap == 'identifikasi-masalah')
        @include('siswa.homeostasis.IdentifikasiMasalah')
    @endif
    @if ($tahap == 'pengumpulan-data')
        @include('siswa.homeostasis.PengumpulanData')
    @endif
    @if ($tahap == 'pengolahan-data')
        @include('siswa.homeostasis.PengolahanData')
    @endif
    @if ($tahap == 'verifikasi')
        @include('siswa.homeostasis.Verifikasi')
    @endif
    @if ($tahap == 'generalization')
        @include('siswa.homeostasis.Kesimpulan')
    @endif
@endif
@endsection