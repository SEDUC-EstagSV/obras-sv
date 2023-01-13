<h1>Novo Relatório</h1>

<form action="?page=salvarrelatorio" method="POST">
    <input type="hidden" name="acaorelatorio" value="cadastrarRelatorio">
    <div class="mb-3">
        <label>Código da Obra</label>
        <input type="number" name="cd_Obra" class="form-control">
    </div>
    <div class="mb-3">
    <!-- Buscar número de relatórios p/ esta obra e acrescentar +1-->
        <label>N° do Relatório nessa obra</label>
        <input type="number" name="num_Relatorio" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nome do Técnico Responsável</label>
        <input type="name" name="nm_TecResponsavel" class="form-control">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="text" name="ds_Email" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nome do Responsável pelo Local</label>
        <input type="name" name="nm_LocResponsavel" class="form-control">
    </div>
    <div class="mb-3">
        <label>Atividade realizada</label>
        <input type="text" name="tp_AtivRealizada" class="form-control">
    </div>
    <div class="mb-3">
        <label>Situação do Relatório</label>
        <input type="text" name="tp_RelaSituacao" class="form-control">
    </div>
    <div class="mb-3">
        <label>Período trabalho</label>
        <input type="text" name="tp_Periodo" class="form-control">
    </div>
    <div class="mb-3">
        <label>Clima</label>
        <input type="text" name="tp_Tempo" class="form-control">
    </div>
    <div class="mb-3">
        <label>Condição para trabalho</label>
        <input type="text" name="tp_Condicao" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de Mão de obra</label>
        <input type="number" name="qt_TotalMaodeObra" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de ajudantes</label>
        <input type="number" name="qt_Ajudantes" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de eletricistas</label>
        <input type="number" name="qt_Eletricistas" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de Mestres de Obra</label>
        <input type="number" name="qt_Mestres" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de pedreiros</label>
        <input type="number" name="qt_Pedreiros" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de serventes</label>
        <input type="number" name="qt_Serventes" class="form-control">
    </div>
    <div class="mb-3">
        <label>Total de Mão Direta</label>
        <input type="number" name="qt_MaoDireta" class="form-control">
    </div>
    <div class="mb-3">
        <label>Porcentagem concluida</label>
        <input type="number" name="pt_Conclusao" class="form-control">
    </div>
    <div class="mb-3">
        <label>Comentário</label>
        <input type="text" name="tp_RelaComentario" class="form-control">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>