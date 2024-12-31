// Script para colocar botões que mostram ou não os formulários
document.querySelector("#show-add-form").addEventListener("click", (evt)=>{
    if (evt.target) {
        document.querySelector("#add-form").style.display = "block";
        document.querySelector("#del-form").style.display = "none";
    }
})
document.querySelector("#show-del-form").addEventListener("click", (evt)=>{
    if (evt.target) {
        document.querySelector("#add-form").style.display = "none";
        document.querySelector("#del-form").style.display = "block";
    }
})

