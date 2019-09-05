var arg = "";

function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('InputLougradouro'+arg).value=("");
    document.getElementById('InputBairro'+arg).value=("");
    document.getElementById('InputCidade'+arg).value=("");
    document.getElementById('InputUf'+arg).value=("");
    document.getElementById('InputIbge'+arg).value=("");
}

function meu_callback(conteudo) {

    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('InputLougradouro'+arg).value=(conteudo.logradouro);
        document.getElementById('InputBairro'+arg).value=(conteudo.bairro);
        document.getElementById('InputCidade'+arg).value=(conteudo.localidade);
        document.getElementById('InputUf'+arg).value=(conteudo.uf);
        document.getElementById('InputIbge'+arg).value=(conteudo.ibge);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep(valor, $arg) {

    arg = $arg;

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.s
        if(validacep.test(cep)) {

            // alert(arg);

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('InputLougradouro'+arg).value="...";
            document.getElementById('InputBairro'+arg).value="...";
            document.getElementById('InputCidade'+arg).value="...";
            document.getElementById('InputUf'+arg).value="...";
            document.getElementById('InputIbge'+arg).value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep($arg);
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep($arg);
    }
};
