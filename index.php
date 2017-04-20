<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            section {
                border: 1px solid darkgray;
                background-color: lightgray;
                margin-bottom: 5px;
                padding: 10px;
            }
            
            div {
                background-color: slategray;
            }
        </style>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
            axios.get('api/books.php').then(function (response) {
            for (var i = 0; i < response.data.length; i++) {     
                var section = document.createElement("section");
                document.body.appendChild(section);
                
                var titleEl = document.createElement("h3");
                var title = document.createTextNode(response.data[i].title);
                titleEl.appendChild(title);                
                section.appendChild(titleEl);
                
                var div = document.createElement("div");
                section.appendChild(div);
              }
            })
            .catch(function (error) {
              console.log(error);
            });         
        </script>    
    </head>
    <body>
        
    </body>
</html>
