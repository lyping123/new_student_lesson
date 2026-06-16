
<input type="text" id="username" oninput="sendData()" placeholder="Enter your name">

<div id="result"></div>

<script>
    function sendData() {
        // 1. Get the data from the input
        let nameValue = document.getElementById('username').value;

        // 2. Package the data
        let formData = new FormData();
        formData.append('userName', nameValue);

        // 3. Send via AJAX (fetch)
        fetch('process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // We expect PHP to reply in JSON
        .then(data => {
           let students=data.s_name;
           document.getElementById('result').innerHTML = ''; // Clear previous results
           students.forEach(student => {
           document.getElementById('result').innerHTML += `${student}<br>`;
        });

           
        })
        .catch(error => console.error('Error:', error));
    }
</script>
