var username = localStorage.getItem('username');
document.getElementById("c_username").innerText = username;


function KnockoutJS(){
    function Book(book_name, book_quantity, book_price){
        const book = this;
        this.book_name = ko.observable(book_name);
        this.book_quantity = ko.observable(book_quantity);
        this.book_price = ko.observable(book_price);
        this.subTotal = ko.computed(function(){
            return (parseInt(book.book_quantity()) * parseInt(book.book_price()));
        })
    }

    const self = this;

    this.books = ko.observableArray([]);

    this.total = ko.computed(function(){
        let sum=0;
        self.books().forEach(function(book){
            sum += book.subTotal();
        })
        return sum;
    });

    this.quantities = ko.computed(function(){
        return self.books().map(function(book){
            return book.book_quantity();
        });
    });

    this.save = function(){
        const quantitiesArray = self.quantities();
        var username = localStorage.getItem('username');
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "save_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function(){
            if(xhr.status === 200){
                var response = JSON.parse(xhr.responseText);
                if(response.status === "success"){
                    console.log("Data Saved!");
                }
                else{
                    alert("Error : " + response.message);
                }
            }
            else{
                console.log("Error : Request failed with status");
            }
        }
        xhr.send(`username=${encodeURIComponent(username)}&q1=${quantitiesArray[0]}&q2=${quantitiesArray[1]}&q3=${quantitiesArray[2]}`);
    };

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_book_data.php", true);
    xhr.onload = function(){
        if(xhr.status === 200){
            response = JSON.parse(xhr.responseText);
            console.log(response);
            let book1_name = response[0].Book_Name;
            let book2_name = response[1].Book_Name;
            let book3_name = response[2].Book_Name;
            let book1_price = response[0].Book_Price;
            let book2_price = response[1].Book_Price;
            let book3_price = response[2].Book_Price;
            let book1_quantity = localStorage.getItem('quantity1');
            let book2_quantity = localStorage.getItem('quantity2');
            let book3_quantity = localStorage.getItem('quantity3');
            self.books.push(new Book(book1_name, book1_quantity, book1_price));
            self.books.push(new Book(book2_name, book2_quantity, book2_price));
            self.books.push(new Book(book3_name, book3_quantity, book3_price));
        }
    }
    xhr.send();
}

ko.applyBindings(new KnockoutJS());

