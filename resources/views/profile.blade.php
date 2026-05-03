@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-nav></x-nav>

<div class="min-h-screen w-full p-10">

    @auth
      
        <div class="bg-white p-6 rounded shadow-md border-t-blue-700 border-t-2 border-b-blue-700 border-b-2 mb-10">
            <h1 class="text-3xl font-bold text-center mb-6">Perfil</h1>

            <div class="flex flex-col lg:flex-row justify-between items-center">
                <div class="text-center lg:text-left">
                    <p class="text-xl font-semibold">
                        <span class="text-sm font-light">Nombre:</span><br>
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xl font-semibold mt-3">
                        <span class="text-sm font-light">Roll:</span><br>
                        {{ auth()->user()->rol->name ?? 'Rol no encontrado' }}
                    </p>
                    <p class="text-xl font-semibold mt-3">
                        <span class="text-sm font-light">Email:</span><br>
                        {{ auth()->user()->email }}
                    </p>
                </div>

            </div>
        </div>

        <h2 class="text-2xl font-bold text-center mb-6">Tus Posts</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            @forelse(auth()->user()->posts as $post)
                <div class="bg-white p-4 rounded shadow-md border-t-blue-700 border-t-2 border-b-blue-700 border-b-2">

                    <div class="mb-2">
                        <h2 class="text-xl font-semibold">
                            <span class="text-xs font-light">Título:</span><br>
                            {{ $post->title }}
                        </h2>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm">
                            <span class="text-xs font-light">Descripción:</span><br>
                            {{ $post->content }}
                        </p>
                    </div>

                    <form action="/post/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 transition-colors text-white font-bold py-2 px-4 rounded-md w-30">
                            Eliminar
                        </button>
                    </form>

                </div>
            @empty
                
                <p class="text-center col-span-3 text-gray-500">
                    No has creado ningún post aún.
                    <a href="/post" class="bg-blue-500 hover:bg-blue-600 transition-colors text-white font-bold py-2 px-4 rounded-md text-center">
                        Crear Post
                    </a>
                </p>
                
            @endforelse

        </div>
    @endauth

</div>