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
                padding: 5px;
            }
            
            .hidden {
                display: none;                
            }
            
        </style>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
            function showTitle(parent, book) {
                var titleEl = document.createElement("h3");
                var title = document.createTextNode(book.title);
                titleEl.appendChild(title);
                titleEl.dataset.id = book.id;
                parent.appendChild(titleEl);
                
                var div = document.createElement("div");
                div.classList.add("hidden");
                parent.appendChild(div);
            }
            
            function showDetails() {               
                var url = "api/books.php?id=" + this.dataset.id;
                var divEl = this.nextElementSibling;
                                
                if(divEl.className.indexOf("hidden") !== -1) {
                    axios.get(url).then(function (response) {                        
                        var author = document.createTextNode(response.data.author);
                        divEl.appendChild(author);
                        divEl.classList.remove("hidden");
                    })
                    .catch(function (error) {
                         console.log(error);
                    });
                } else {
                    divEl.innerText = "";
                    divEl.classList.add("hidden");                    
                }                
            }
            
            
            function fetchAndPrintData() {
                axios.get('api/books.php').then(function (response) {
                for (var i = 0; i < response.data.length; i++) {     
                    var section = document.createElement("section");
                    document.body.appendChild(section);

                    showTitle(section, response.data[i]);               
                }
                
                var titles = document.getElementsByTagName("h3");
                for(var i = 0; i < titles.length; i++) {
                    titles[i].addEventListener('click', showDetails);
                }

                })
                .catch(function (error) {
                  console.log(error);
                });         
            }  
            
            fetchAndPrintData();
        </script>    
    </head>
    <body>
        
    </body>
</html>
