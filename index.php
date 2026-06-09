<?php

require __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$produtos = [
    [
        "id" => 1,
        "nome" => "Mouse",
        "preco" => 50
    ],
    [
        "id" => 2,
        "nome" => "Teclado",
        "preco" => 100
    ]
];

/* GET - Listar todos os produtos */
$app->get('/produtos', function (Request $request, Response $response) use (&$produtos) {

    $response->getBody()->write(json_encode($produtos));

    return $response->withHeader('Content-Type', 'application/json');
});

/* GET - Buscar produto por ID */
$app->get('/produtos/{id}', function (Request $request, Response $response, array $args) use (&$produtos) {

    foreach ($produtos as $produto) {
        if ($produto['id'] == $args['id']) {

            $response->getBody()->write(json_encode($produto));

            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    $response->getBody()->write(json_encode([
        "mensagem" => "Produto não encontrado"
    ]));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(404);
});

/* POST - Cadastrar produto */
$app->post('/produtos', function (Request $request, Response $response) use (&$produtos) {

    $dados = $request->getParsedBody();

    $novoProduto = [
        "id" => count($produtos) + 1,
        "nome" => $dados['nome'],
        "preco" => $dados['preco']
    ];

    $produtos[] = $novoProduto;

    $response->getBody()->write(json_encode([
        "mensagem" => "Produto cadastrado com sucesso",
        "produto" => $novoProduto
    ]));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(201);
});

/* PUT - Atualizar produto */
$app->put('/produtos/{id}', function (Request $request, Response $response, array $args) use (&$produtos) {

    $dados = $request->getParsedBody();

    foreach ($produtos as &$produto) {

        if ($produto['id'] == $args['id']) {

            $produto['nome'] = $dados['nome'];
            $produto['preco'] = $dados['preco'];

            $response->getBody()->write(json_encode([
                "mensagem" => "Produto atualizado com sucesso",
                "produto" => $produto
            ]));

            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    $response->getBody()->write(json_encode([
        "mensagem" => "Produto não encontrado"
    ]));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(404);
});

/* DELETE - Remover produto */
$app->delete('/produtos/{id}', function (Request $request, Response $response, array $args) use (&$produtos) {

    foreach ($produtos as $indice => $produto) {

        if ($produto['id'] == $args['id']) {

            unset($produtos[$indice]);

            $response->getBody()->write(json_encode([
                "mensagem" => "Produto removido com sucesso"
            ]));

            return $response->withHeader('Content-Type', 'application/json');
        }
    }

    $response->getBody()->write(json_encode([
        "mensagem" => "Produto não encontrado"
    ]));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(404);
});

$app->run();
