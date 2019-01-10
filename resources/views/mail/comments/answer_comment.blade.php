<html>
    <body>
        <p>Olá, {{$comment->name}}.</p>
        <br>
        <p>Seu comentário foi respondido. </p>
        <br>
        <p><b>Dados do comentário:</b> {{$comment->description}}</p><br>
        <p><b>Dados da resposta:</b> {{$reply->description}}</p>
        <br><br>
        <p>Att,</p>
        <p>Equipe Spark Cursos</p>
    </body>
</html>