Tutorial - Framework
====================

Este framework tenta criar uma estrutura simples para a criação de sites que utilizem o conceito de classes. Ele ainda tá no começo e precisa ser criado diversas funções para realmente facilitar o uso. Porém, ele já é funcional, exibindo as páginas e tendo uma estrutura mais organizada e simples.

Ele tenta separar o máximo possível a parte de visualização do site da parte de código, isto é, em um arquivo ficam as funções de acesso ao banco de dados e controle da classe e em outro, a parte visual da função. Não ficando misturado diversos códigos e repetindo funções.

A princípio, a estrutura parece ser confusa, mas depois que se aprende ela, se percebe que ela é bem simples e organizada.


Diretórios e Arquivos
---------------------
* app/classes
    Ficam as classes utilizadas no projeto. Cada arquivo possui o nome da classe. A princípio, tem duas classes básicas, a Database (com funções para acesso ao banco de dados) e a Model (que contém um modelo básico de classe, e que é extendida por todas as outras classes).

* app/lib
    Ficam as bibliotecas PHP utilizadas no projeto e que não se encaixam em nenhuma classe. Basicamente coleções de funções úteis.

* app/views
    Neste diretório ficam os arquivos de visualização do site. E que serão utilizados para linkar no routes.php. O routes.php é responsável por traduzir o endereço digitado na barra de endereços para um arquivo dentro da views. Podemos criar no routes.php um 'link', para quando alguém entrar no link 'www.futebolmanager.com/profile/add/' ele executa o arquivo 'app/views/user/profile_add.php'. Por convenção, se adiciona os arquivos relacionados a uma classe num diretório com o mesmo nome.

* app/config.php
    Arquivo responsável pelas configurações gerais do site. Setando valores que serão utilizados em diversos pontos.

* app/routes.php
    Arquivo responsável pela tradução do endereço digitado e o arquivo executado.

* media/css
    Onde ficam armazenados os arquivos CSS do site. Arquivos CSS são as folhas de estilo, onde é possível definir o design do site.

* media/img
    Local para pôr as imagens utilizadas no site.

* media/js
    Diretório para colocar os arquivos javascript utilizadas no site. Para o projeto, será utilizado a biblioteca javascript JQuery (www.jquery.com), pois ela é bem simples de utilizar e tem diversas funções e bibliotecas muito úteis.


Modo de Usar
------------

A idéia é encapsular as ações em classes. A princípio não consigo ver no projeto mais classes além de 'User' e 'Team'. 
