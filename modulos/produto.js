/*let paginaAtual = 1;
let termoPesquisa = "";

document.getElementById("pesquisaProduto").addEventListener("input", function () {
    termoPesquisa = this.value.trim();
    paginaAtual = 1; // volta para a primeira página
    carregarProdutos(paginaAtual, termoPesquisa);
});*/



document.addEventListener("DOMContentLoaded", () => {
    carregarProdutos(); // carrega todos por defeito
});





let paginaAtual = 1;
let termoPesquisa = "";

function carregarProdutos(page = 1, search = termoPesquisa) {

    termoPesquisa = search;
    paginaAtual = page;



    let url = `modulos/get_produto.php?page=${page}`;
    if (search) {
        url += `&search=${encodeURIComponent(search)}`;
    }

    fetch(url)


        //fetch(`modulos/get_produto.php?page=${page}&search=${encodeURIComponent(search)}`)
        .then(res => res.json())
        .then(resp => {

            let tbody = document.querySelector("#tableProdutos tbody");
            tbody.innerHTML = "";

            if (!resp.data || resp.data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="15" class="text-center text-muted">
                            Nenhum produto encontrado
                        </td>
                    </tr>
                `;
                document.querySelector("#paginationProdutos").innerHTML = "";
                return;
            }

            resp.data.forEach(prod => {
                tbody.innerHTML += `
                    <tr>
                        <td>${prod.idproduct}</td>
                        <td>${prod.Produto}</td>
                        <td>${prod.Descricao}</td>
                        <td>${prod.Barcod ?? ""}</td>
                        <td>${prod.unidade_medida}</td>
                        <td>${prod.preco_custo_total}</td>
                        <td>${prod.imposto_custo}</td>
                        <td>${prod.preco_custo_sem_imposto}</td>
                        <td>${prod.preco_venda_total}</td>
                        <td>${prod.venda_sem_imposto}</td>
                        <td>${prod.desconto}</td>
                        <td>${prod.estado}</td>
                        <td>${prod.data}</td>
                        <td>${prod.grupo}</td>
                        <td class="text-left">
                            <button class="btn btn-warning btn-sm" onclick="editarProduto(${prod.idproduct})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="eliminarProduto(${prod.idproduct})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });

            //gerarPaginacaoProdutos(resp.total, resp.limit, resp.page);
            /*if (resp.total > resp.limit) {
                gerarPaginacaoProdutos(resp.total, resp.limit, resp.page);
            } else {
                document.querySelector("#paginationProdutos").innerHTML = "";
            }*/

            // Sempre calcula total de páginas
            /*let totalPaginas = Math.ceil(resp.total / resp.limit);

            if (totalPaginas > 1) {
                gerarPaginacaoProdutos(resp.total, resp.limit, resp.page);
            } else {
                document.querySelector("#paginationProdutos").innerHTML = "";
            }*/

            let totalPaginas = Math.ceil(resp.total / resp.limit);
            gerarPaginacaoProdutos(resp.total, resp.limit, resp.page);





        })
        .catch(error => {
            console.error("Erro:", error);
            mostrarAlerta("Erro ao carregar produtos", "danger");
        });
}


/*function gerarPaginacaoProdutos(total, limit, page) {

    let totalPaginas = Math.ceil(total / limit);
    let pagination = document.querySelector("#paginationProdutos");

    pagination.innerHTML = "";

    for (let i = 1; i <= totalPaginas; i++) {
        pagination.innerHTML += `
            <li class="page-item ${i === page ? "active" : ""}">
                <button class="page-link" onclick="carregarProdutos(${i}, termoPesquisa)">
                    ${i}
                </button>
            </li>
        `;
    }
}*/


function gerarPaginacaoProdutos(total, limit, page) {
    let totalPaginas = Math.ceil(total / limit);
    let pagination = document.querySelector("#paginationProdutos");
    pagination.innerHTML = "";

    if (totalPaginas === 0) return; // sem resultados

    for (let i = 1; i <= totalPaginas; i++) {
        pagination.innerHTML += `
            <li class="page-item ${i === page ? "active" : ""}">
                <button class="page-link" onclick="carregarProdutos(${i}, termoPesquisa)">
                    ${i}
                </button>
            </li>
        `;
    }
}



let searchTimeout;

document.getElementById("searchProduto").addEventListener("input", e => {
    clearTimeout(searchTimeout);

    searchTimeout = setTimeout(() => {
        carregarProdutos(1, e.target.value.trim());
    }, 300);
});






















//let paginaAtual = 1;
/*
function carregarProdutos(page = 1) {



    fetch(`modulos/get_produto.php?page=${page}`)
        .then(res => res.json())
        .then(resp => {

            paginaAtual = resp.page;

            let tbody = document.querySelector("#tableProdutos tbody");
            tbody.innerHTML = "";

            resp.data.forEach(prod => {
                tbody.innerHTML += `
                    <tr>
                        <td>${prod.idproduct}</td>
                            <td>${prod.Produto}</td>
                            <td>${prod.Descricao}</td>
                            <td>${prod.Barcod}</td>
                            <td>${prod.unidade_medida}</td>
                            <td>${prod.preco_custo_total}</td>
                            <td>${prod.imposto_custo}</td>
                            <td>${prod.preco_custo_sem_imposto}</td>
                            <td>${prod.preco_venda_total}</td>
                            <td>${prod.venda_sem_imposto}</td>
                            <td>${prod.desconto}</td>
                            <td>${prod.estado}</td>
                            <td>${prod.data}</td>
                            <td>${prod.grupo}</td>

                        <td class="text-left">

                            <button class="btn btn-warning btn-sm" onclick="editarProduto(${prod.idproduct})">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button class="btn btn-danger btn-sm" onclick="eliminarProduto(${prod.idproduct})">
                                <i class="bi bi-trash"></i>
                            </button>

                        </td>
                    </tr>
                `;
            });

            gerarPaginacaoProdutos(resp.total, resp.limit, resp.page);
        })
        .catch(error => console.error("Erro:", error));
}

// paginacao para produtos
function gerarPaginacaoProdutos(total, limit, page) {

    let totalPaginas = Math.ceil(total / limit);
    let pagination = document.querySelector("#paginationProdutos");

    pagination.innerHTML = "";

    for (let i = 1; i <= totalPaginas; i++) {

        pagination.innerHTML += `
            <li class="page-item ${i === page ? "active" : ""}">
                <button class="page-link" onclick="carregarProdutos(${i})">${i}</button>
            </li>
        `;
    }
}

// chama ao iniciar
carregarProdutos();
*/


