const formularios_ajax=document.querySelectorAll('.FormularioAjax');

function enviar_formulario(e){
    e.preventDefault();

    let enviar=confirm('¿Estás seguro de enviar este formulario?');

    if(enviar==true){

        let data = new FormData(this);
        let method=this.getAttribute('method');
        let action=this.getAttribute('action');

        let encabezados = new Headers();

        let config={
            method:method,
            headers:encabezados,
            mode:'cors',
            cache:'no-cache',
            body:data
        
        }
    }

    formularios_ajax.forEach(formularios_ajax=>{
        formularios_ajax.addEventListener('submit',enviar_formulario);
    
    });
}