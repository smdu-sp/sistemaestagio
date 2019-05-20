<?php

use Illuminate\Http\Request;


Route::name('api.')->group(function() {

    // Rotas Estagiários
    Route::prefix('estagiarios')->group(function() {
        Route::get('/', 'EstagiariosController@getEstagiarios')->name('estagiarios'); // Retorna todos os estagiarios
        Route::get('/{cpf}', 'EstagiariosController@getEstagiariosById')->name('estagiario_por_cpf'); // Retorna o estagiario por cpf
        Route::post('/', 'EstagiariosController@setEstagiario')->name('cadastrar_estagiario'); // Cadastrar estagiario
        Route::patch('/{cpf}', 'EstagiariosController@update')->name('editar_estagiario'); // Atualizar estagiario
        Route::delete('/{cpf}', 'EstagiariosController@delete')->name('deletar_estagiario'); // Deletar estagiario
    });

    // Rotas Supervisores
    Route::prefix('supervisores')->group(function() {
        Route::get('/', 'SupervisorController@getSupervisores')->name('supervisores'); // Retorna todos os supervisores
        Route::get('/{rf}', 'SupervisorController@getSupervisorById')->name('supervisores_por_rf'); // Retorna o supervisor por RF
        Route::post('/', 'SupervisorController@setSupervisor')->name('cadastrar_supervisor'); // Cadastrar supervisor
        Route::patch('/{rf}', 'SupervisorController@update')->name('editar_supervisor'); // Atualizar supervisor
        Route::delete('/{rf}', 'SupervisorController@delete')->name('deletar_supervisor'); // Deletar supervisor
    });

    // Rotas vagas
    Route::prefix('vagas')->group(function() {
        Route::get('/', 'VagaController@getVagas')->name('vagas'); // Retornar todas as vagas
        Route::get('/{id}', 'VagaController@getVagasById')->name('vaga_por_id'); // Retorna a vaga pelo id
        Route::post('/', 'VagaController@setVaga')->name('cadastrar_vaga'); // Cadastra vaga
        Route::patch('/{id}', 'VagaController@update')->name('editar_vaga'); // Atualizar Vaga
        Route::delete('/{id}', 'VagaController@delete')->name('deletar_vaga'); // Deletar vaga
    });

    // Rotas Departamentos
    Route::prefix('departamentos')->group(function() {
        Route::get('/', 'DepartamentoController@getDepartamentos')->name('departamentos'); // Retornar todos os departamentos
        Route::get('/{eh}', 'DepartamentoController@getDepartamentoById')->name('departamento_por_eh'); // Retornar o departamento por eh
        Route::post('/', 'DepartamentoController@setDepartamento')->name('cadastrar_departamento'); // Cadastrar um departamento
        Route::patch('/{eh}', 'DepartamentoController@update')->name('editar_departamento'); // Atualizar um departamento
        Route::delete('/{eh}', 'DepartamentoController@delete')->name('deletar_departamento'); // Deletar um departamento
    });
    
    // Rotas Cartão de Acesso
    Route::prefix('cartao')->group(function() {
        Route::get('/', 'CartaoController@getCartao')->name('cartao'); // Retornar todos os cartoes
        Route::post('/', 'CartaoController@setCartao')->name('cadastrar_cartao'); // Cadastra cartao
        Route::patch('/{id}', 'CartaoController@update')->name('editar_cartao'); // Atualizar cartao
        Route::delete('/{id}', 'CartaoController@delete')->name('deletar_cartao'); // Deletar cartao
    });

    // Rota Estados
    Route::prefix('estados')->group(function() {
        Route::get('/', 'EstadoController@getEstado')->name('estados'); // Retornar todos os estados
    });

    // Rotas Instituições de Ensino
    Route::prefix('instituicao')->group(function() {
        Route::get('/', 'InstituicaoController@getInstituicao')->name('instituicao'); // Retornar todas as instituíções
        Route::post('/', 'InstituicaoController@setInstituicao')->name('cadastrar_instituicao'); // Cadastra instituíção
    });

    // Rotas Cursos
    Route::prefix('cursos')->group(function() {
        Route::get('/', 'CursoController@getCurso')->name('cursos'); // Retornar todos os cursos
        Route::get('/{id}', 'CursoController@getCursoById')->name('curso_por_id'); // Retornar curso por id
        Route::post('/', 'CursoController@setCurso')->name('cadastrar_curso'); // Cadastra Curso
        Route::delete('/{id}', 'CursoController@delete')->name('deletar_curso'); // Deleta Curso
        Route::patch('/{id}', 'CursoController@update')->name('editar_curso'); // Atualiza Curso
    });
});