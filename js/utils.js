async function loadContratos(val) {
    if (val.length >= 1) {

      const dados = await fetch('./autocompleteContrato.php?cd=' + val)
      const resposta = await dados.json();
      
      var html = "<ul class='list-group position-fixed'>"
     
      if (resposta['erro']) {
        html +=
          "<li class='list-group-item disabled'>" + resposta['msg'] + '</li>'
          pesquisaEscolaContrato('erro');
      } else {
        for (i = 0; i < resposta['dados'].length; i++) {
          html +=
            "<li class='list-group-item list-group-item-action' onclick='getContratos(" +
            JSON.stringify(resposta['dados'][i].num) +
            ',' +
            JSON.stringify(resposta['dados'][i].ano) +
            ")'>" +
            resposta['dados'][i].num + '/' + resposta['dados'][i].ano +
            '</li>'
        }
      }
  
      html += '</ul>'

  
      document.getElementById('resultado_pesquisaContrato').innerHTML = html
    }
  }

  function fecharContratos() {
    const fecharContratos = document.getElementById('num_contrato')
    document.addEventListener('click', function (event) {
      const validar_clique = fecharContratos.contains(event.target)
      if (!validar_clique) {
        document.getElementById('resultado_pesquisaContrato').innerHTML = ''
      }
    })
  }


  function getContratos(cd, ano) {
    const contrato_field = document.getElementById('num_contrato')
    
    if (contrato_field != null) {
      contrato_field.value = cd + '/' + ano
      pesquisaEscolaContrato(contrato_field.value);
    }
  }

  function pesquisaEscolaContrato(selected) {
    if(selected == 'erro'){
      document.querySelector("select.form-select.escola").innerHTML =
          '<option selected="">Selecione um contrato para ver a lista de escolas</option>';
      return $("select.form-select.escola").attr("disabled", "disabled");
    }

    $.post('pesquisaEscolaPorContrato.php', {'pesquisa' : selected}, function(data){
        var jsonData = JSON.parse(data); // turn the data string into JSON
        $("select.form-select.escola").html(jsonData);
        if(data.charAt(15) != '-'){
            $("select.form-select.escola").removeAttr('disabled');
        } else {
          document.querySelector("select.form-select.escola").innerHTML =
          '<option selected="">Selecione um contrato para ver a lista de escolas</option>';
          $("select.form-select.escola").attr("disabled", "disabled");
        }
    });
}
