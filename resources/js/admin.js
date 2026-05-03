window.addEventListener("DOMContentLoaded", () => {

    let open_id = null;

    document.querySelectorAll('.btn-post').forEach(btn => {

        btn.addEventListener('click', () => {

            const id = btn.dataset.id;
            const box = document.querySelector(`#post-${id} .post-box`);

            document.querySelectorAll('.post-box').forEach(b => {
                b.classList.add("hidden");
            });

            if (open_id !== id) {
                box.classList.remove("hidden");
                open_id = id;
            } else {
                box.classList.add("hidden");
                open_id = null;
            }

        });

    });

    const postForm = document.getElementById('post-form');

    if (postForm) {
        const postTitle = document.getElementById('post-title');
        const postSubmit = document.getElementById('post-submit');
        const postCancel = document.getElementById('post-cancel');

        const postId = document.getElementById('post-id');
        const postUser = document.getElementById('post-user');
        const originalUserId = postUser ? postUser.value : null;
        const postUserName = document.getElementById('post-user-name');
        const postTitleInput = document.getElementById('post-title-input');
        const postContent = document.getElementById('post-content');

        // ➕ CREAR POST
        document.querySelectorAll('.btn-add-post').forEach(btn => {
            btn.addEventListener('click', () => {

                postForm.reset();

                const method = postForm.querySelector('input[name="_method"]');
                if (method) method.remove();

                postUser.value = btn.dataset.id || originalUserId;

                postUserName.textContent = "Usuario: " + btn.dataset.name;
                postUserName.classList.remove("hidden");

                postForm.action = "/post";
                postTitle.textContent = "Crear Post";
                postSubmit.textContent = "Guardar";

                postCancel.classList.add("hidden");
            });
        });
        document.querySelectorAll('.btn-edit-post').forEach(btn => {
            btn.addEventListener('click', () => {

                postId.value = btn.dataset.id;
                postUser.value = btn.dataset.user;

                postUserName.textContent = "Usuario: " + btn.dataset.userName;
                postUserName.classList.remove("hidden");

                postTitleInput.value = btn.dataset.title;
                postContent.value = btn.dataset.content;

                postForm.action = "/post/" + btn.dataset.id;

                let method = postForm.querySelector('input[name="_method"]');
                if (!method) {
                    method = document.createElement("input");
                    method.type = "hidden";
                    method.name = "_method";
                    method.value = "PUT";
                    postForm.appendChild(method);
                } else {
                    method.value = "PUT";
                }

                postTitle.textContent = "Editar Post";
                postSubmit.textContent = "Actualizar";

                postCancel.classList.remove("hidden");
            });
        });

        postCancel.addEventListener('click', () => {

            postForm.reset();
            postId.value = "";

            const method = postForm.querySelector('input[name="_method"]');
            if (method) method.remove();

            // 🔥 restaurar usuario logueado
            if (originalUserId) {
                postUser.value = originalUserId;
            }

            postForm.action = "/post";

            postTitle.textContent = "Crear Post";
            postSubmit.textContent = "Guardar";

            postUserName.classList.add("hidden");
            postCancel.classList.add("hidden");
        });
    }

    const userForm = document.getElementById('user-form');

    if (userForm) {

        const userTitle = document.getElementById('form-title');
        const userSubmit = document.getElementById('submit-btn');
        const userCancel = document.getElementById('cancel-btn');

        const userId = document.getElementById('user-id');
        const userName = document.getElementById('user-name');
        const userEmail = document.getElementById('user-email');
        const userRole = document.getElementById('user-role');
        const userPassword = document.getElementById('user-password');

        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', () => {

                userId.value = btn.dataset.id;
                userName.value = btn.dataset.name;
                userEmail.value = btn.dataset.email;
                userRole.value = btn.dataset.role;

                userPassword.style.display = "none";
                userPassword.value = "";
                userPassword.removeAttribute("required");

                userForm.action = "/users/" + btn.dataset.id;

                let method = userForm.querySelector('input[name="_method"]');
                if (!method) {
                    method = document.createElement("input");
                    method.type = "hidden";
                    method.name = "_method";
                    method.value = "PUT";
                    userForm.appendChild(method);
                } else {
                    method.value = "PUT";
                }

                userTitle.textContent = "Actualizar Usuario";
                userSubmit.textContent = "Actualizar";
                userCancel.classList.remove("hidden");
            });
        });

        userCancel.addEventListener('click', () => {

            userForm.reset();
            userId.value = "";

            const method = userForm.querySelector('input[name="_method"]');
            if (method) method.remove();

            userForm.action = "/users";

            userPassword.style.display = "block";
            userPassword.setAttribute("required", "true");

            userTitle.textContent = "Crear Usuario";
            userSubmit.textContent = "Guardar Usuario";
            userCancel.classList.add("hidden");
        });
    }

});