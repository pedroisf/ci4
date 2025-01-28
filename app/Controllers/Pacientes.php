<?php

namespace App\Controllers;

use App\Models\GenericModel;
use App\Models\PacientesModel;

use App\Libraries\Datatable;
use App\Libraries\Sanitizer;

class Pacientes extends BaseController
{
    protected $pacientes;
    protected $input;
    protected $datatable;
    protected $sanitizer;
    protected $generic;
    protected $table = 'cad_pacientes';
    protected $columns = [
        'id',
        'nome',
        'data_nascimento',
        'sexo',
        'endereco',
        'telefone'
    ];

    public function __construct()
    {
        $this->pacientes = new PacientesModel();
        $this->datatable = new Datatable();
        $this->sanitizer = new Sanitizer();
        $this->generic = new GenericModel();
    }

    public function index(): string
    {
        return view('index');
    }

    public function pesquisa()
    {
        $input = $_GET['search']['value'] ?? '';
        $export = $_GET['exportCSV'] ??= FALSE;

        $search = $this->datatable->sanitize($input);
        $list = $this->pacientes->get($search, $export);
        $this->exportCSV($list, $export);

        $table = $this->datatable->draw($list['registros'], $list['total'], 1);

        return $this->response->setJSON($table);
    }

    public function alter($cod = 0)
    {

    }

    public function importar()
    {
        header('Content-Type: application/json');

        if (isset($_FILES['arquivo_csv']) && $_FILES['arquivo_csv']['error'] == UPLOAD_ERR_OK) {
            $file = $_FILES['arquivo_csv']['tmp_name'];

            if (($csv = fopen($file, 'r')) !== FALSE) {
                $dados = [];
                $indice = [];

                while (($linha = fgetcsv($csv, 1000, ',')) !== FALSE) {
                    if (empty($indice)) {
                        $indice = $linha;
                        continue;
                    }

                    $rows = [];
                    foreach ($indice as $coluna => $nome) {
                        if (isset($linha[$coluna])) {
                            $rows[$nome] = $linha[$coluna];
                        } else {
                            $rows[$nome] = null;
                        }
                    }

                    if (isset($rows) && isset($rows['id'])) {
                        unset($rows['id']);
                    }

                    $dados[] = $rows;
                }

                fclose($csv);

                $this->generic->importDataCSV($this->table, $dados);

                echo json_encode([
                    'success' => true,
                    'message' => 'Arquivo processado com sucesso!',
                    'data' => $dados
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Erro ao abrir o arquivo CSV.'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Nenhum arquivo enviado ou erro no upload.'
            ]);
        }
    }

    private function exportCSV($list, $export)
    {
        if (isset($export) && $export == 1) {
            return $this->datatable->exportCSV($list, $this->columns);
        }
    }

    public function save()
    {
        header('Content-Type: application/json');

        if (!$_POST['nome'] || !$_POST['data_nascimento'] || !$_POST['sexo'] || !$_POST['telefone'] || !$_POST['endereco']) {
            echo json_encode(
                [
                    'success' => false,
                    'message' => 'Necessário preencher todos os campos obrigatórios!',
                ]
            );
        }

        $_POST['telefone'] = $this->sanitizer->chars($_POST['telefone']);
        $data = $this->sanitizer->post($_POST);

        if ($res = $this->generic->insertData($this->table, $data)) {
            echo json_encode(
                [
                    'success' => true,
                    'message' => 'Novo paciente cadastrado com sucesso!',
                    'data' => $res
                ]
            );
        } else {
            echo json_encode(
                [
                    'success' => false,
                    'message' => 'Ocorreu um erro ao cadastrar o paciente.'
                ]
            );
        }
    }
}
