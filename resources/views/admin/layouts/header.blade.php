@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        toast: true,
        position: 'top-end',
        customClass: {
            popup: 'swal-green',
            icon: 'icon-success'
        },
    });
</script>
@endif
@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        html: '{!! session('error') !!}',
        showConfirmButton: true        
    });
    </script>
@endif

@if(session('close_modal'))
    <script>
        parent.$.colorbox.close();
        parent.location.reload();
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro ao enviar Formulário, verifique os campos abaixos',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            toast: true,
            position: 'top-end',
        });
    </script>
@endif

@auth
    @if($isShowMenu)    
        <aside id="sidebar" class="w-64 bg-white border-r shadow">
            <nav class="p-4 space-y-1 text-gray-700" style="position: fixed">
                @php
                    $adminSidebarMenu = getAdminSidebarMenu();
                @endphp

                @foreach($adminSidebarMenu as $menu)
                    <a href="{{ $menu['route_url'] }}" class="flex items-center gap-3 px-2 py-2 rounded {{ $menu['active'] }} hover:bg-gray-100">
                        {!! $menu['icone'] !!}
                        <span>{{ $menu['menu'] }}</span>
                    </a>
                @endforeach

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-3 px-1 py-2 rounded hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"/></svg>
                        <span>Log Out</span>
                    </a>
                </form>
            </nav>
        </aside>
    @endif

    <div class="flex-1 flex flex-col min-h-screen"><!-- fecha no footer -->
        <nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <header class="bg-gray-800 shadow px-6 py-3 flex justify-between items-center">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('admin.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
                </header>
            </div>
        </nav>        
@endauth