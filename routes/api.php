<?php

use App\Http\Controllers\FeriadoController;
use Illuminate\Http\Request;


Route::middleware('cors')->name('api.')->group(function () {

    // Rotas Estagiários
    Route::prefix('estagiarios')->group(function () {
        Route::get('/', 'EstagiariosController@getEstagiarios')->name('estagiarios'); // Retorna todos os estagiarios
        Route::get('/{cpf}', 'EstagiariosController@getEstagiariosById')->name('estagiario_por_cpf'); // Retorna o estagiario por cpf
        Route::post('/', 'EstagiariosController@setEstagiario')->name('cadastrar_estagiario'); // Cadastrar estagiario
        Route::patch('/{cpf}', 'EstagiariosController@update')->name('editar_estagiario'); // Atualizar estagiario
        Route::delete('/{cpf}', 'EstagiariosController@delete')->name('deletar_estagiario'); // Deletar estagiario
    });

    // Rotas Supervisores
    Route::prefix('supervisores')->group(function () {
        Route::get('/', 'SupervisorController@getSupervisores')->name('supervisores'); // Retorna todos os supervisores
        Route::get('/{nome}', 'SupervisorController@getSupervisorByName')->name('supervisor_por_nome'); // Retornar o supervisor por nome 
        Route::post('/', 'SupervisorController@setSupervisor')->name('cadastrar_supervisor'); // Cadastrar supervisor
    });

    // Rotas Supervisor Alteração
    Route::prefix('supervisor_alteracao')->group(function () {
        Route::post('/', 'SupervisorAlteracaoController@setSupervisor')->name('supervisor_alteracao'); // Retorna todos os supervisores
    });

    // Rotas vagas
    Route::prefix('vagas')->group(function () {
        Route::get('/', 'VagaController@getVagas')->name('vagas'); // Retornar todas as vagas
        Route::get('/{id}', 'VagaController@getVagasById')->name('vaga_por_id'); // Retorna a vaga pelo id
        Route::post('/', 'VagaController@setVaga')->name('cadastrar_vaga'); // Cadastra vaga
        Route::patch('/{id}', 'VagaController@update')->name('editar_vaga'); // Atualizar Vaga
        Route::delete('/{id}', 'VagaController@delete')->name('deletar_vaga'); // Deletar vaga
    });

    // Rotas Departamentos
    Route::prefix('departamentos')->group(function () {
        Route::get('/', 'DepartamentoController@getDepartamentos')->name('departamentos'); // Retornar todos os departamentos
        Route::get('/{eh}', 'DepartamentoController@getDepartamentoById')->name('departamento_por_eh'); // Retornar o departamento por eh
        Route::post('/', 'DepartamentoController@setDepartamento')->name('cadastrar_departamento'); // Cadastrar um departamento
        Route::patch('/{eh}', 'DepartamentoController@update')->name('editar_departamento'); // Atualizar um departamento
        Route::delete('/{eh}', 'DepartamentoController@delete')->name('deletar_departamento'); // Deletar um departamento
    });

    // Rotas Cartão de Acesso
    Route::prefix('cartao')->group(function () {
        Route::get('/', 'CartaoController@getCartao')->name('cartao'); // Retornar todos os cartoes
        Route::post('/', 'CartaoController@setCartao')->name('cadastrar_cartao'); // Cadastra cartao
        Route::patch('/{id}', 'CartaoController@update')->name('editar_cartao'); // Atualizar cartao
        Route::delete('/{id}', 'CartaoController@delete')->name('deletar_cartao'); // Deletar cartao
    });

    // Rota Estados
    Route::prefix('estados')->group(function () {
        Route::get('/', 'EstadoController@getEstado')->name('estados'); // Retornar todos os estados
    });

    // Rotas Instituições de Ensino
    Route::prefix('instituicao')->group(function () {
        Route::get('/', 'InstituicaoController@getInstituicao')->name('instituicao'); // Retornar todas as instituíções
        Route::post('/', 'InstituicaoController@setInstituicao')->name('cadastrar_instituicao'); // Cadastra instituíção
    });

    // Rotas Cursos
    Route::prefix('cursos')->group(function () {
        Route::get('/', 'CursoController@getCurso')->name('cursos'); // Retornar todos os cursos
        Route::get('/{id}', 'CursoController@getCursoById')->name('curso_por_id'); // Retornar curso por id
        Route::post('/', 'CursoController@setCurso')->name('cadastrar_curso'); // Cadastra Curso
        Route::delete('/{id}', 'CursoController@delete')->name('deletar_curso'); // Deleta Curso
        Route::patch('/{id}', 'CursoController@update')->name('editar_curso'); // Atualiza Curso
    });

    // Rota Cargos Supervisores
    Route::prefix('cargos')->group(function () {
        Route::get('/', 'CargoController@getCargo')->name('cargos'); // Retornar todos os cargos
    });

    // Rota Cód. Estudante
    Route::prefix('cod')->group(function () {
        Route::get('/{cod_estudante}', 'CodEstudanteController@getCodById')->name('cod'); // Retorna o estagiario pelo cod digitado
    });
    
    Route::prefix('feriados')->group(function () {
        Route::get('/', 'FeriadoController@getFeriados')->name('feriados'); // Retorna todos os feriados cadastrados no banco        
        Route::get('/verifica/{data}', 'FeriadoController@checkFeriado')->name('check_feriado'); // Verifica se data informada é feriado
        Route::get('/periodo/{inicio}/{fim}', 'FeriadoController@checkPeriodo')->name('check_periodo');
    });
});
