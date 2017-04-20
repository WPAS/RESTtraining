document.addEventListener("DOMContentLoaded", function(){
    
    function showTitle(parent, book) {
        var titleEl = document.createElement("h3");
        var title = document.createTextNode(book.title);
        titleEl.appendChild(title);
        titleEl.dataset.id = book.id;
        parent.appendChild(titleEl);
     
        var div = document.createElement("div");
        div.classList.add("hidden");
        parent.appendChild(div);
        
        var deleter = document.createElement("a");
        var text = document.createTextNode("Usuń książkę");
        deleter.appendChild(text);
        deleter.setAttribute("href", "api/books.php?id="+book.id);
        parent.appendChild(deleter);

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
    
    function deleteBook(e) {
        e.preventDefault();
        
        alert("Are you sure, that you want to delete that book. We will not be able to restore this data")
        var url = this.getAttribute("href");
        
        axios.delete(url)
        .then(function (response) {
            alert("Book was deleted");
            location.reload()           
        })
        .catch(function (error) {
            console.log(error);
        });
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
        
        var deleters = document.querySelectorAll("section a");
        for(var i = 0; i < deleters.length; i++) {
            deleters[i].addEventListener('click', deleteBook);
        }


        })
        .catch(function (error) {
          console.log(error);
        });         
    } 
    
    function saveBook(e) {
        e.preventDefault();
        
        var title = document.querySelector('input[name="title"]').value;
        var author = document.querySelector('input[name="author"]').value;
        
        axios.post('api/books.php', {
            title: title,
            author: author
        })
        .then(function (response) {
            alert("Book was saved");
            location.reload()           
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    fetchAndPrintData();
    
    var addBook = document.getElementById("addBook");
    addBook.addEventListener("submit", saveBook);
    
});




