    <!-- Modal escola -->
    <div class="modal fade" id="modal-form-esc" tabindex="-1" aria-labelledby="modal-form-esc-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-form-esc-label">Formulário de escola</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form action="?page=salvarescola" method="POST">
                        <input name="modal" value="1" hidden />

                        <!-- Conteúdo do formulário de escola -->
                        <?php
                        include_once('./escola/nova-escola.php');
                        ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>