@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-nav></x-nav>
<div class="h-screen w-full p-15">
    <h1 class="text-3xl font-bold mb-4 text-center m-3 p-10">Posts</h1>
    @auth
        <form action="/post" method="POST" class="mb-4">
            @csrf
            <div class="mb-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="title" id="title" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-2">
                <label for="content" class="block text-sm font-medium text-gray-700">Contenido</label>
                <textarea name="content" id="content" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 cursor-pointer transition-colors text-white font-bold py-2 px-4 rounded-md">Crear Post</button>

        </form>
    @endauth
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($posts as $post)
            <div class="bg-white p-4 rounded shadow">
                <div class="">
                    <p class="text-xl font-semibold mb-2"></p>
                </div>
                <div class="h-30">
                    <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                </div>
                <p>{{ $post->content }}</p>
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
