document.addEventListener("DOMContentLoaded", () => {
    carregarFornecedores(); // carrega todos por defeito
});


let paginaAtual = 1;
let termoPesquisa = "";

function carregarFornecedores(page = 1, search = termoPesquisa) {

    termoPesquisa = search;
    paginaAtual = page;



    let url = `modulos/get_fornecedor.php?page=${page}`;
    if (search) {
        url += `&search=${encodeURIComponent(search)}`;
    }

    fetch(url)


        //fetch(`modulos/get_fornecedor.php?page=${page}&search=${encodeURIComponent(search)}`)
        .then(res => res.json())
        .then(resp => {

            let tbody = document.querySelector("#tableFornecedores tbody");
            tbody.innerHTML = "";

            if (!resp.data || resp.data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="15" class="text-center text-muted">
                            Nenhum fornecedor encontrado
                        </td>
                    </tr>
                `;
                document.querySelector("#paginationFornecedores").innerHTML = "";
                return;
            }

            resp.data.forEach(fornec => {
                tbody.innerHTML += `
                    <tr>
                        <td>${fornec.idFornecedor}</td>
                        <td>${fornec.Nome}</td>
                        <td>${fornec.Morada}</td>
                        <td>${fornec.Contacto}</td>
                        <td>${fornec.Email}</td>
                        <td>${fornec.Nuit}</td>
                        <td>${fornec.Estado}</td>
                        <td class="text-left">
                            <button class="btn btn-warning btn-sm" onclick="editarFornecedor(${fornec.idFornecedor})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="eliminarFornecedor(${fornec.idFornecedor})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>

                    </tr>
                `;
            });


            let totalPaginas = Math.ceil(resp.total / resp.limit);
            gerarPaginacaoFornecedores(resp.total, resp.limit, resp.page);


        })
        .catch(error => {
            console.error("Erro:", error);
            mostrarAlerta("Erro ao carregar fornecedores", "danger");
        });
}



function gerarPaginacaoFornecedores(total, limit, page) {
    let totalPaginas = Math.ceil(total / limit);
    let pagination = document.querySelector("#paginationFornecedores");
    pagination.innerHTML = "";

    if (totalPaginas === 0) return; // sem resultados

    for (let i = 1; i <= totalPaginas; i++) {
        pagination.innerHTML += `
            <li class="page-item ${i === page ? "active" : ""}">
                <button class="page-link" onclick="carregarFornecedores(${i}, termoPesquisa)">
                    ${i}
                </button>
            </li>
        `;
    }
}



let searchTimeout;

document.getElementById("searchFornecedor").addEventListener("input", e => {
    clearTimeout(searchTimeout);

    searchTimeout = setTimeout(() => {
        carregarFornecedores(1, e.target.value.trim());
    }, 300);
});




//==============adicionar e editar funcionario=====================//

const form = document.getElementById("formAddFornecedor");

form.addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    const fornecedorId = document.getElementById("idFornecedor").value;

    if (fornecedorId) formData.append("action", "update");
    else formData.append("action", "create");

    fetch("modulos/salvar_&_atualizar_fornecedor.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log("Sucesso:", data);

            if (data.status === "success" || data.success === true) {
                mostrarAlerta(
                    fornecedorId ?
                    "Fornecedor atualizado com sucesso!" :
                    "Fornecedor cadastrado com sucesso!",
                    "success"
                );
               
                form.reset();
                $('#modalAddFornecedor').modal('hide');
                carregarFornecedores(); // ✔ só recarrega se deu sucesso
            } else {
                mostrarAlerta(
                    data.msg || "Erro ao salvar fornecedor",
                    "danger"
                );
                //alert('erro ao salvar.');
            }
        })
        .catch(err => {
            console.error("Erro:", err);
            alert("Erro ao enviar dados!");
        });
});


//==================funcao editar funcionario =============================//

function editarFornecedor(id) {
    fetch(`modulos/get_fornecedor_by_id.php?id=${id}`)
        .then(res => res.json())
        .then(response => {
            if (response.success && response.data) {
                const fornecedor = response.data;

                document.getElementById("modalAddFornecedorLabel").textContent = "Editar Fornecedor";

                document.getElementById("idFornecedor").value = fornecedor.idFornecedor;
                document.getElementById("fornecedor-nome").value = fornecedor.Nome || "";
                document.getElementById("fornecedor-morada").value = fornecedor.Morada || "";
                document.getElementById("fornecedor-contacto").value = fornecedor.Contacto || "";
                document.getElementById("fornecedor-email").value = fornecedor.Email || "";
                document.getElementById("fornecedor-nuit").value = fornecedor.Nuit || "";
                document.getElementById("fornecedor-estado").value = fornecedor.Estado || "";

                $('#modalAddFornecedor').modal('show');
            } else {
                alert("Fornecedor não encontrado!");
            }
        })
        .catch(err => {
            console.error("Erro ao buscar fornecedor:", err);
            alert("Não foi possível carregar os dados do fornecedor");
        });
}


//====================== alert ====================

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



function limparFormularioFornecedor() {
    // Atualizar o título do modal
    document.getElementById("modalAddFornecedorLabel").textContent = "Adicionar Fornecedor";

    // Resetar o campo oculto de ID
    document.getElementById("idFornecedor").value = "";

    // Resetar todos os campos do formulário
    document.getElementById("formAddFornecedor").reset();

    // Reset explícito de campos (garantia extra)
    document.getElementById("fornecedor-nome").value     = "";
    document.getElementById("fornecedor-morada").value   = "";
    document.getElementById("fornecedor-contacto").value = "";
    document.getElementById("fornecedor-email").value    = "";
    document.getElementById("fornecedor-nuit").value     = "";
    document.getElementById("fornecedor-estado").value   = "";
}


function eliminarFornecedor(id) {
    if (!id) return;

    if (!confirm("Tem certeza que deseja eliminar este fornecedor?")) return;

    fetch("modulos/eliminar_fornecedor.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ id })
    })
        .then(res => res.json())
        .then(data => {
            console.log("Resposta eliminar:", data);

            if (data.status === "success" || data.success === true) {
                mostrarAlerta("Fornecedor eliminado com sucesso!", "success");
                carregarFornecedores(); // atualiza tabela de fornecedores
            } else {
                mostrarAlerta(data.msg || "Erro ao eliminar fornecedor", "danger");
            }
        })
        .catch(err => {
            console.error("Erro eliminar:", err);
            mostrarAlerta("Erro de comunicação com o servidor", "danger");
        });
}