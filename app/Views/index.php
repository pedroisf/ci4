<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datatable</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Toastify js -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Font -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apercu-font@1.0.0/Apercu.css">

    <style>
        .hidden {
            display: none;
        }

        #view {
            width: 80vw;
            background-color: #f0f0f0;
            transition: width 0.5s ease-out;
        }

        .hide-fade {
            display: none;
        }

        /* @keyframes slideIn {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 0;
            }
        } */
    </style>
</head>

<body style="background-color:#F0F0F0;  font-family: 'Apercu', sans-serif;">
    <div class="container bg-white shadow rounded mt-4 mb-4" id="view">
        <nav class="navbar navbar-white bg-white border border-muted border-top-0 border-start-0 border-end-0  mb-4">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Atendimento Online</span>
            </div>
        </nav>

        <div class="container" id="mainContent">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row px-0 d-flex justify-content-bottom align-items-end mb-4">
                        <div class="col-8">
                            Gerenciamento de<br>
                            <span class="h3 fw-bold">
                                Pacientes
                            </span>
                        </div>
                        <div class="col-4 d-grid gap-2 d-md-flex justify-content-md-end" id="btns">

                            <label type="button" name="arquivo_csv"
                                class="btn btn-light border border-dark d-inline csv" for="arquivo_csv">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <g fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2">
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path
                                            d="M5 12V5a2 2 0 0 1 2-2h7l5 5v4M7 16.5a1.5 1.5 0 0 0-3 0v3a1.5 1.5 0 0 0 3 0m3 .75c0 .414.336.75.75.75H12a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1h1.25a.75.75 0 0 1 .75.75m3-.75l2 6l2-6" />
                                    </g>
                                </svg>
                                Importar CSV
                            </label>
                            <input class="form-control" type="file" id="arquivo_csv"
                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                onchange="importar()" hidden>

                            <button type="button" class="btn btn-primary border d-inline registro"
                                onclick="novoRegistro()">
                                <i class="fa-solid fa-plus me-1"></i>
                                Novo registro
                            </button>
                        </div>
                    </div>

                    <div id="formView" class="mt-5 mb-5">
                        <form method="post" class="card border-0 needs-validation" novalidate id="form-novo">

                            <h5>Novo registro</h5>
                            <hr class="opacity-25 mt-0 pt-0">
                            <div class="row g-3">
                                <div class="col-sm-5">
                                    <label class="label-control fw-bold" for="nome">Nome</label>
                                    <input type="text" class="form-control inputNovoRegistro" name="nome" id="nome"
                                        placeholder="Nome" required aria-label="Nome">
                                    <div class="invalid-feedback">
                                        Preencha o nome
                                    </div>
                                    <div class="valid-feedback">
                                        Parece ótimo!
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <label class="label-control fw-bold" for="data_nascimento">Data de
                                        Nascimento</label>
                                    <input type="date" class="form-control inputNovoRegistro" id="data_nascimento"
                                        name="data_nascimento" required placeholder="Data de Nascimento"
                                        aria-label="Data de Nascimento">
                                    <div class="invalid-feedback">
                                        Preencha a Data de Nascimento
                                    </div>
                                    <div class="valid-feedback">
                                        Parece ótimo!
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <label class="label-control fw-bold">Sexo:</label>
                                    <br>
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input inputNovoRegistro" type="radio" name="sexo"
                                            id="sexom" value="M" required>
                                        <label class="form-check-label" for="sexom">Masculino</label>


                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input inputNovoRegistro" type="radio" name="sexo"
                                            id="sexof" value="F" required>
                                        <label class="form-check-label" for="sexof">Feminino</label>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-sm-4">
                                        <label class="label-control fw-bold" for="telefone">Telefone:</label>
                                        <input type="text" class="form-control inputNovoRegistro telefone" id="telefone"
                                            name="telefone" placeholder="Telefone" required aria-label="Telefone">
                                        <div class="invalid-feedback">
                                            Preencha o Telefone
                                        </div>
                                        <div class="valid-feedback">
                                            Parece ótimo!
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <label class="label-control fw-bold" for="endereco">Endereço:</label>
                                        <input type="text" class="form-control inputNovoRegistro" id="endereco"
                                            name="endereco" required placeholder="Endereço" aria-label="Endereço">
                                        <div class="invalid-feedback">
                                            Preencha o Endereço
                                        </div>
                                        <div class="valid-feedback">
                                            Parece ótimo!
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="text-end">
                                        <button required type="button" class="btn btn-light border me-2"
                                            onclick="novoRegistro('voltar')">Fechar</button>
                                        <button class="btn btn-primary">Salvar</button>
                                    </div>
                                </div>

                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable"
                        class="table table-light table-hover table-striped border border-muted rounded-3 mt-5"
                        style="width:100%">

                        <thead class="border border-5">
                            <tr>
                                <th class="notexport"></th>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Dta. Nascimento</th>
                                <th>Sexo</th>
                                <th>Endereço</th>
                                <th>Telefone</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript"
            src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
        <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>

        <script defer>
            var table = $('#myTable').DataTable({
                ajax: {
                    url: '<?= base_url('Pacientes/pesquisa') ?>',
                    type: 'GET',
                    dataSrc: function (json) {
                        return json.data;
                    }
                },
                columnDefs: [
                    { "orderable": false, "targets": 0 }
                ],
                columns: [
                    { data: 'actions', ordering: false },
                    { data: 'id' },
                    { data: 'nome' },
                    { data: 'data_nascimento' },
                    { data: 'sexo' },
                    { data: 'endereco' },
                    { data: 'telefone' }
                ],
                order: [[1, 'asc']],
                serverSide: true,
                processing: true,
                ordering: true,
                bLengthChange: false,
                dom: '<"top d-flex bd-highlight">rt<"bottom"ip><"clear">',
                language: {
                    "sProcessing": "Processando...",
                    "sLengthMenu": "Exibir _MENU_ registros por página",
                    "sZeroRecords": "Nenhum resultado encontrado",
                    "sEmptyTable": "Nenhum resultado encontrado",
                    "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
                    "sInfoFiltered": "",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Carregando...",
                    "oPaginate": {
                        "sFirst": "Primeiro",
                        "sLast": "Último",
                        "sNext": "❯",
                        "sPrevious": "❮"
                    },
                    "oAria": {
                        "sSortAscending": ": Ativar para ordenar a coluna de maneira ascendente",
                        "sSortDescending": ": Ativar para ordenar a coluna de maneira descendente"
                    }
                }
            });

            $('.dt-button').removeClass('dt-button');
            $('.dt-buttons').removeClass('dt-buttons').addClass('h-100 d-inline');

            var topDiv = document.querySelector('.top');

            var reloading = `   <div class="d-inline h-100 ms-1">
                                        <button class="btn btn-light border opacity-75 h-100" id="reloadButton">
                                            <i class="fa-solid fa-rotate-right"></i>
                                        </button>
                                    </div>
                                `;
            var searching = `   <div class="d-inline h-100 me-1">
                                        <input type="text" class="form-control bg-muted h-100" id="customSearchInput" placeholder="🔍︎  Pesquisar">
                                    </div>
                                `;
            var exportCSV = `<a href="<?= base_url('Pacientes/pesquisa?exportCSV=1') ?>"
                                    class="btn btn-light border h-100 border-muted" >
                                        <span class="opacity-75">
                                            <i class="fa-solid fa-download me-1"></i> 
                                            Exportar CSV
                                        </span>
                                 </a>`;

            $("#myTable_info").addClass("me-auto p-2 bd-highlight");
            $("#myTable_paginate").addClass("mt-1");
            $(".dataTables_info").appendTo(".top");

            topDiv.insertAdjacentHTML('beforeend', searching);
            topDiv.insertAdjacentHTML('beforeend', exportCSV);
            topDiv.insertAdjacentHTML('beforeend', reloading);
            $('.top').css('height', '40px');

            $('#customSearchInput').keyup($.debounce(500, function (e) {
                table.search(this.value).draw();
            }));

            $('#reloadButton').on('click', function () {
                table.ajax.reload();
            });

            $('#form-novo').on('submit', function (event) {
                event.preventDefault();

                if (validar()) {
                    var formData = $(this).serialize();

                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('Pacientes/save') ?>',
                        data: formData,
                        success: function (response) {
                            res = JSON.parse(response)
                            console.log(res)
                            console.log(response)
                            if (res.success) {
                                novoRegistro('voltar')
                                table.ajax.reload()
                                Toastify({
                                    text: res.message,
                                    className: "success",
                                    duration: 4000,
                                    style: {
                                        background: "linear-gradient(to right, #00b09b,#00aab0)",
                                    }
                                }).showToast();
                            } else {
                                Toastify({
                                    text: res.message,
                                    className: "error",
                                    duration: 4000,
                                    style: {
                                        background: "linear-gradient(to right, #B71C1C, #D32F2F)",
                                    }
                                }).showToast();
                            }
                        }, error: function (error) {
                            Toastify({
                                text: 'Ocorreu um erro na requisição.',
                                className: "error",
                                duration: 4000, style: {
                                    background: "linear-gradient(to right, #B71C1C, #D32F2F)",
                                }
                            }).showToast();
                        }

                    });
                }
            });

            $('.telefone').mask('(99) 9.9999-9999');

            // Validação front
            function validar() {
                const form = document.querySelector('#form-novo');
                if (!form.checkValidity()) {
                    Toastify({
                        text: 'Existem campos obrigatórios que não foram preenchidos!',
                        duration: 4000,
                        style: {
                            background: "linear-gradient(to right, #B71C1C, #D32F2F)",
                        }
                    }).showToast();
                    form.classList.add('was-validated');
                    return false;
                }

                return true;
            }

            function importar() {
                let csv = $('#arquivo_csv').prop('files')[0];

                if (!csv) {
                    alert('Por gentileza, selecione um arquivo CSV.');
                    return;
                }

                const formData = new FormData();
                formData.append('arquivo_csv', csv);

                $.ajax({
                    url: '<?= base_url('Pacientes/importar') ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        const res = JSON.parse(response);
                        if (res.success) {
                            if (res.data) {
                                table.ajax.reload()

                                Toastify({
                                    text: res.message,
                                    className: "success",
                                    duration: 4000, style: {
                                        background: "linear-gradient(to right, #00b09b,#00aab0)",
                                    }
                                }).showToast();
                                table.ajax.reload();
                            } else {
                                Toastify({
                                    text: res.message,
                                    className: "error",
                                    duration: 4000, style: {
                                        background: "linear-gradient(to right, #B71C1C, #D32F2F)",
                                    }
                                }).showToast();
                            }
                        } else {
                            Toastify({
                                text: res.message,
                                className: "error",
                                duration: 4000, style: {
                                    background: "linear-gradient(to right, #B71C1C, #D32F2F)",
                                }
                            }).showToast();
                        }
                    },
                    error: function (error) {
                        Toastify({
                            text: 'Ocorreu um erro na requisição.',
                            className: "error",
                            duration: 4000, style: {
                                background: "linear-gradient(to right, #B71C1C, #D32F2F)",
                            }
                        }).showToast();
                    }

                })

                $('#arquivo_csv').val('')

            }

            $('#formView').hide();
            function novoRegistro(tipo = '') {
                if (tipo === 'voltar') {
                    $('#formView').slideToggle('slow');
                    $('#btns').removeClass('opacity-75');
                    $('.csv').removeClass('disabled');
                    $('.registro').removeClass('disabled');
                    $('#form-novo').removeClass('was-validated');
                    $('#form-novo')[0].reset();
                } else {
                    setTimeout(() => {
                        $('#btns').addClass('opacity-75');
                        $('.csv').addClass('disabled');
                        $('.registro').addClass('disabled');
                        $('#formView').slideToggle('slow');
                        $('#form-novo').removeClass('was-validated');
                        $('#form-novo')[0].reset();
                    }, 500);
                }

            }
        </script>
    </div>
    </div>
</body>

</html>