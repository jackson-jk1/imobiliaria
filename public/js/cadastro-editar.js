var msg = [];

var getParametros = function (url) {
	var parametros = {};
	var parser = document.createElement('a');
	parser.href = url;
	var query = parser.search.substring('?');
	var par = query.split('=');
	parametros = decodeURIComponent(par);
    return parametros;
}

msg = getParametros(window.location.href);
console.log(msg);

if(msg == "?sucesso,true"){
    Swal.fire({
		icon:'success',
        text: 'Sucesso!'
    })
}
if(msg == "?erro,semid"){
        Swal.fire({
        icon: 'error',
        text: 'É necessário um id'
    })
}
if(msg == "?erro,encontrarid"){
    Swal.fire({
        icon: 'error',
        text: 'Id não encontrado!'
    })
}
if(msg == "?erro,validacao"){
    Swal.fire({
        icon: 'error',
        text: 'Todos os campos são obrigatórios'
    })
}

if(msg == "?erro,arquivojpgpng"){
    Swal.fire({
        icon: 'error',
        text: 'Imagem nao suportada'
    })
}