## 🚀 Desafio Técnico: GitHub Developer Finder

Este projeto tem como objetivo construir uma interface web segura, desenvolvida em **Laravel 12** com **PostgreSQL** no Docker, para que o CTO avalie e filtre desenvolvedores de código aberto, utilizando a API do GitHub.

### 🎯 Visão Geral do Projeto

A aplicação oferece um sistema de login para acesso restrito. Após o login, o CTO tem acesso a uma lista de desenvolvedores, onde cada um é avaliado por um **Score de Avaliação** (métrica definida abaixo) e pode ser filtrado por parâmetros chave.

---

### 📏 Métricas e Filtros de Avaliação

A avaliação de um desenvolvedor é feita através de um Score numérico, e a listagem pode ser refinada com filtros.

#### **Métrica de Avaliação (Score)**

O Score é calculado usando a seguinte fórmula, priorizando engajamento e produção de código:

$$S = (\text{Followers} \times 0.4) + (\text{Public Repos} \times 0.3) + (\text{Total Stars} \times 0.3)$$

Onde:
* **Followers:** Contribui para o alcance e popularidade do desenvolvedor.
* **Public Repos:** Contribui para a produtividade e volume de trabalho.
* **Total Stars:** Contribui para a qualidade e reconhecimento dos projetos.

#### **Filtros Disponíveis**

* **Linguagem Principal:** Filtra desenvolvedores com maior atividade em uma linguagem específica (ex: PHP, JavaScript).
* **Localização:** Filtra por região ou país de residência.
* **Score Mínimo:** Exibe apenas desenvolvedores que atinjam um limite de pontuação pré-definido.

---

### 🏗️ Estrutura da Arquitetura

O projeto utiliza o padrão **Repository/Service/Controller** para garantir a separação de responsabilidades, testabilidade e manutenibilidade do código.

| Camada | Responsabilidade |
| :--- | :--- |
| **Controller** (`App\Http\Controllers`) | Recebe requisições HTTP, valida dados, e chama a camada de `Service`. Retorna a resposta (JSON ou View). |
| **Service** (`App\Services`) | Contém a lógica de negócio **principal**, incluindo o cálculo do Score e a orquestração de dados. |
| **Repository** (`App\Repositories`) | Lida com a persistência e a recuperação de dados de **fontes externas**, como a **API do GitHub** ou o cache. |

---

### ⚙️ Instalação e Execução (Docker)

O projeto é configurado para rodar em um ambiente Docker, incluindo os serviços de **PHP/Laravel**, **Nginx** e **PostgreSQL**.

#### **Pré-requisitos**
* **Docker**
* **Docker Compose**

#### **Passo 1: Clonar o Repositório**

```bash
git clone https://github.com/angelresende/github-dev-finder.git
cd github-dev-finder

2.  **Configurar o Arquivo `.env`:**
    Duplique o arquivo `.env.example` para `.env` e configure as variáveis de ambiente. As configurações de banco de dados no `docker-compose.yml` são:
    ```env
    DB_CONNECTION=pgsql
    DB_HOST=pgsql
    DB_PORT=5432
    DB_DATABASE=beer_and_code_challenge
    DB_USERNAME=beerAndCode
    DB_PASSWORD=beerAndCode
    ```

3.  **Configuração da API do GitHub:**
    Obtenha um Personal Access Token no GitHub (para evitar limites de taxa) e adicione-o:
    GITHUB_TOKEN=SEU_TOKEN_AQUI

4. **Construir e Iniciar os Contêineres:**
    ```bash
    docker-compose up -d --build
    docker-compose exec app composer install

5. **Configuração Final do Laravel:**
    ```bash
    docker-compose exec app php artisan key:generate
    docker-compose exec app php artisan migrate --seed # Cria o esquema de usuários

6.  **A aplicação estará disponível em:** `http://localhost:8080`.


**✍️ Autoria**

Desenvolvido por: Angélica Resende
