async function loadContratos(val) {
    if (val.length >= 1) {

      const dados = await fetch('./autocompleteContrato.php?cd=' + val)
      const resposta = await dados.json();
      
      var html = "<ul class='list-group position-fixed'>"
     
      console.log(resposta);
      if (resposta['erro']) {
        html +=
          "<li class='list-group-item disabled'>" + resposta['msg'] + '</li>'
      } else {
        for (i = 0; i < resposta['dados'].length; i++) {
          html +=
            "<li class='list-group-item list-group-item-action' onclick='get_container(" +
            JSON.stringify(resposta['dados'][i].cd) +
            ',' +
            JSON.stringify(resposta['dados'][i].ano) +
            ")'>" +
            resposta['dados'][i].cd + '/' + resposta['dados'][i].ano +
            '</li>'
        }
      }
  
      html += '</ul>'

  
      document.getElementById('resultado_pesquisaContrato').innerHTML = html
    }
  }

  function fecharContratos() {
    const fecharContratos = document.getElementById('cd_contrato')
    document.addEventListener('click', function (event) {
      const validar_clique = fecharContratos.contains(event.target)
      if (!validar_clique) {
        document.getElementById('resultado_pesquisaContrato').innerHTML = ''
      }
    })
  }