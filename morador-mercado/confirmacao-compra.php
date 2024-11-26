<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Realizada</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Ocupa 100% da altura da janela */
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1c1c1c, #333); /* Fundo com gradiente */
            color: #f9f9f9; /* Cor do texto */
            text-align: center; /* Centraliza o texto */
        }

        .container {
            padding: 20px;
            border: 2px solid #f9f9f9; /* Borda estilosa */
            border-radius: 10px; /* Cantos arredondados */
            background-color: rgba(255, 255, 255, 0.1); /* Fundo semitransparente */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5); /* Sombra para o contêiner */
            width: 80%;
            max-width: 500px;
        }

        h1 {
            margin-bottom: 20px; /* Espaçamento abaixo do texto */
        }

        .botao-container {
            margin-top: 30px; /* Espaçamento entre o texto e o botão */
        }

        a.botao {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            background-color: #4CAF50; /* Cor do botão */
            color: white;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Sombra do botão */
            transition: all 0.3s ease-in-out;
        }

        a.botao:hover {
            background-color: #45a049; /* Efeito hover no botão */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4); /* Sombra mais intensa */
            transform: scale(1.05); /* Leve aumento ao passar o mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Compra realizada com sucesso!!</h1>
        <div class="botao-container">
            <a href="./mercado.php" class="botao">Voltar para o mercado</a>
        </div>
    </div>
</body>
</html>
