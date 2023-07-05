    <!-- Modal Fornecedor -->
    <div class="modal fade" id="modal-form-forn" tabindex="-1" aria-labelledby="modal-form-forn-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-form-forn-label">Formulário de Fornecedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form action="?page=salvarfornecedor" method="POST">
                        <input name="modal" value="1" hidden />

                        <!-- Conteúdo do formulário de fornecedor -->
                        <?php
                        include_once('./fornecedor/novo-fornecedor.php');
                        ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>