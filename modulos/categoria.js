//funcao trazer lista de categorias de banco de dados e paginar

let paginaAtual = 1;

function carregarCategoria(page = 1) {

    fetch(`modulos/get_categoria.php?page=${page}`)
        .then(res => res.json())
        .then(resp => {

            paginaAtual = resp.page;

            let tbody = document.querySelector("#tableCategorias tbody");
            tbody.innerHTML = "";

            resp.data.forEach(categ => {
                tbody.innerHTML += `
                    <tr>
                        <td>${categ.idGrupo}</td>
                        <td>${categ.Tipo}</td>
                        <td>${categ.Estado}</td>
                        <td>${categ.Data}</td>
                        <td>${categ.Descricao}</td>
                        <td class="text-left">
                <button class="btn btn-warning btn-sm" onclick="editarCategoria(${categ.idGrupo})">
                    <i class="bi bi-pencil"></i>
                </button>

                <button class="btn btn-danger btn-sm" onclick="eliminarCategoria(${categ.idGrupo})">
                    <i class="bi bi-trash"></i>
                </button>
                </td>
                    </tr>
                `;
            });

            gerarPaginacao(resp.total, resp.limit, resp.page);
        })
        .catch(error => console.error("Erro:", error));
}

function gerarPaginacao(total, limit, page) {

    let totalPaginas = Math.ceil(total / limit);
    let pagination = document.querySelector("#pagination");

    pagination.innerHTML = "";

    for (let i = 1; i <= totalPaginas; i++) {

        pagination.innerHTML += `
            <li class="page-item ${i === page ? "active" : ""}">
                <button class="page-link" onclick="carregarCategoria(${i})">${i}</button>
            </li>
        `;
    }
}

carregarCategoria();



//=================fim da funcao listar e paginar Categorias ====================//




//-----funcao para editar categoria ------------------//

function editarCategoria(id) {

    fetch(`modulos/get_categoria_by_id.php?id=${id}`)
        .then(res => res.json())
        .then(resp => {

            if (!resp.success) {
                alert("Erro ao carregar dados!");
                return;
            }

            let categoria = resp.data;

            document.querySelector("#edit-idGrupo").value = categoria.idGrupo;
            document.querySelector("#edit-categoria-tipo").value = categoria.Tipo;
            document.querySelector("#edit-categoria-estado").value = categoria.Estado;
            document.querySelector("#edit-categoria-descricao").value = categoria.Descricao;

            $("#modalAddCategoria").modal("show");  // abre modal

        })
        .catch(err => console.error(err));
}



//---------fim funcao editar categoria --------------//





//==== funcao para eliminar categoria =====================//

function eliminarCategoria(id) {

    if (!confirm("Tem certeza que deseja eliminar a categoria?")) return;

    fetch("modulos/delete_categoria.php?id=" + id)
        .then(res => res.json())
        .then(resp => {
            //alert(resp.message);
            mostrarAlerta("success: " + resp.message, "success");


            carregarCategoria(paginaAtual); // recarrega tabela
        })
        .catch(err => console.log("Erro ao eliminar:", err));
}








// =========== funcao para abrir modal em modo adicionar ===================//


function abrirModalAdicionar() {

    document.querySelector("#modalTitle").textContent = "Adicionar Categoria";
    document.querySelector("#btnSalvar").textContent = "Salvar";
    document.querySelector("#categoria-id").value = "";
    document.querySelector("#categoria-tipo").value = "";
    document.querySelector("#categoria-estado").value = "";
    document.querySelector("#categoria-descricao").value = "";

    $("#modalAddCategoria").modal("show");
}


// ========== funcao para abrir modal em modo editar =====================//

function editarCategoria(id) {

    fetch(`modulos/get_categoria_by_id.php?id=${id}`)
        .then(res => res.json())
        .then(resp => {

            document.querySelector("#modalTitle").textContent = "Editar Categoria";
            document.querySelector("#btnSalvar").textContent = "Atualizar";

            document.querySelector("#categoria-id").value = resp.data.idGrupo;
            document.querySelector("#categoria-tipo").value = resp.data.Tipo;
            document.querySelector("#categoria-estado").value = resp.data.Estado;
            document.querySelector("#categoria-descricao").value = resp.data.Descricao;

            $("#modalAddCategoria").modal("show");

        });
}



