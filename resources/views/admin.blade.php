@vite(['resources/css/app.css', 'resources/js/admin.js'])
<x-nav />

<div class="p-10 min-h-screen bg-gray-100">

    <h1 class="text-3xl font-bold text-center mb-10">Admin Panel</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
        @if ($user->rol_id == 3)
        <form id="user-form" method="POST" action="/users"
                class="bg-white p-6 rounded shadow border-t-4 border-blue-600">
                @csrf

                <h2 id="form-title" class="text-xl font-bold mb-4">Crear Usuario</h2>

                <input type="hidden" name="id" id="user-id">

                <input type="text" name="name" id="user-name" placeholder="Nombre"
                    class="w-full mb-3 p-2 border rounded" required>

                <input type="email" name="email" id="user-email" placeholder="Correo"
                    class="w-full mb-3 p-2 border rounded" required>

                <input type="password" name="password" id="user-password" placeholder="Contraseña"
                    class="w-full mb-3 p-2 border rounded">

                <select name="rol_id" id="user-role"
                    class="w-full mb-3 p-2 border rounded">
                    <option value="1">User</option>
                    <option value="2">Moderator</option>
                    <option value="3">Admin</option>
                </select>

                <button id="submit-btn"
                    class="w-full bg-blue-500 text-white py-2 rounded">
                    Guardar Usuario
                </button>

                <button type="button" id="cancel-btn"
                    class="w-full bg-gray-400 text-white py-2 rounded mt-2 hidden">
                    Cancelar
                </button>
            </form>
        @endif
       

        <!-- 🔹 FORM POST -->
        <form id="post-form" method="POST" action="/post"
            class="bg-white p-6 rounded shadow border-t-4 border-green-600">
            @csrf

            <h2 id="post-title" class="text-xl font-bold mb-4">Crear Post</h2>
                        <input type="hidden" name="user_id" id="post-user" value="{{ auth()->id() }}">
            <input type="hidden" name="id" id="post-id">

            <h3 id="post-user-name" class="mb-2 hidden font-bold"></h3>

            <input type="text" name="title" id="post-title-input" placeholder="Título"
                class="w-full mb-3 p-2 border rounded" required>

            <textarea name="content" id="post-content" placeholder="Contenido"
                class="w-full mb-3 p-2 border rounded" required></textarea>

            <button id="post-submit"
                class="w-full bg-green-500 text-white py-2 rounded">
                Guardar Post
            </button>

            <button type="button" id="post-cancel"
                class="w-full bg-gray-400 text-white py-2 rounded mt-2 hidden">
                Cancelar
            </button>
        </form>

    </div>

    <!-- 🔹 TABLA -->
    <div class="bg-white p-6 rounded shadow">

        <h2 class="text-xl font-bold mb-4">Usuarios</h2>

     <table class="w-full text-sm table-auto">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="p-2 text-left">ID</th>
                    <th class="p-2 text-left">Nombre</th>
                    <th class="p-2 text-left">Email</th>
                    <th class="p-2 text-left">Rol</th>
                    <th class="p-2 text-left">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $u)

                <!-- FILA USUARIO -->
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">{{ $u->id }}</td>
                    <td class="p-2">{{ $u->name }}</td>
                    <td class="p-2">{{ $u->email }}</td>
                    <td class="p-2">{{ $u->rol->name ?? '—' }}</td>

                    <td class="p-2">
                        <div class="flex gap-2 flex-wrap">
                            @if ($user->rol_id == 3)
                                 <button class="btn-edit bg-yellow-400 px-3 py-1 rounded"
                                    data-id="{{ $u->id }}"
                                    data-name="{{ $u->name }}"
                                    data-email="{{ $u->email }}"
                                    data-role="{{ $u->rol_id }}">
                                    Editar
                                </button>

                                <form action="/users/{{ $u->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                                        Eliminar
                                    </button>
                                </form>

                            @endif
                           
                            <button class="btn-post bg-blue-500 text-white px-3 py-1 rounded"
                                data-id="{{ $u->id }}">
                                Post
                            </button>

                        </div>
                    </td>
                </tr>

                <!-- FILA POST -->
                <tr id="post-{{ $u->id }}">
                    <td colspan="5" class="p-0">
                        <div class="post-box hidden">

                            <div class="bg-gray-100 p-4">

                                <div class="flex justify-between mb-2">
                                    <h3 class="font-bold">Post</h3>
                                </div>

                                @forelse($u->posts as $post)
                                <div class="bg-white p-3 mb-2 rounded border">

                                    <p class="font-bold">{{ $post->title }}</p>
                                    <p class="text-sm">{{ $post->content }}</p>

                                    <div class="mt-2 flex gap-2 flex-wrap">

                                        <button class="btn-edit-post bg-yellow-400 px-2 rounded"
                                            data-id="{{ $post->id }}"
                                            data-user="{{ $u->id }}"
                                            data-user-name="{{ $u->name }}"
                                            data-title="{{ $post->title }}"
                                            data-content="{{ $post->content }}">
                                            Editar
                                        </button>

                                        <form action="/post/{{ $post->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-500 text-white px-2 rounded">
                                                Eliminar
                                            </button>
                                        </form>

                                    </div>

                                </div>
                                @empty
                                <p class="text-gray-500">Sin post</p>
                                @endforelse

                            </div>

                        </div>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

    </div>

</div>