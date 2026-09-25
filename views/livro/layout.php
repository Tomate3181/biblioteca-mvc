<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Escolar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f3f7;
            color: #2d2d2d;
            min-height: 100vh;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background-color: #6b4c9a;
            color: white;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        header h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        nav {
            margin-top: 15px;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-size: 0.95rem;
        }
        
        nav a:hover {
            text-decoration: underline;
        }
        
        .card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.95rem;
            text-decoration: none;
            transition: background 0.2s;
        }
        
        .btn-primary {
            background-color: #6b4c9a;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #5a3d82;
        }
        
        .btn-secondary {
            background-color: #9b8ab8;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #8a79a5;
        }
        
        .btn-danger {
            background-color: #c53030;
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #9b2c2c;
        }
        
        .btn-small {
            padding: 6px 12px;
            font-size: 0.85rem;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e8e4ef;
        }
        
        th {
            background-color: #f8f6fa;
            color: #6b4c9a;
            font-weight: 600;
        }
        
        tr:hover {
            background-color: #faf9fc;
        }
        
        .indisponivel {
            color: #c53030;
            font-weight: 600;
        }
        
        .disponivel {
            color: #2d8a4e;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #4a4a4a;
        }
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #6b4c9a;
        }
        
        .form-group .error {
            color: #c53030;
            font-size: 0.85rem;
            margin-top: 4px;
        }
        
        .form-group input.error-input {
            border-color: #c53030;
        }
        
        .search-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .search-form input {
            flex: 1;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
        }
        
        .search-form input:focus {
            outline: none;
            border-color: #6b4c9a;
        }
        
        .actions {
            display: flex;
            gap: 8px;
        }
        
        .empty {
            text-align: center;
            color: #666;
            padding: 40px;
        }
        
        .confirm-box {
            text-align: center;
        }
        
        .confirm-box p {
            margin-bottom: 20px;
            font-size: 1.1rem;
        }
        
        .confirm-box .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .breadcrumb {
            margin-bottom: 20px;
            color: #666;
        }
        
        .breadcrumb a {
            color: #6b4c9a;
            text-decoration: none;
        }
        
        .breadcrumb a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Biblioteca Escolar</h1>
            <nav>
                <a href="index.php">Livros</a>
                <a href="index.php?acao=criar">Novo Livro</a>
            </nav>
        </div>
    </header>
    <main class="container">