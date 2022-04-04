## Sobre o projeto

O projeto consiste em um gestor de clientes, que os organiza em grupos.

O projeto possui dois tipos de gerentes:
    * Operacional (pode apenas visualizar grupos, adicionar/remover clientes);
    * Admininistrador (todas do Operacional e podem criar, editar e excluir grupos);

OBS: os dados de acesso dos dois perfis de usuários se encontram no seeder UsersTableSeeder;

## Sobre o projeto

Pacotes utilizados:

* Laravel Sail (que já vem por padrão no Laravel, facilita o uso do docker);
* Laravel Passport (para autenticação via api);
* Ramsey UUID (para uso de UUID4 na primary key das Models);
* Spatie Permissions (para filtrar as permissões dos tipos de Gerente);
* ElegantWeb Sanitizer (para filtragem do formato de CNPJ, e outros possíveis dados que venham a ser incorporados no futuro);


## Sobre o ambiente

O projeto foi desenvolvido com Docker, utilizando o Laravel Sail.

Todas as váriáveis e dados necessários para .env estão no .env.example.

Para levantar o projeto basta na pasta root, digitar:

$ sudo docker-compose up

Depois só acessar o container e rodar:

$ php artisan migrate:fresh --seed


## Sobre os testes

No mesmo container, você poderá rodar os testes:

php artisan test

Os testes focam no processo de login como Gerente-Administrador, no processo de criação, edição, listagem e remoção das entidades de Cliente e Grupo.


## Sobre os endpoints

Para realizar o login e obter o token necessário para acessar os outros endpoints:

http://localhost:80/api/auth/login

email {string}
senha {string}


# Para criar um grupo:

POST http://localhost:80/api/group/store

group_name {string}


# Para editar um grupo:

PUT http://localhost:80/api/group/update/{group_id|uuid}

group_name {string}


# Para remover um grupo:

DELETE http://localhost:80/api/group/delete/{group_id|uuid}


# Para listar os grupos:

GET http://localhost:80/api/group

OBS: para filtrar a listagem pelo nome ou parte do nome do grupo

DELETE http://localhost:80/api/group?name=NOME_DO_GRUPO_OU_PARTE_DO_NOME_DO_GRUPO


# Para visualizar um grupo específico:

GET http://localhost:80/api/group/{group_id|uuid}



# Para criar um cliente:

POST http://localhost:80/api/client/store

client_name {string}
client_document {string}
foundation_date {string}
group_id {group_id|uuid}


# Para editar um cliente:

PUT http://localhost:80/api/client/update/{client_id|uuid}

client_name {string}
client_document {string}
foundation_date {string}
group_id {group_id|uuid}


# Para remover um cliente:

DELETE http://localhost:80/api/client/delete/{client_id|uuid}


# Para listar os cliente:

GET http://localhost:80/api/client

OBS: para filtrar a listagem pelo nome ou parte do nome do cliente

DELETE http://localhost:80/api/client?name=NOME_DO_CLIENTE_OU_PARTE_DO_NOME_DO_CLIENTE


# Para visualizar um cliente específico:

GET http://localhost:80/api/client/{client_id|uuid}
