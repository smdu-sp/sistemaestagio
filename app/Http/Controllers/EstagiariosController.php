<?php

namespace App\Http\Controllers;
use App\Estagiario;

use Illuminate\Http\Request;

class EstagiariosController extends Controller
{
    public function setEstagiario(Request $request) {
        
        $estagiario = Estagiario::create([
            'cod_estudante'=>$request->input('cod_estudante'),
            'contrato'=>$request->input('contrato'),
            'tc_superestagios'=>$request->input('tc_superestagios'),
            'cod_vaga'=>$request->input('cod_vaga'),
            'login'=>$request->input('login'),
            'cartao_acesso'=>$request->input('cartao_acesso'),
            'contratado_por'=>$request->input('contratado_por'),
            'nome'=>$request->input('nome'),
            'nome_social'=>$request->input('nome_social'),
            'endereco'=>$request->input('endereco'),
            'nro'=>$request->input('nro'),
            'cep'=>$request->input('cep'),
            'bairro'=>$request->input('bairro'),
            'estado'=>$request->input('estado'),
            'fone_residencial'=>$request->input('fone_residencial'),
            'fone_celular'=>$request->input('fone_celular'),
            'data_nascimento'=>$request->input('data_nascimento'),
            'naturalidade'=>$request->input('naturalidade'),
            'nacionalidade'=>$request->input('nacionalidade'),
            'cpf'=>$request->input('cpf'),
            'rg'=>$request->input('rg'),
            'orgao_expedidor_rg'=>$request->input('orgao_expedidor_rg'),
            'uf_rg'=>$request->input('uf_rg'),
            'rne'=>$request->input('rne'),
            'estado_civil'=>$request->input('estado_civil'),
            'nome_mae'=>$request->input('nome_mae'),
            'nome_pai'=>$request->input('nome_pai'),
            'raca_cor'=>$request->input('raca_cor'),
            'sexo'=>$request->input('sexo'),
            'email_pessoal'=>$request->input('email_pessoal'),
            'email_corporativo'=>$request->input('email_corporativo'),
            'instituicao_ensino'=>$request->input('instituicao_ensino'),
            // 'campus'=>$request->input('campus'),
            'curso_formacao'=>$request->input('curso_formacao'),
            'ano_semestre'=>$request->input('ano_semestre'),
            'periodo'=>$request->input('periodo'),
            'horario'=>$request->input('horario'),
            'duracao_curso'=>$request->input('duracao_curso'),
            'mes_ano_previsto_curso'=>$request->input('mes_ano_previsto_curso'),
            'matricula'=>$request->input('matricula'),
            'observacoes1'=>$request->input('observacoes1'),
            // 'foto'=>$request->input('foto'),
            'dep_hierarquico'=>$request->input('dep_hierarquico'),
            'setor_estagiado'=>$request->input('setor_estagiado'),
            'supervisor'=>$request->input('supervisor'),
            'dt_inicio'=>$request->input('dt_inicio'),
            'dt_termino_inicial_lauda'=>$request->input('dt_termino_inicial_lauda'),
            'dt_termino'=>$request->input('dt_termino'),
            // 'dt_inicio_1_aditivo'=>$request->input('dt_inicio_1_aditivo'),
            // 'dt_termino_1_aditivo'=>$request->input('dt_termino_1_aditivo'),
            // 'dt_inicio_2_aditivo'=>$request->input('dt_inicio_1_aditivo'),
            // 'dt_termino_2_aditivo'=>$request->input('dt_termino_2_aditivo'),
            // 'dt_inicio_3_aditivo'=>$request->input('dt_inicio_3_aditivo'),
            // 'dt_termino_3_aditivo'=>$request->input('dt_termino_3_aditivo'),
            // 'aditivo1'=>$request->input('aditivo1'),
            // 'aditivo2'=>$request->input('aditivo2'),
            // 'aditivo3'=>$request->input('aditivo3'),
            'horario_entrada'=>$request->input('horario_entrada'),
            'horario_saida'=>$request->input('horario_saida'),
            'horario_variavel'=>$request->input('horario_variavel'),
            'situacao'=>$request->input('situacao'),
            // 'desligado'=>$request->input('desligado'),
            'observacao2'=>$request->input('observacao2'),
            // 'semestre_desligamento'=>$request->input('semestre_desligamento'),
            // 'qt_horas_estagiada'=>$request->input('qt_horas_estagiada'),
            // 'qt_dias_legais'=>$request->input('qt_dias_legais'),
            // 'qt_dias_gozados'=>$request->input('qt_dias_gozados'),
            // 'qt_dias_restantes'=>$request->input('qt_dias_restantes'),
            // 'qt_dias_solicitada_1'=>$request->input('qt_dias_solicitada_1'),
            // 'dt_inicial_1'=>$request->input('dt_inicial_1'),
            // 'dt_termino_1'=>$request->input('dt_termino_1'),
            // 'qt_dias_solicitada_2'=>$request->input('qt_dias_solicitada_2'),
            // 'dt_inicial_2'=>$request->input('dt_inicial_2'),
            // 'dt_termino_2'=>$request->input('dt_termino_2'),
            // 'qt_dias_solicitada_3'=>$request->input('qt_dias_solicitada_3'),
            // 'dt_inicial_3'=>$request->input('dt_inicial_3'),
            // 'dt_termino_3'=>$request->input('dt_termino_3'),
            // 'qt_dias_solicitada_4'=>$request->input('qt_dias_solicitada_4'),
            // 'dt_inicial_4'=>$request->input('dt_inicial_4'),
            // 'dt_termino_4'=>$request->input('dt_termino_4'),
            // 'qt_dias_solicitada_5'=>$request->input('qt_dias_solicitada_5'),
            // 'dt_inicial_5'=>$request->input('dt_inicial_5'),
            // 'dt_termino_5'=>$request->input('dt_termino_5'),
            // 'qt_dias_solicitada_6'=>$request->input('qt_dias_solicitada_6'),
            // 'dt_inicial_6'=>$request->input('dt_inicial_6'),
            // 'dt_termino_6'=>$request->input('dt_termino_6'),
            // 'qt_dias_solicitada_7'=>$request->input('qt_dias_solicitada_7'),
            // 'dt_Inicial_7'=>$request->input('dt_Inicial_7'),
            // 'dt_Termino_7'=>$request->input('dt_Termino_7'),
            // 'observacoes3'=>$request->input('observacoes3'),
            'instituicao_bancaria'=>$request->input('instituicao_bancaria'),
            'agencia'=>$request->input('agencia'),
            'conta'=>$request->input('conta'),
            'operacao'=>$request->input('operacao'),
            'data_modificacao'=>$request->input('data_modificacao'),
            'hora_modificacao'=>$request->input('hora_modificacao'),
            'houve_alteracao_supervisor'=>$request->input('houve_alteracao_supervisor'),
            'deficiencia'=>$request->input('deficiencia')
        ]);

        return $estagiario;
    }

