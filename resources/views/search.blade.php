<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search Engine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content {
            flex: 1;
        }
        .search-container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }
        .search-container input {
            width: 100%;
            padding: 12px;
            border-radius: 25px;
            border: 1px solid #ddd;
        }
        .book-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            padding: 20px;
        }
        .book-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: 0.3s;
        }
        .book-card img {
            width: 100px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .book-card:hover {
            transform: scale(1.05);
        }
        .footer {
            text-align: center;
            color: #6c757d;
            padding: 20px 0;
            background-color: #ffffff;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="container search-container">
            <h1 class="mb-4">📚 Book Search Engine</h1>
            <input type="text" id="search" class="form-control" placeholder="Search books...">
            <div class="mt-3">
                <label for="top-books">Show top: </label>
                <select id="top-books" class="form-select w-50 mx-auto">
                    <option value="5">Top 5</option>
                    <option value="10">Top 10</option>
                    <option value="20">Top 20</option>
                </select>
            </div>
        </div>
        
        <div class="container mt-3">
            <h3 class="text-center"><strong>Top Recommended Books</strong></h3>
            <div id="results" class="book-grid"></div>
        </div>
    </div>
    
    <div class="footer">
        <p>Edited by: <strong>Aurellia Zhullvita Wandi</strong></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchBooks(query = '', limit = 5) {
                $.get('/search', { q: query }, function(data) {
                    let results = '';
                    let booksToShow = query ? data : data.slice(0, limit);
                    
                    booksToShow.forEach(book => {
                        results += `
                            <div class="book-card">
                                <img src="${book.image_url}" alt="Book Cover">
                                <h5 class="card-title">${book.title}</h5>
                                <p class="card-text">${book.price}</p>
                                <a href="${book.book_url}" target="_blank" class="btn btn-primary">View Book</a>
                            </div>
                        `;
                    });
                    $('#results').html(results);
                });
            }
            fetchBooks();

            $('#search').on('input', function() {
                let query = $(this).val();
                let limit = $('#top-books').val();
                fetchBooks(query, limit);
            });

            $('#top-books').on('change', function() {
                let limit = $(this).val();
                fetchBooks($('#search').val(), limit);
            });
        });
    </script>
</body>
</html>