//===========  funcao para carregar categorias para o select 


async function carregarCategorias_produto() {
    const select = document.getElementById("product-group");

    select.innerHTML = '<option>Carregando...</option>';

    const resp = await fetch("modulos/carregarCategoria_produto.php");
    const categorias = await resp.json();
    //console.log("Categorias recebidas:", categorias);  // <-- debug

    select.innerHTML = '<option disabled selected>Selecione um Grupo</option>';

    categorias.forEach(c => {
        const option = document.createElement("option");
        option.value = c.idGrupo;
        option.textContent = c.Tipo;
        select.appendChild(option);
    });
}


// Função para abrir modal de edicao

function editarProduto(id) {
    fetch(`modulos/get_produto_by_id.php?id=${id}`)
        .then(res => res.json())
        .then(produto => {

            //console.log("Dados recebidos do PHP:", produto); // 🔥 aqui
            // Preencher o formulário
            document.getElementById("modalAddProdutoLabel").textContent = "Editar Produto";

            document.getElementById("product-id").value = produto.idproduct;
            document.getElementById("product-description").value = produto.Descricao;
            document.getElementById("product_name").value = produto.Produto || "";

            document.getElementById("product-barcod").value = produto.Barcod || "";
            document.getElementById("product-units").value = produto.unidade_medida || "";
            //document.getElementById("product-group").value = produto.grupo || "";

            // carregar a categoria do produto
            carregarCategorias_produto().then(() => {
                const selectGrupo = document.getElementById("product-group");
                for (let i = 0; i < selectGrupo.options.length; i++) {
                    if (selectGrupo.options[i].text === produto.grupo) { // produto.grupo = Tipo
                        selectGrupo.selectedIndex = i;
                        break;
                    }
                }
            });




            document.getElementById("product-taxe").value = produto.taxa || "16";
            document.getElementById("preco-custo-com-imposto").value = produto.preco_custo_total || 0;
            document.getElementById("imposto-custo").value = produto.imposto_custo || 0;
            document.getElementById("preco-custo-sem-imposto").value = produto.preco_custo_sem_imposto || 0;

            document.getElementById("preco-venda-com-imposto-input").value = produto.preco_venda_total || 0;
            document.getElementById("preco-venda-sem-imposto-input").value = produto.venda_sem_imposto || 0;
            document.getElementById("imposto-venda").value = produto.imposto_custo || 0;

            const margem = (produto.venda_sem_imposto - produto.preco_custo_sem_imposto) || 0;
            document.getElementById("margem-lucro").value = margem.toFixed(2);

            // Abrir modal
            $('#modalAddProduto').modal('show');
        })
        .catch(err => {
            console.error("Erro ao buscar produto:", err);
            //alert("Não foi possível carregar os dados do produto.");
            //mostrarAlerta("Categoria salva com sucesso!", "success");
            mostrarAlerta("Erro: ", "Não foi possível carregar os dados do produto.", "danger");
        });
}




//========================funcao alert =====================================

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



//=====================limpar campos antes de adicionar========================//

function limparFormularioProduto() {

    document.getElementById("modalAddProdutoLabel").textContent = "Adicionar Produto";

    document.getElementById("product-id").value = "";

    document.getElementById("formAddProduto").reset();

    // reset explícito de campos calculados
    document.getElementById("preco-custo-com-imposto").value = "";
    document.getElementById("preco-custo-sem-imposto").value = "";
    document.getElementById("imposto-custo").value = "";

    document.getElementById("preco-venda-com-imposto-input").value = "";
    document.getElementById("preco-venda-sem-imposto-input").value = "";
    document.getElementById("imposto-venda").value = "";

    document.getElementById("margem-lucro").value = "";

    // taxa padrão
    document.getElementById("product-taxe").value = "16";

    // reset do select grupo
    const selectGrupo = document.getElementById("product-group");
    selectGrupo.selectedIndex = 0;
}

function abrirModalAdicionarProduto() {
    limparFormularioProduto();
    carregarCategorias_produto();
    $('#modalAddProduto').modal('show');
}


// ======================= eliminar produto ==============================//

function eliminarProduto(id) {

    if (!id) return;

    if (!confirm("Tem certeza que deseja eliminar este produto?")) return;

    fetch("modulos/eliminar_produto.php", {
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
                mostrarAlerta("Produto eliminado com sucesso!", "success");
                carregarProdutos(); // atualiza tabela
            } else {
                mostrarAlerta(data.msg || "Erro ao eliminar produto", "danger");
            }

        })
        .catch(err => {
            console.error("Erro eliminar:", err);
            mostrarAlerta("Erro de comunicação com o servidor", "danger");
        });
}
