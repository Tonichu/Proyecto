<li>
    <div class="modal-container">
        <button class="modal-button" onclick="window.modal2.showModal();">Inscribirse</button>

        <dialog id="modal2" class="modal-dialog">
            <div class="container">
                <div class="card">
                    <h2 class="modal-title">Registro de Usuario</h2>
                    <form id="registroFormulario" action="controllers/new_user_from_index.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required>
                            <span id="nombre-error" class="error" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" id="apellidos" name="apellidos" required>
                            <span id="apellidos-error" class="error" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono">
                            <span id="telefono-error" class="error" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label for="correo">Correo Electrónico:</label>
                            <input type="email" id="correo" name="correo" required>
                            <span id="correo-error" class="error" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" id="direccion" name="direccion">
                            <span id="direccion-error" class="error" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label for="pass">Contraseña:</label>
                            <input type="password" id="pass" name="pass" required>
                            <span id="pass-error" class="error" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto de Perfil:</label>
                            <input type="file" id="foto" name="foto">
                            <span id="foto-error" class="error" style="color: red;"></span>
                        </div>


                        <input class="btn submit-button" type="submit" value="Registrarse">
                        <button class="btn modal-close-button" onclick="window.modal2.close();">Cerrar</button>
                    </form>
                </div>
            </div>
        </dialog>

    </div>
</li>