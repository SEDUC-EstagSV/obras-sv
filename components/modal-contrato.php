    <!-- Modal Contrato -->
    <div class="modal fade" id="modal-form-contrato" tabindex="-1" aria-labelledby="modal-form-contrato-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-form-contrato-label">Formulário de Contrato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form action="?page=salvarcontrato" method="POST">
                        <input name="modal" value="1" hidden />

                        <!-- Conteúdo do formulário de contrato -->
                        <?php include_once('./contrato/novo-contrato.php');
                        ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>