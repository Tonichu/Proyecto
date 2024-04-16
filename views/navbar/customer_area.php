<li>
    <div class="modal-container">
        <button class="modal-button" onclick="window.modal1.showModal();">Área clientes</button>

        <dialog id="modal1" class="modal-dialog">
            <div class="container">
                <div class="card">
                    <h2 class="modal-title">Iniciar Sesión</h2>
                    <form class="formIndex" action="../../proyecto/pages/usuarios/comprobar_usuario.php" method="post">
                        <div class="form-group">
                            <label for="Email">Correo Electrónico:</label>
                            <input type="text" id="Email" name="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <input class="btn submit-button" type="submit" value="Iniciar Sesión">
                    </form>
                </div>
            </div>
            <button class="btn modal-close-button" onclick="window.modal1.close();">Cerrar</button>
        </dialog>

    </div>
</li>