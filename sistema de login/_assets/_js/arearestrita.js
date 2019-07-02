
/*
    scripts de area restrita
*/

//mostrando a opção escolhida pelo usuário como amigos, config, outros

function mudaOpcao(nomeId, idOpcao){
    for(conta = 1; conta <= 2;conta++){
        if(idOpcao == conta){
            document.getElementById(nomeId+idOpcao).style.display = 'block';
        }else{
            document.getElementById(nomeId+conta).style.display = 'none';
        }
    }

}