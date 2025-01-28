<?php

namespace App\Libraries;

class Datatable
{
  /**
   * Prepara os dados e cria a estrutura para ser usada no datatable
   *
   * @param array $data Array de dados da tabela
   * @param array $filtered Array com a contagem de dados (geral e filtrados)
   * @param int $actionRules Switch case de ações permitidas na linha do registro.
   *
   * @return array Retorna a estrutura pronta para usar no datatable.
   */
  public function draw($data, $filtered, $actionRules = 0)
  {
    if ($actionRules) {
      foreach ($data as &$row) {
        $row['actions'] = "<i class='fa-solid text-primary fa-clipboard-list'></i>";
        $this->returnPattern($row);
      }
      unset($row);
    }

    $datatable = [
      'draw' => $_GET['draw'] ??= 1,
      'recordsTotal' => $filtered['geral'],
      'recordsFiltered' => $filtered['filtrado'],
      'data' => $data
    ];

    return $datatable;
  }

  /**
   * Está função usa funções do php para sanitizar dados.
   *
   * @param string $input O dado que será sanitizado.
   *
   * @return string O dado sanitizado.
   */
  public function sanitize($input)
  {
    return trim(htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));
  }

  /**
   * Esta função aplica uma formatação em dados específicos, caso atenda aos critérios.
   * 
   * Regras de aplicação baseado em tipos suportados:
   * - DATA (YYYY-MM-DD), retornar ao padrão brasileiro: DD-MM-YYYY
   * - TELEFONE, exemplo de entrada com 10 dígitos: 000912345678, saida: (00) 1234-5678
   *             exemplo de entrada com 11 dígitos: 000912345678, saida: (00) 9.1234-5678
   *             exemplo de entrada com 12 dígitos: 000912345678, saida: (000) 9.1234-5678
   *
   * @param array &$array Array a ser formatado.
   *
   * @return array Array formatado
   */
  public function returnPattern(&$array)
  {
    foreach ($array as &$value) {
      if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
        $value = date("d/m/Y", strtotime($value));
        continue;
      }

      if (preg_match('/^\d{10}$/', $value)) {
        $value = "(" . substr($value, 0, 2) . ") " . substr($value, 2, 4) . "-" . substr($value, 4, 4);
        continue;
      } elseif (preg_match('/^\d{11}$/', $value)) {
        $value = "(" . substr($value, 0, 2) . ") " . substr($value, 2, 1) . '.' . substr($value, 3, 4) . "-" . substr($value, 7, 4);
        continue;
      } elseif (preg_match('/^\d{12}$/', $value)) {
        $value = "(" . substr($value, 0, 3) . ") " . substr($value, 3, 1) . '.' . substr($value, 4, 4) . "-" . substr($value, 8, 4);
        continue;
      }
    }
    return $array;
  }

  /**
   * Essa função elabora um CSV temporário com os dados server-side.
   *
   * @param array $array Dados que serão exportados.
   * @param array $columns Nomes das colunas que serão exportadas.
   * @param string $name Nome do documento, caso não informado, retornará: 'dados'.
   */
  public function exportCSV($array, $columns, $name = '')
  {
    $name ? $name : 'dados.csv';
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="$name.csv"');

    $output = fopen('php://output', 'w');

    try {
      fputcsv($output, $columns);

      foreach ($array['registros'] as $row) {
        fputcsv($output, $row);
      }

      fclose($output);
      exit;
    } catch (\Exception $e) {
      return null;
    }
  }

}
