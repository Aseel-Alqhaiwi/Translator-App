<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q Translator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #343a40;
            color: white;
            padding: 10px 20px;
        }
        header .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        header img {
            height: 40px;
        }
        header .navbar-nav {
            margin-left: auto;
        }
        header .nav-link {
            color: white;
            transition: color 0.3s;
        }
        header .nav-link:hover {
            color: #d9d9d9;
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 15px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        textarea {
            width: 100%;
            resize: none;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="/logo.png" alt="Q Translator Logo">
                    <span>Q Translator</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Translate Text Easily</h2>
        <form id="translate-form" class="mb-4">
            <div class="mb-3">
                <textarea id="text" placeholder="Enter text to translate" rows="4" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <select id="language" class="form-select">
                    <option value="en">Translate to English</option>
                    <option value="ar">Translate to Arabic</option>
                </select>
            </div>
            <div class="text-center">
                <button type="button" onclick="translateText()" class="btn btn-primary">Translate</button>
            </div>
        </form>

        <div id="result" class="alert alert-secondary text-center" style="display: none;"></div>
    </div>

    <!-- Footer Section -->
    <footer>
        &copy; 2024 Q Translator. All Rights Reserved.
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function translateText() {
            const text = document.getElementById('text').value;
            const language = document.getElementById('language').value;
            const resultDiv = document.getElementById('result');

            resultDiv.style.display = 'none';
            resultDiv.textContent = '';

            axios.post('/translate', {
                text: text,
                target_language: language,
            })
            .then(response => {
                if (response.data.success) {
                    resultDiv.textContent = response.data.translated_text;
                    resultDiv.style.display = 'block';
                } else {
                    resultDiv.textContent = 'Error: ' + response.data.message;
                    resultDiv.style.display = 'block';
                    resultDiv.classList.replace('alert-secondary', 'alert-danger');
                }
            })
            .catch(error => {
                resultDiv.textContent = 'Error: ' + error.message;
                resultDiv.style.display = 'block';
                resultDiv.classList.replace('alert-secondary', 'alert-danger');
            });
        }
    </script>
</body>
</html>
