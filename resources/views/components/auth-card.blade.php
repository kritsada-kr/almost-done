<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-no-repeat bg-center bg-fixed"
    style="background-image: url('{{ asset('imgs/bg.png')}}')"
>


    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border-2">
    <div class="flex justify-center">
        {{ $logo }}
    </div>
        {{ $slot }}
    </div>
</div>