// =================Evento de submit para salvar ou atualizar=================//

document.querySelector("#btnSalvar").addEventListener("click", function (e) {
    e.preventDefault(); // previne reload da pagina
    let id = document.querySelector("#categoria-id").value;

    if (id === "")
        salvarCategoria();
    else
        atualizarCategoria(id);
});




// =================== salvar ou atualizar categoria ==============//

/*function salvarCategoria(){
    console.log("Salvar novo registro...");
}*/

function salvarCategoria() {

    let tipo = document.querySelector("#categoria-tipo").value;
    let estado = document.querySelector('#categoria-estado').value;
    let descricao = document.querySelector("#categoria-descricao").value;

    let formData = new FormData();
    formData.append("tipo", tipo);
    formData.append("estado", estado);
    formData.append("descricao", descricao);

    fetch("modulos/salvar_categoria.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(resp => {

            if (resp.success) {

                $("#modalAddCategoria").modal("hide");

                carregarCategoria(); // atualizar tabela 

                // alert("Categoria salva com sucesso!");
                mostrarAlerta("Categoria salva com sucesso!", "success");




            } else {
                //alert("Erro: " + resp.msg);
                mostrarAlerta("Erro: " + resp.msg, "danger");
            }

        })
        .catch(err => console.log("Erro:", err));
}



// ========== funcao atualizar categoria ==============//

function atualizarCategoria(id) {

    let tipo = document.querySelector("#categoria-tipo").value;
    let estado = document.querySelector("#categoria-estado").value;
    let descricao = document.querySelector("#categoria-descricao").value;

    let formData = new FormData();
    formData.append("id", id);
    formData.append("tipo", tipo);
    formData.append("estado", estado);
    formData.append("descricao", descricao);

    fetch("modulos/atualizar_categoria.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(resp => {

            if (resp.success) {

                $("#modalAddCategoria").modal("hide");

                carregarCategoria(); // recarregar tabela

                //alert("Categoria atualizada!");
                mostrarAlerta("Categoria atualizada com sucesso!", "success");




            } else {
                //alert("Erro: " + resp.msg);
                mostrarAlerta("Erro: " + resp.msg, "danger");
            }

        })
        .catch(err => console.log("Erro:", err));
}


//=================== funcao para exibir alert ===============//

function mostrarAlerta(mensagem, tipo = "success", tempo = 3000) {
    // tipo = success | danger | warning | info
    const container = document.querySelector("#alert-container");

    const alerta = document.createElement("div");
    alerta.className = `alert alert-${tipo} alert-dismissible fade show`;
    alerta.role = "alert";
    alerta.innerHTML = `
        ${mensagem}
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
        </button>
    `;

    container.appendChild(alerta);

    // auto-fechar depois de "tempo" ms
    setTimeout(() => {
        $(alerta).alert('close');
    }, tempo);
}




//======== funcao para barra de pesquisa =================//

// Seleciona o input de pesquisa
const inputPesquisa = document.querySelector("#inputPesquisa");

// Evento de digitação
inputPesquisa.addEventListener("keyup", function() {
    const filtro = this.value.toLowerCase();
    const linhas = document.querySelectorAll("#tableCategorias tbody tr");

    linhas.forEach(linha => {
        // Pegamos o conteúdo das colunas Tipo, Estado e Descrição
        const idGrupo = linha.cells[0].textContent.toLowerCase();
        const tipo = linha.cells[1].textContent.toLowerCase();
        const estado = linha.cells[2].textContent.toLowerCase();
        const descricao = linha.cells[4].textContent.toLowerCase();

        // Se algum campo contém o texto da pesquisa, mostra a linha, senão esconde
        if(idGrupo.includes(filtro) ||tipo.includes(filtro) || estado.includes(filtro) || descricao.includes(filtro)) {
            linha.style.display = "";
        } else {
            linha.style.display = "none";
        }
    });
});
