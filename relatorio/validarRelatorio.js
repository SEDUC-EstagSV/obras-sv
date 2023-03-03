import {validateTextInput, validateNumberInput} from '../js/validations.js';
//validação formulário
const form = document.querySelector('#relatorio_form');

function validateCheckboxes(){
    const checkboxes = document.querySelectorAll('input[type=checkbox]');

    var empty = [].filter.call(checkboxes, function( el ) {
        return !el.checked
    });

    if (checkboxes.length == empty.length) {
        //alert("É necessário informar pelo menos um período de trabalho");
        return false;
    } else {
        return true;
    }
}

function validateInputs(){
    const isValid = {value: false, error: ''};

    const cdObra = document.getElementsByName('cd_Obra')[0].value;
    const tecResponsavel = document.getElementsByName('nm_TecResponsavel')[0].value;
    const email = document.getElementsByName('ds_Email')[0].value;
    const responsavelLocal = document.getElementsByName('nm_LocResponsavel')[0].value;
    const ativRealizada = document.getElementsByName('tp_AtivRealizada')[0].value;
    const cdTempo = document.getElementsByName('tp_Tempo')[0].value;
    const cdCondicao = document.getElementsByName('tp_Condicao')[0].value;
    const totalMaoObra = document.getElementsByName('qt_TotalMaodeObra')[0].value;
    const qtAjudantes = document.getElementsByName('qt_Ajudantes')[0].value;
    const qtEletricistas = document.getElementsByName('qt_Eletricistas')[0].value;
    const qtMestres = document.getElementsByName('qt_Mestres')[0].value;
    const qtPedreiros = document.getElementsByName('qt_Pedreiros')[0].value;
    const qtServentes = document.getElementsByName('qt_Serventes')[0].value;
    const qtMaoDireita = document.getElementsByName('qt_MaoDireta')[0].value;
    const qtConclusao = document.getElementsByName('pt_Conclusao')[0].value;

    const isFilled = validateNumberInput(cdObra)
                    && validateTextInput(tecResponsavel)
                    && validateTextInput(email)
                    && validateTextInput(responsavelLocal)
                    && validateTextInput(ativRealizada)
                    && validateNumberInput(cdTempo)
                    && validateNumberInput(cdCondicao)
                    && validateNumberInput(totalMaoObra)
                    && validateNumberInput(qtAjudantes)
                    && validateNumberInput(qtEletricistas)
                    && validateNumberInput(qtMestres)
                    && validateNumberInput(qtPedreiros)
                    && validateNumberInput(qtServentes)
                    && validateNumberInput(qtMaoDireita)
                    && validateNumberInput(qtConclusao);

    let checkTotalMaoObra = false;           
    
    if(isFilled) {
        checkTotalMaoObra = parseInt(qtAjudantes) 
                            + parseInt(qtEletricistas) 
                            + parseInt(qtMestres) 
                            + parseInt(qtPedreiros) 
                            + parseInt(qtMaoDireita) 
                            == parseInt(totalMaoObra);
        if(!checkTotalMaoObra){
            isValid.error = "A quantidade do total de mão de obra não confere com a quantidade de trabalhadores informados";
        }
    }
    isValid.value = isFilled && checkTotalMaoObra;
    console.log(isValid)
    return isValid;
}


form.addEventListener('submit', function (e) {
    // prevent the form from submitting
    e.preventDefault();

    // validate fields
    const checkboxes = validateCheckboxes();
    const inputs = validateInputs();

    const isFormValid = checkboxes && inputs.value;

    // submit to the server if the form is valid
    if (isFormValid) {
        form.submit();
    } else {
        alert(inputs.error != '' ? inputs.error : "Certifique-se de preencher todos os campos necessários")
    }
});
