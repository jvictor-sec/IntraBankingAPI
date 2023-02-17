<h1 align="center"> IntraBankingAPI </h1>

<p align="center">
  <a href="#-tecnologias">Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-projeto">Projeto</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#gear-funcionamento">Funcionamento</a>
</p>

<p align="center">
  <img alt="License" src="https://img.shields.io/static/v1?label=license&message=MIT&color=49AA26&labelColor=000000">
</p>

<br>


## 🚀 Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- Apache
- Mysql
- PHP
- Composer

## 💻 Projeto

Aplicativo de gestão financeira que permite o controle das despesas e o histórico de gastos 

## :gear: Funcionamento

Para que a API funcione corretamente é necessário instalar localmente as tecnologias desse projeto. Tendo tudo instalado, basta seguir os seguintes passos:

- Inicializar o Apache  
- Subir o banco de dados no serviço do Mysql
- Alterar se necessário as credenciais de usuário e senha do arquivo Config/config.php
- Rodar o comando "composer update" na raiz do projeto

Após isso, a API estará pronta para ser utilizada. A última configuração a ser feita é quanto a URL que pode variar de acordo com a forma com que o Apache foi configurado. A URL deve seguir o seguinte padrão: http://{localhost}/{nome-projeto}/public_html/index.php/api/{nome-controlador}.

---
