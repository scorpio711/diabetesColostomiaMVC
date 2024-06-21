function iniciarApp(){
    consultarApi(); // consulta la api en el backend de php   
}

async function consultarApi(){
    try {
        const url = "http://localhost:3000/public/api/chat";
        const resultado = await fetch(url);
        
    } catch (error) {
        console.log(error);
    }
}