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

                $success = true;
                $dados = [];
                $indice = [];
                $lin_err = [];
                $col_err = [];
                $lin_atual = 0;

                while (($linha = fgetcsv($csv, 1000, ',')) !== FALSE) {
                    $lin_atual++;
                    if (empty($indice)) {
                        $indice = $linha;
                        continue;
                    }

                    $rows = [];
                    foreach ($indice as $coluna => $valor) {

                        if (isset($linha[$coluna]) && !empty($linha[$coluna])) {
                            $rows[$valor] = $linha[$coluna];
                        } else {
                            $success = false;
                            $col_err[] = $indice[$coluna];
                            $lin_err[] = $lin_atual;
                        }
                    }

                    if (isset($rows) && isset($rows['id'])) {
                        unset($rows['id']);
                    }
                    $dados[] = $rows;

                    
                }
                fclose($csv);

                $date = date('Y-m-d');
                foreach ($dados as &$linha) {
                    $linha['usr_ins_cpa'] = 'admin';
                    $linha['dta_ins_cpa'] = $date;
                    $linha['usr_upd_cpa'] = 'admin';
                    $linha['dta_upd_cpa'] = $date;
                }

                if ($success) {
                    $import = $this->generic->importDataCSV($this->table, $dados);

                    if ($import) {
                        echo json_encode([
                            'success' => true,
                            'message' => "$import registros processados com sucesso!",
                            'data' => $dados
                        ]);
                    } else {
                        echo json_encode([
                            'success' => false,
                            'message' => "O valor dos campos da importação possui valores invalidos!"
                        ]);
                    }
                } else {
                    $linha = implode(', ', $lin_err);
                    $coluna = implode(', ', $col_err);

                    echo json_encode([
                        'warning' => true,
                        'message' => "Nenhum registro foi processado, pois a(s) linha(s) $linha possuem campo(s) obrigatório(s) que não foram preenchidos."
                    ]);
                }


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
        $_POST['usr_ins_cpa'] = 'admin';
        $_POST['dta_ins_cpa'] = date('Y-m-d');
        $_POST['usr_upd_cpa'] = 'admin';
        $_POST['dta_upd_cpa'] = date('Y-m-d');
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
