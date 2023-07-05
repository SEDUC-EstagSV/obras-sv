    <!-- Modal Usuário -->
    <div class="modal fade" id="modal-form-usuario" tabindex="-1" aria-labelledby="modal-form-usuario-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-form-usuario-label">Formulário de Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form action="?page=salvarusuario" method="POST">
                        <input name="modal" value="1" hidden />

                        <!-- Conteúdo do formulário de usuario -->
                        <?php include_once('./usuario/novo-usuario.php');
                        ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>