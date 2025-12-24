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

            <li class="item-menu ativo">
                <a href="categoria.php">
                    <span class="icon"><i class="bi bi-archive"></i></span>
                    <span class="txt-link">Categoria</span>
                </a>
            </li>


            <li class="item-menu">
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

                <h4 style="padding-bottom: 20px;">Lista de Categoria</h4>

                <!-- div para exibir alerts -->
                <div id="alert-container" class="mt-3"></div>


                <div class="row mb-3 align-items-center">
                    <div class="col-md-6">
                        <!-- Caixa de Pesquisa -->
                        <input type="text" class="form-control" placeholder="Pesquisar produto..." id="inputPesquisa">
                    </div>
                    <div class="col-md-6 text-right">
                        <!-- Botão Adicionar -->
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalAddCategoria" onclick="abrirModalAdicionar()">
                            <i class="fas fa-plus"></i> Adicionar Categoria
                        </button>
                    </div>
                </div>



                <!-- Scroll lateral -->
                <div style="overflow-x:auto;">
                    <table class="table table-striped table-bordered table-hover mt-3" id="tableCategorias">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Data</th>
                                <th>Descriação</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Teclado USB</td>
                                <td>500 MZN</td>
                                <td>4</td>
                            </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination justify-content-end" id="pagination"></ul>
                    </nav>

                </div>

                <!-- paginação alinhada à direita 
                <nav aria-label="Páginas de resultados">
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
                </nav> -->





                <div class="modal fade" id="modalAddCategoria" tabindex="-1" aria-labelledby="modalAddCategoriaLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-warning text-white">
                                <h5 class="modal-title" id="modalTitle">Adicionar Categoria</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body modal-body-scroller">
                                <form id="formAddCategoria">
                                    <!-- id oculto da categoria -->
                                    <input type="hidden" id="categoria-id">
                                    

                                    <div class="mb-3">
                                        <label for="categoria-nome" class="form-label">Tipo</label>
                                        <input type="text" class="form-control" id="categoria-tipo" placeholder="Tipo da Categoria" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoria-estado" class="form-label">Estado</label>
                                        <select name="estado" id="categoria-estado" class="form-control" required>
                                            <option value="">Selecionar...</option>
                                            <option value="ativo">Ativo</option>
                                            <option value="inativo">Inativo</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoria-descricao" class="form-label">Descrição</label>
                                        <textarea class="form-control" id="categoria-descricao" rows="3" placeholder="Descrição da Categoria"></textarea>
                                    </div>


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success" id="btnSalvar">Salvar</button>
                                    </div>
                                </form>
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
                    <script src="index.js"></script>
                    <script src="js/user.js"></script>



                    <!-- funcao para carregar categorias e listar na tabela, usando fetch, vai usar get_categoria.php que esta na tabela modulos -->

                    <script src="modulos/categoria.js"></script>

                </div>
        </nav>
    </div>
</body>

</html>