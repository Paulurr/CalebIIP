@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-nav></x-nav>
<div class="h-screen w-full flex items-center justify-center flex-col">
    <form action="/log_in" method="POST" class="max-w-md p-5 bg-white rounded shadow border-b-blue-700 border-b-2 lg:w-1/4 w-full">
        @csrf
        <h1 class="text-3xl font-bold mb-4">Iniciar Sesión</h1>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
            <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" name="password" id="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 transition-colors text-white font-bold py-2 px-4 rounded-md">Iniciar Sesión</button>
    </form>
</div>
<x-footer />