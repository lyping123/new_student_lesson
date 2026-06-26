<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .public-holiday table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .public-holiday th, .public-holiday td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .public-holiday th {
            background-color: #f2f2f2;
            text-align: left;
        }
        </style>
    <h1>Public Holidays</h1>
    <div class="public-holiday">

    </div>

    <script>
        fetch('https://publicholidays.com.my/penang/')
            .then(response => response.text())
            .then(data => {
               
                // Process the HTML content as needed
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');
                const holidays = doc.querySelectorAll('.publicholidays');
                holidays.forEach(holiday => {
                    const TableElement =document.createElement('table');
                    TableElement.innerHTML = holiday.innerHTML;
                    document.querySelector('.public-holiday').appendChild(TableElement);
                });
            })
            .catch(error => console.error('Error fetching public holidays:', error));
        </script>
    
</body>
</html>