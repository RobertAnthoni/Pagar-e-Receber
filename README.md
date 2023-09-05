
# Dotum - Contas a pagar e receber

Base de Sistema desenvolvido para vaga de desenvolvedor Back-end Dotum.


## Requerido

- Composer - https://getcomposer.org/download/
- PHP 8.1 - https://www.apachefriends.org/download.html ou Docker
- NPM - https://nodejs.org/en ou Docker


## Deploy
 
 Após subir ambiente PHP 8.1 e Node e ajustar .env.example, rodar seguintes comandos:
  
    1 - Composer install
    2 - npm install
    3 - php artisan migrate --seed
    4 - php artisan key:generate
    5 - php artisan serve
    6 - npm run dev

Após isso acessar http://localhost:8000.

Utilizar Login:

 - Email: admin@dotum.com
 - Senha: admin@dotum

Ou realizar novo cadastro de usuário.

## Funcionalidades

 - Autenticação
 - Lançamento de a pagar
 - Lançamento de a receber
 - Saldo de caixa
 - Validação de saldo.
 - Dashboard de acompanhamento.
 
 ## 1 - Autenticação

 - Valida usuário autenticado.
 - Valida se lançamento é de propriedade de usuário autenticado.
 - Ao cadastrar-se, sistema gera caixa para usuário.


 ## 2 - Dashboard

 - Contabiliza saldo caixa.
 - Contabiliza total a pagar/receber de todo periodo.
 - Contabiliza Balanço = (($aReceber + $Saldo) - $aPagar)
 - Lista Lançamentos a pagar vencidos e lançamento que vencerão no mês corrente.
 - Grafico de lançamento de a Pagar e Receber Mês corrente.

 ## 3 - Contas a Pagar
 
 - Lista Lançamento a Pagar - (Descrição, Valor, Status e Data de vencimento)
 - Permite adicionar novo registro na tabela contas a pagar.
 - Permite adicionar lançamentos com parcela Unica, Semanal, Quinzenal e Mensal.
 - Caso lançamento seja <> de Unico, Sistema gera quantidade de parcelas escolhidas pelo usuário e divide o valor pelas mesmas.
 - Gera previsão de caixa de a pagar
 - Titulo pode ser lançado como pago, assim, sistema faz validação de saldo do caixa e debita do mesmo.

  ## 3.1 - Editar a Pagar

  - Visualiza lançamento.
  - Possibilita Exclusão do lançamento completo.
  - Possibilita conciliação do lançamento.
  - Ao conciliar, o sistema valida se existe saldo suficiente em caixa para debitar do mesmo. Caso não haja, retorna erro.
  - Caso exista Saldo em caixa, debita e concilia previsão de caixa e torna lançamento como Pago.


 ## 4 - Contas a Receber
 
 - Lista Lançamento a Receber - (Descrição, Valor, Status e Data de vencimento)
 - Permite adicionar novo registro na tabela contas a receber.
 - Permite adicionar lançamentos com parcela Unica, Semanal, Quinzenal e Mensal.
 - Caso lançamento seja <> de Unico, Sistema gera quantidade de parcelas escolhidas pelo usuário e divide o valor pelas mesmas.
 - Gera previsão de caixa de a receber
 - Titulo pode ser lançado como recebido, assim sistema adiciona saldo em caixa.

  ## 4.1 - Editar a Receber

  - Visualiza lançamento.
  - Possibilita Exclusão do lançamento completo.
  - Possibilita conciliação do lançamento.
  - Ao conciliar, o sistema adiciona saldo em caixa.


## Ferramentas Utilizadas

- Laravel
- Livewire
- Chart.js
