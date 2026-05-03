@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-nav></x-nav>
<div class="h-screen w-full p-15">
    @guest
        <p class="text-end text-xl mb-4 flex items-center justify-end flex-col lg:flex-row">
            Inicia sesión para crear tus posts.
            <a href="/log_in" class="p-5 bg-yellow-500 hover:bg-yellow-600 transition-colors text-white rounded-md m-3">Iniciar Sesión</a>
        </p>        
    @endguest

    <h1 class="text-3xl font-bold mb-4 text-center m-3 p-10">Posts</h1>
    @auth
        <form action="/post" method="POST" class="mb-4 flex items-center justify-center flex-col">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <div class="mb-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="title" id="title" required class="mt-1 block w-100  border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-2">
                <label for="content" class="block text-sm font-medium text-gray-700">Contenido</label>
                <textarea name="content" id="content" rows="4" required class="mt-1 block w-100 lg:w-150 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 m-10 hover:bg-blue-600 cursor-pointer transition-colors text-white font-bold py-2 px-4 rounded-md">Crear Post</button>
            
             <div class="h-1 bg-blue-700 w-8/12 m-10"></div>
        </form>
   
    @endauth
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($posts as $post)
            <div class="bg-white p-4 rounded border-b-blue-700 border-b-2 border-t-blue-700 border-t-2 shadow-md">
                <div class="">
                    <p class="text-xl font-semibold mb-2"></p>
                </div>
                <div class="h-10 mb-2">
                    <h2 class="text-xl font-semibold "><span class="font-light text-xs">Titulo:</span> <br>{{ $post->title }}</h2>
                </div>
                <div class="h-10 mb-6">
                    <h2 class="text-md font-semibold "><span class="font-light text-xs">Autor:</span> <br>{{ $post->user->name ?? 'Usuario no encontrado' }} <br> {{ $post->user->email ?? 'Email no encontrado' }}  </h2>
                </div>
                <p class="text-sm"><span class="font-light text-xs">Descripción:</span> <br>{{ $post->content }}</p>
                @if (auth()->id() === $post->user_id)
                    <form action="/post/{{ $post->id }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 cursor-pointer transition-colors text-white font-bold py-2 px-4 rounded-md">Eliminar</button>
                    </form>
                @endif
                    
            </div>
        @endforeach
    </div>
</div>
