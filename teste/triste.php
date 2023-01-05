CREATE VIEW obraview AS
SELECT o.cd_Obra, o.nm_Obra, e.nm_Escola, e.ds_Local, o.cd_Contrato, f.nm_Fornecedor, o.dt_Inicial, o.dt_Final, o.pr_Decorrido, o.pr_Vencer,o.pr_Total, o.tp_AtivDescricao, o.tp_Comentario
FROM obra o, escola e, fornecedor f, contrato c
WHERE o.cd_Escola = e.cd_Escola AND o.cd_Contrato = c.cd_Contrato AND c.cd_Fornecedor = f.cd_Fornecedor


CREATE VIEW relatorioview AS
SELECT
r.cd_Relatorio,
r.num_Relatorio,
o.cd_Obra,
o.nm_Obra,
e.cd_Escola,
e.nm_Escola,
e.ds_Local,
o.cd_Contrato,
f.nm_Fornecedor,
o.nm_Contratante,
r.tp_AtivRealizada,
c.dt_Inicio,
c.dt_Final,
r.pr_Decorrido,
r.pr_Vencer,
r.nm_TecResponsavel,
r.ds_Email,
r.nm_LocResponsavel,
r.tp_RelaSituacao,
r.nm_Dia,
r.tp_Periodo,
r.tp_Tempo,
r.tp_Condicao,
r.qt_TotalMaodeObra,
r.qt_Ajudantes,
r.qt_Eletricistas,
r.qt_Mestres,
r.qt_Pedreiros,
r.qt_Serventes,
r.qt_MaoDireta,
r.pt_Conclusao,
o.st_Obra,
r.tp_RelaComentario,
r.dt_Carimbo
FROM obra o, escola e, fornecedor f, contrato c, relatorio r
WHERE r.cd_Obra = o.cd_Obra AND o.cd_Escola = e.cd_Escola AND o.cd_Contrato = c.cd_Contrato AND c.cd_Fornecedor = f.cd_Fornecedor