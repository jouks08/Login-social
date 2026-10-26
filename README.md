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
* Aplicativos criados nos painéis de desenvolvedor de cada rede social, com `CLIENT_ID`, `CLIENT_SECRET` e a URL de callback cadastrada:
  * [Meta for Developers](https://developers.facebook.com/) (Facebook)
  * [GitHub Developer Settings](https://github.com/settings/developers)
  * [Google Cloud Console](https://console.cloud.google.com/)

## Instalação

* composer require laravel/socialite
Na raiz do projeto.

## Configuração dos Provedores

Em cada painel de desenvolvedor, cadastre a **URL de callback** correspondente (ajuste o domínio e as rotas conforme o seu projeto):

| Provedor | URL de callback                                |
|----------|------------------------------------------------|
| Facebook | `http://localhost:8000/auth/facebook/callback` |
| GitHub   | `http://localhost:8000/auth/github/callback`   |
| Google   | `http://localhost:8000/auth/google/callback`   |

> **Facebook:** enquanto o aplicativo estiver em modo **Desenvolvimento**, apenas contas com função no app (Administrador, Desenvolvedor ou Testador) conseguem fazer login. Para liberar para qualquer usuário, é necessário colocar o app em modo **Ativo/Publicado** no painel da Meta.

## Variáveis de Ambiente

No arquivo `.env`, configure o banco de dados e as credenciais de cada provedor:

```env
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=login_social
DB_USERNAME=root
DB_PASSWORD=

FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
FACEBOOK_REDIRECT_URI=${APP_URL}/auth/facebook/callback

GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_REDIRECT_URI=${APP_URL}/auth/github/callback

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=${APP_URL}/auth/google/callback
```

E registre-as em `config/services.php`:

```php
'facebook' => [
    'client_id'     => env('FACEBOOK_CLIENT_ID'),
    'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
    'redirect'      => env('FACEBOOK_REDIRECT_URI'),
],

'github' => [
    'client_id'     => env('GITHUB_CLIENT_ID'),
    'client_secret' => env('GITHUB_CLIENT_SECRET'),
    'redirect'      => env('GITHUB_REDIRECT_URI'),
],

'google' => [
    'client_id'     => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect'      => env('GOOGLE_REDIRECT_URI'),
],
```

## Rotas Principais

| Método | Rota                        | Descrição                                  |
|--------|-----------------------------|--------------------------------------------|
| GET    | `/auth/{provedor}/redirect` | Redireciona para a autorização do provedor |
| GET    | `/auth/{provedor}/callback` | Recebe os dados do usuário e autentica     |
| GET    | `/dashboard`                | Página inicial após o login                |
| POST   | `/logout`                   | Encerra a sessão                           |
