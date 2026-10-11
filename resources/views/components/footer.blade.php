<footer {{ $attributes->merge(['class' => 'bg-white border-t border-gray-200 py-8 mt-auto']) }}>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img class="h-8 md:h-10 w-auto object-contain" src="{{ asset('BATAM EDU-GOV AI RBG.png') }}" alt="Logo Footer">
            </a>
            <p class="text-xs text-gray-500">&copy; {{ date('Y') }} Dinas Pendidikan Kota Batam. Hak Cipta Dilindungi.</p>
        </div>
        <div class="flex flex-wrap items-center gap-4 sm:gap-6 text-xs text-gray-500 font-medium">
            <a href="{{ url('/') }}" class="hover:text-gray-900 transition-colors">Beranda</a>
            <a href="{{ url('/#section-alur') }}" class="hover:text-gray-900 transition-colors">Alur & Persyaratan</a>
            <a href="{{ url('/#section-lacak') }}" class="hover:text-gray-900 transition-colors">Lacak Berkas</a>
            <a href="{{ route('bantuan') }}" class="hover:text-gray-900 text-[#166534] font-bold transition-colors">Pusat Bantuan</a>
        </div>
    </div>
</footer>
