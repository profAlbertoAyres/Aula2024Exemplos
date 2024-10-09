// const subtrair = document.querySelector("#subtrair");
// const somar = document.querySelector("#somar");
// const agua = document.querySelector("#agua");

// subtrair.addEventListener("click", () => {
//     atualizar_item("-")
// })

// somar.addEventListener("click", () => {
//     atualizar_item("+")
// })

function atualizar_item(acao, pai){
    const qtde = pai.querySelector("[data-qtde]");
    if(acao==="-"){
        if (qtde.value > 0)
            qtde.value = parseInt(qtde.value) - 1;
        else
            alert("Valor em 0");
    }else{
        qtde.value = parseInt(qtde.value) + 1;
    }
}

const botoes = document.querySelectorAll("[data-item]");

botoes.forEach((elemento) => {
    elemento.addEventListener("click", (evento)=>{
        const pai = evento.target.parentNode;
        const sinal = evento.target.textContent;
        atualizar_item(sinal, pai);
    });
});
