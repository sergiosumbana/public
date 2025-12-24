<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CYBER-GEST</title>
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="css/btnUser.css">
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <!--    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">   -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">


    <style>
        .modal-body-scroller {
            max-height: 75vh;
            overflow-y: auto;
        }
    </style>

</head>

<body>

    <nav class="slider">
        <div class="btn-expandir " id="btn-exp">
            <i class="bi bi-list"></i>
        </div> <!--fim da sessao btn-expandir -->

        <ul>

            <li class="item-menu">
                <a href="index.html">
                    <span class="icon"><i class="bi bi-house"></i></span>
                    <span class="txt-link">Home</span>
                </a>
            </li>

            <li class="item-menu">
                <a href="categoria.php">
                    <span class="icon"><i class="bi bi-archive"></i></span>
                    <span class="txt-link">Categoria</span>
                </a>
            </li>


            <li class="item-menu ativo">
                <a href="produto.php">
                    <span class="icon"><i class="bi bi-box-seam"></i></span>
                    <span class="txt-link">Produto</span>
                </a>
            </li>

            <!-- <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-bar-chart-line"></i></span>
                    <span class="txt-link">Balance</span>
                </a>
            </li>

            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-person-fill-gear"></i></i></span>
                    <span class="txt-link">Users</span>
                </a>
            </li>

            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-gear"></i></span>
                    <span class="txt-link">Configuracoes</span>
                </a>
            </li>

            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-chat-left-text"></i></span>
                    <span class="txt-link">Mensagens</span>
                </a>
            </li>

            <li class="item-menu">
                <a href="#">
                    <span class="icon"><i class="bi bi-box-arrow-left"></i></span>
                    <span class="txt-link">Sair</span>
                </a>
            </li> -->
        </ul>
    </nav> <!-- fim do slider menu  -->


    <div class="main-container">
        <nav class="main">

            <div class="container mt-4">

                <h4 style="padding-bottom: 20px;">Lista de Produtos</h4>

                <!-- div para exibir alerts -->
                <div id="alert-container" class="mt-3"></div>

                <div class="row mb-3 align-items-center">

                    <div class="col-md-6">
                        <!-- Caixa de Pesquisa -->
                        <input type="text" class="form-control" id="searchProduto" placeholder="Pesquisar produto...">
                    </div>
                    <div class="col-md-6 text-right">
                        <!-- Botão Adicionar -->
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalAddProduto"  onclick="abrirModalAdicionarProduto()">
                            <i class="fas fa-plus"></i> Adicionar Produto
                        </button>


                    </div>
                </div>



                <!-- Scroll lateral -->
                <div style="overflow-x:auto;">
                    <table class="table table-striped table-bordered table-hover mt-3" id="tableProdutos">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Produto</th>
                                <th>Descrição</th>
                                <th>Barcod</th>
                                <th>Unidade_medida</th>
                                <th>preco_custo_total</th>
                                <th>imposto_custo</th>
                                <th>preco_custo_sem_imposto</th>
                                <th>preco_venda_total</th>
                                <th>venda_sem_imposto</th>
                                <th>Desconto</th>
                                <th>Estado</th>
                                <th>Data</th>
                                <th>Grupo</th>
                                <th>Ação</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Teclado USB</td>
                                <td>500 MZN</td>

                            </tr>

                        </tbody>
                    </table>





                </div>

                <nav>

                    <ul id="paginationProdutos" class="pagination justify-content-end"></ul>


                </nav>

                <!-- paginação alinhada à direita -->
                <!--  <nav aria-label="Páginas de resultados">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link">Anterior</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Próximo</a>
                        </li>
                    </ul>
                </nav>   -->


                <div class="modal fade" id="modalAddProduto" tabindex="-1" aria-labelledby="modalAddProdutoLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header bg-warning text-white">
                                <h5 class="modal-title" id="modalAddProdutoLabel">Adicionar Produto</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body modal-body-scroller">
                                <form id="formAddProduto" class="container-fluid">

                                    <div class="row">
                                        <!-- id do produto -->
                                        <input type="hidden" id="product-id" name="product_id" value="">

                                        <!-- Detalhes do Produto -->
                                        <div class="col-lg-4 col-md-6 mb-3">
                                            <fieldset class="p-3 border rounded shadow-sm h-100">
                                                <legend class="float-none w-auto px-2">Detalhes do Produto</legend>


                                                <div class="form-group mb-3">
                                                    <label for="product-description">Descrição</label>
                                                    <input type="text" id="product-description" name="Descricao" class="form-control"
                                                        placeholder="Descrição do Produto" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="product_name">Name</label>
                                                    <input type="text" id="product_name" name="product_name" class="form-control"
                                                        placeholder="Descrição do Produto" required>
                                                </div>


                                                <div class="form-group mb-3">
                                                    <label for="product-barcod">Código de Barras</label>
                                                    <input type="text" id="product-barcod" name="product-barcod" class="form-control"
                                                        placeholder="Código de Barras">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="product-group">Grupo de Produtos<span>*</span></label>
                                                    <select id="product-group" name="fk_group" class="form-control" required>
                                                        <option disabled selected>Selecione um Grupo</option>
                                                        <option value="Grupo 1">Grupo 1</option>
                                                        <option value="Grupo 2">Grupo 2</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="product-units">Unidade de Medida<span>*</span></label>
                                                    <select id="product-units" name="product-units" class="form-control" required>
                                                        <option disabled selected>Selecione a Unidade</option>
                                                        <option value="Unidade">Unidade</option>
                                                        <option value="Litros">Litros</option>
                                                        <option value="Kilogramas">Kilogramas</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="product-comment">Comentário</label>
                                                    <textarea id="product-comment" name="product-comment" class="form-control" rows="3"
                                                        placeholder="Observações adicionais sobre o produto"></textarea>
                                                </div>

                                            </fieldset>
                                        </div>

                                        <!-- Detalhes Financeiros e Fiscais -->
                                        <div class="col-lg-8 col-md-6 mb-3">
                                            <fieldset class="p-3 border rounded shadow-sm h-100">
                                                <legend class="float-none w-auto px-2">
                                                    Detalhes Financeiros e Fiscais
                                                </legend>

                                                <div class="row">
                                                    <!--Preço de custo -->
                                                    <div class="col-lg-6 mb-3">
                                                        <h5 class="text-primary mb-3">Preço de Custo</h5>

                                                        <div class="form-group mb-3">
                                                            <label for="product-taxe">Taxa de Imposto (Vendas)</label>
                                                            <select id="product-taxe" name="product-taxe" class="form-control" required>
                                                                <option disabled selected>Selecione a Taxa</option>
                                                                <option value="16">16%</option>
                                                                <option value="17">17%</option>
                                                                <option value="ISENTO">ISENTO</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="preco-custo-sem-imposto">Custo com
                                                                Imposto</label>
                                                            <input type="number" name="preco-custo-com-imposto" id="preco-custo-com-imposto"
                                                                class="form-control" placeholder="0.00" min="0"
                                                                step="0.01">
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="imposto-custo">Imposto (Custo)</label>
                                                            <input type="number" id="imposto-custo" name="imposto-custo"
                                                                class="form-control bg-light" placeholder="0.00"
                                                                readonly>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="preco-custo-com-imposto">Custo sem
                                                                Imposto</label>
                                                            <input type="number" id="preco-custo-sem-imposto" name="preco-custo-sem-imposto"
                                                                class="form-control bg-light" placeholder="0.00"
                                                                readonly>
                                                        </div>
                                                    </div>

                                                    <!-- Preço de venda -->
                                                    <div class="col-lg-6 mb-3">
                                                        <h5 class="text-success mb-3">Preço de Venda</h5>

                                                        <div class="form-group mb-3">
                                                            <label for="preco-venda-sem-imposto-input">Venda Com
                                                                Imposto</label>
                                                            <input type="number" id="preco-venda-com-imposto-input" name="preco-venda-com-imposto-input"
                                                                class="form-control" placeholder="0.00" min="0"
                                                                step="0.01">
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="imposto-venda">Imposto (Venda)</label>
                                                            <input type="number" id="imposto-venda" name="imposto-venda"
                                                                class="form-control bg-light" placeholder="0.00"
                                                                readonly>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="preco-venda-sem-imposto-input">Venda Sem
                                                                Imposto</label>
                                                            <input type="number" id="preco-venda-sem-imposto-input" name="preco-venda-sem-imposto-input"
                                                                class="form-control bg-light" placeholder="0.00"
                                                                readonly>
                                                        </div>

                                                        <!-- <div class="form-group mb-3">
                                                            <label for="desconto">Desconto</label>
                                                            <input type="number" id="desconto" name="desconto" class="form-control" step="0.01">
                                                        </div> -->

                                                        <div class="form-group mb-3">
                                                            <label for="margem-lucro">Margem de Lucro (%)</label>
                                                            <input type="number" id="margem-lucro" name="margem-lucro"
                                                                class="form-control bg-info-subtle" placeholder="0.00"
                                                                readonly>
                                                        </div>

                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                    </div>





                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <!--  <button type="submit" class="btn btn-warning" form="formAddCategoria">Salvar</button> -->

                                        <button type="submit" class="btn btn-success">Salvar</button>

                                    </div>
                                </form>



                            </div>

                        </div>
                    </div>

                </div>




                <!-- jQuery completo -->
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

                <!-- Bootstrap 4 JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

                <!-- Font Awesome (somente uma vez) -->
                <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

                <!-- Seus scripts -->

                <script src="modulos/produto.js"></script>
                <script src="index.js"></script>
                <script src="js/user.js"></script>



                <script>
                    /*
document.addEventListener("DOMContentLoaded", () => {

    const taxaCusto = document.getElementById("product-taxe");
    const custoCom = document.getElementById("preco-custo-com-imposto"); 
    const custoSem = document.getElementById("preco-custo-sem-imposto");  
    const impostoCusto = document.getElementById("imposto-custo");

    function calcularCusto() {
        const valorCom = parseFloat(custoCom.value) || 0;
        const taxaValor = taxaCusto.value;

        if (taxaValor === "ISENTO") {
            custoSem.value = valorCom.toFixed(2);
            impostoCusto.value = "0.00";
        } else {
            const perc = parseFloat(taxaValor); 
            const valorImposto = valorCom * (perc / 100); // simples percentual sobre valor com imposto
            const valorSem = valorCom - valorImposto;

            custoSem.value = valorSem.toFixed(2);
            impostoCusto.value = valorImposto.toFixed(2);
        }
    }

    taxaCusto.addEventListener("change", calcularCusto);
    custoCom.addEventListener("input", calcularCusto);

});*/
                </script>


                <script>
                    document.addEventListener("DOMContentLoaded", () => {

                        const form = document.getElementById("formAddProduto"); // 🔴 FALTAVA

                        const taxaCusto = document.getElementById("product-taxe");
                        const custoCom = document.getElementById("preco-custo-com-imposto");
                        const custoSem = document.getElementById("preco-custo-sem-imposto");
                        const impostoCusto = document.getElementById("imposto-custo");

                        const vendaCom = document.getElementById("preco-venda-com-imposto-input");
                        const vendaSem = document.getElementById("preco-venda-sem-imposto-input");
                        const impostoVenda = document.getElementById("imposto-venda");
                        const margemLucro = document.getElementById("margem-lucro");

                        function calcularCusto() {
                            const valorCom = parseFloat(custoCom.value) || 0;
                            const taxaValor = taxaCusto.value;

                            if (taxaValor === "ISENTO") {
                                custoSem.value = valorCom.toFixed(2);
                                impostoCusto.value = "0.00";
                            } else {
                                const perc = parseFloat(taxaValor);
                                const valorImposto = valorCom * (perc / 100);
                                const valorSem = valorCom - valorImposto;

                                custoSem.value = valorSem.toFixed(2);
                                impostoCusto.value = valorImposto.toFixed(2);
                            }

                            atualizarVenda();
                        }

                        function atualizarVenda() {
                            const valorVendaCom = parseFloat(vendaCom.value) || 0;
                            const valorImposto = parseFloat(impostoCusto.value) || 0;

                            impostoVenda.value = valorImposto.toFixed(2);
                            vendaSem.value = (valorVendaCom - valorImposto).toFixed(2);

                            calcularMargem();
                        }

                        function calcularMargem() {
                            const baseCusto = parseFloat(custoSem.value) || 0;
                            const baseVendaSem = parseFloat(vendaSem.value) || 0;

                            // Margem de lucro absoluta
                            const margem = baseVendaSem - baseCusto;
                            margemLucro.value = margem.toFixed(2);
                        }

                        // Eventos
                        taxaCusto.addEventListener("change", calcularCusto);
                        custoCom.addEventListener("input", calcularCusto);
                        vendaCom.addEventListener("input", atualizarVenda);
                        vendaCom.addEventListener("change", atualizarVenda);
                        vendaCom.addEventListener("blur", atualizarVenda);



                        // Envio via Fetch
                        form.addEventListener("submit", function(e) {
                            e.preventDefault();

                            const formData = new FormData(form);
                            const productId = document.getElementById("product-id").value;

                            if (productId) formData.append("action", "update");
                            else formData.append("action", "create");

                            fetch("modulos/salvar_&_atualizar_produto.php", {
                                    method: "POST",
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log("Sucesso:", data);
                                    /*alert(productId ? "Produto atualizado!" : "Produto cadastrado!");
                                    if (!productId) form.reset();
                                    carregarProdutos();
                                    $('#modalAddProduto').modal('hide');*/

                                    if (data.status === "success" || data.success === true) {

                                        mostrarAlerta(
                                            productId ?
                                            "Produto atualizado com sucesso!" :
                                            "Produto cadastrado com sucesso!",
                                            "success"
                                        );

                                        form.reset();
                                        $('#modalAddProduto').modal('hide');
                                        carregarProdutos(); // ✔ só recarrega se deu sucesso

                                    } else {
                                        mostrarAlerta(
                                            data.msg || "Erro ao salvar produto",
                                            "danger"
                                        );
                                    }


                                })
                                .catch(err => {
                                    console.error("Erro:", err);
                                    alert("Erro ao enviar dados!");
                                });
                        });

                        /*form.addEventListener("submit", async function(e) {
                            e.preventDefault();

                            const formData = new FormData(form);
                            const productId = document.getElementById("product-id").value;

                            // Escolhe o endpoint certo
                            const url = productId ? "modulos/atualizar_produto.php" : "modulos/salvar_produto.php";

                            try {
                                const response = await fetch(url, {
                                    method: "POST",
                                    body: formData
                                });

                                const data = await response.json();
                                console.log("Resposta do servidor:", data);

                                if (data.status === "success") {
                                    alert(data.msg);
                                    form.reset();
                                    $('#modalAddProduto').modal('hide');
                                    // Recarregar lista de produtos aqui se necessário
                                } else {
                                    alert("Erro: " + data.msg);
                                }

                            } catch (err) {
                                console.error("Erro no fetch:", err);
                                alert("Erro ao enviar dados!");
                            }
                        });*/


                    });
                </script>












            </div>
        </nav>
    </div>
</body>

</html>