@if (session()->has('flasher::envelopes'))
    {{-- Asset JS Flasher --}}
    <script src="{{ asset('vendor/flasher/flasher.min.js') }}"></script>
    <script src="{{ asset('vendor/flasher/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendor/flasher/flasher-sweetalert.min.js') }}"></script>

    {{-- Render Flasher --}}
   
@endif