    public function getEstagiarios() {
        return Estagiario::all();
    }

    public function getEstagiariosById(Estagiario $cpf) {
        return $cpf;
    }

    public function update(Request $request, Estagiario $cpf) {
        function corrigeData($d) {
            if (strpos($d, 'NaN') >= 0) {
                return null;
            }
            return $d;
        }
        $cpf->nome = $request->input('nome');
        $cpf->contrato = $request->input('contrato');
        $cpf->tc_superestagios= $request->input('tc_superestagios');
        $cpf->cod_vaga= $request->input('cod_vaga');
        $cpf->login = $request->input('login');
        $cpf->cod_estudante = $request->input('cod_estudante');
        $cpf->cartao_acesso = $request->input('cartao_acesso');
        $cpf->contratado_por = $request->input('contratado_por');
        $cpf->nome = $request->input('nome');
        $cpf->nome_social = $request->input('nome_social');
        $cpf->endereco= $request->input('endereco');
        $cpf->nro = $request->input('nro');
        $cpf->cep = $request->input('cep');
        $cpf->bairro = $request->input('bairro');
        $cpf->estado = $request->input('estado');
        $cpf->fone_residencial = $request->input('fone_residencial');
        $cpf->fone_celular = $request->input('fone_celular');
        $cpf->data_nascimento = $request->input('data_nascimento');
        $cpf->naturalidade = $request->input('naturalidade');
        $cpf->nacionalidade = $request->input('nacionalidade');
        $cpf->cpf= $request->input('cpf');
        $cpf->rg = $request->input('rg');
        $cpf->orgao_expedidor_rg = $request->input('orgao_expedidor_rg');
        $cpf->uf_rg = $request->input('uf_rg');
        $cpf->rne = $request->input('rne');
        $cpf->estado_civil = $request->input('estado_civil');
        $cpf->nome_mae = $request->input('nome_mae');
        $cpf->nome_pai = $request->input('nome_pai');
        $cpf->raca_cor = $request->input('raca_cor');
        $cpf->sexo = $request->input('sexo');
        $cpf->email_pessoal = $request->input('email_pessoal');
        $cpf->email_corporativo = $request->input('email_corporativo');
        $cpf->instituicao_ensino = $request->input('instituicao_ensino');
        $cpf->campus = $request->input('campus');
        $cpf->curso_formacao = $request->input('curso_formacao');
        $cpf->ano_semestre = $request->input('ano_semestre');
        $cpf->periodo = $request->input('periodo');
        $cpf->horario = $request->input('horario');
        $cpf->duracao_curso = $request->input('duracao_curso');
        $cpf->mes_ano_previsto_curso = $request->input('mes_ano_previsto_curso');
        $cpf->matricula = $request->input('matricula');
        $cpf->observacoes1 = $request->input('observacoes1');
        $cpf->foto = $request->input('foto');
        $cpf->dep_hierarquico = $request->input('dep_hierarquico');
        $cpf->setor_estagiado = $request->input('setor_estagiado');
        $cpf->supervisor = $request->input('supervisor');
        $cpf->dt_inicio = $request->input('dt_inicio');
        
        $cpf->dt_termino_inicial_lauda = $request->input('dt_termino_inicial_lauda');
        $cpf->dt_termino = $request->input('dt_termino');
        $cpf->dt_inicio_1_aditivo = $request->input('dt_inicio_1_aditivo');
        $cpf->dt_termino_1_aditivo = $request->input('dt_termino_1_aditivo');
        $cpf->dt_inicio_2_aditivo = $request->input('dt_inicio_2_aditivo');
        $cpf->dt_termino_2_aditivo = $request->input('dt_termino_2_aditivo');
        $cpf->dt_inicio_3_aditivo = $request->input('dt_inicio_3_aditivo');
        $cpf->dt_termino_3_aditivo = $request->input('dt_termino_3_aditivo');
        $cpf->aditivo1 = $request->input('aditivo1');
        $cpf->aditivo2 = $request->input('aditivo2');
        $cpf->aditivo3 = $request->input('aditivo3');
        $cpf->horario_entrada = $request->input('horario_entrada');
        $cpf->horario_saida = $request->input('horario_saida');
        $cpf->horario_variavel = $request->input('horario_variavel');
        $cpf->situacao = $request->input('situacao');
        $cpf->desligado = $request->input('desligado');
        $cpf->observacao2 = $request->input('observacao2');
        $cpf->semestre_desligamento = $request->input('semestre_desligamento');
        $cpf->qt_horas_estagiada = $request->input('qt_horas_estagiada');
        $cpf->qt_dias_legais = $request->input('qt_dias_legais');
        $cpf->qt_dias_gozados = $request->input('qt_dias_gozados');
        $cpf->qt_dias_restantes = $request->input('qt_dias_restantes');
        $cpf->qt_dias_solicitada_1 = $request->input('qt_dias_solicitada_1');
        $cpf->dt_inicial_1 = $request->input('dt_inicial_1');

        $cpf->dt_termino_1 = corrigeData($request->input('dt_termino_1'));
        $cpf->qt_dias_solicitada_2 = $request->input('qt_dias_solicitada_2');
        $cpf->dt_inicial_2 = corrigeData($request->input('dt_inicial_2'));
        $cpf->dt_termino_2 = corrigeData($request->input('dt_termino_2'));
        $cpf->qt_dias_solicitada_3 = $request->input('qt_dias_solicitada_3');
        $cpf->dt_inicial_3 = corrigeData($request->input('dt_inicial_3'));
        $cpf->dt_termino_3 = corrigeData($request->input('dt_termino_3'));
        $cpf->qt_dias_solicitada_4 = $request->input('qt_dias_solicitada_4');
        $cpf->dt_inicial_4 = corrigeData($request->input('dt_inicial_4'));
        $cpf->dt_termino_4 = corrigeData($request->input('dt_termino_4'));
        $cpf->qt_dias_solicitada_5 = $request->input('qt_dias_solicitada_5');
        $cpf->dt_inicial_5 = corrigeData($request->input('dt_inicial_5'));
        $cpf->dt_termino_5 = corrigeData($request->input('dt_termino_5'));
        $cpf->qt_dias_solicitada_6 = $request->input('qt_dias_solicitada_6');
        $cpf->dt_inicial_6 = corrigeData($request->input('dt_inicial_6'));
        $cpf->dt_termino_6 = corrigeData($request->input('dt_termino_6'));
        $cpf->qt_dias_solicitada_7 = $request->input('qt_dias_solicitada_7');
        $cpf->dt_inicial_7 = corrigeData($request->input('dt_inicial_7'));
        $cpf->dt_termino_7 = corrigeData($request->input('dt_termino_7'));
        $cpf->observacoes3 = $request->input('observacoes3');
        $cpf->instituicao_bancaria = $request->input('instituicao_bancaria');
        $cpf->agencia = $request->input('agencia');
        $cpf->conta = $request->input('conta');
        $cpf->operacao = $request->input('operacao');
        $cpf->data_modificacao = $request->input('data_modificacao');
        $cpf->hora_modificacao = $request->input('hora_modificacao');
        $cpf->houve_alteracao_supervisor = $request->input('houve_alteracao_supervisor');
        $cpf->save();

        return $cpf;
    }

    public function delete(Estagiario $cpf) {
        $cpf->delete();

        return $cpf;
    }
}