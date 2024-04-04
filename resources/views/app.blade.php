<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Outras tags head -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">
    <script>
        function filtrarCargos() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("filtroDescricao");
            filter = input.value.toUpperCase();
            table = document.getElementById("tabelaId");
            tr = table.getElementsByTagName("tr");

            // Loop por todas as linhas da tabela e esconde aquelas que não correspondem à pesquisa
            for (i = 1; i < tr.length; i++) { // começa com 1 para ignorar o cabeçalho da tabela
                td = tr[i].getElementsByTagName("td")[1]; // Index 1 para a coluna de 'Descrição'
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</head>

<body>
    <div class="container-fluid">
        <!-- Modal -->
        <div class="modal fade" id="modalAdicionarCargo" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarCargoLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="modalAdicionarCargoLabel">Adicionar Cargo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulário para adicionar cargo -->
                        <form id="formAdicionarCargo" method="POST" action="{{ route('cargos.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="descricaoCargo">Descrição</label>
                                <input type="text" class="form-control" id="descricaoCargo" name="descricao" required placeholder="Digite a descrição do cargo">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal">
                                    <i class="fa fa-ban"></i> Voltar
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Menu Lateral -->
            <div class="col-md-2">
                <!-- Lista do Menu Lateral -->
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>
                    <!-- Mais itens do menu aqui -->
                </ul>
            </div>

            <div class="col-md-10">
                <h1>Cargos</h1>
                <!-- Dentro do <div class="col-md-10"> -->
                <div class="table-responsive text-right mb-3">
                    <button type="button" class="btn text-white bg-info mb-4" data-toggle="modal" data-target="#modalAdicionarCargo">
                        <i class="fa fa-plus"></i> Adicionar Cargo
                    </button>

                    <table class="table" id="tabelaId">
                        <thead class="thead-light">
                            <tr>
                                <th>Código</th>
                                <th>
                                    Descrição
                                    <input type="text" id="filtroDescricao" placeholder="Descrição..." onkeyup="filtrarCargos()">
                                </th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cargos as $cargo)
                            <tr>
                                <td>{{ $cargo->id }}</td>
                                <td>{{ $cargo->descricao }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>