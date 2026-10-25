# Login Social com Laravel Socialite

Projeto em Laravel que permite ao usuário autenticar-se usando redes sociais através do pacote **Laravel Socialite**, eliminando a necessidade de criar uma senha tradicional no sistema.

## Resumo das Funcionalidades
* **Login com Facebook:** Autenticação nativa via `OAuth 2.0`.
* **Login com GitHub:** Integração via pacote `Socialite Providers`.
* **Login com Google:** Integração via pacote `Socialite Providers`.
* **Cadastro/Login Automático:** Cria o registro do usuário no primeiro acesso usando o nome e e-mail retornados pela rede social.
* **Fluxo Direto:** Redirecionamento automático para a *Dashboard* após o sucesso na autenticação.
* **Gerenciamento de Sessão:** Sistema completo de cadastro tradicional, login e logout.

## Fluxo de Autenticação
1. O usuário clica no botão "Entrar com [Rede Social]".
2. O Laravel redireciona para a tela de autorização oficial do provedor.
3. Após autorizar, o provedor devolve os dados do usuário para a rota de `callback`.
4. O sistema busca o usuário pelo e-mail: se não existir, cria um novo registro; se existir, apenas atualiza.
5. O usuário é autenticado na sessão e enviado direto para a *Dashboard*.

## Tecnologias e Requisitos
* **Framework:** Laravel
* **Autenticação:** Laravel Socialite & Socialite Providers
* **Front-end:** Bootstrap 5
* **Banco de Dados:** MySQL
