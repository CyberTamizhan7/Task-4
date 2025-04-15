var username = localStorage.getItem('username');
document.getElementById("m_username").textContent = username;

function Book(name, quantity, price, img){
	const book = this;
	this.book_name = ko.observable(name);
	this.book_price = ko.observable(price);
	this.book_quantity = ko.observable(quantity);
	this.book_img = ko.observable(img);
	this.subTotal = ko.computed(function(){
		return (parseInt(book.book_quantity()) * parseInt(book.book_price()));
	})
}

function KnockoutJS(){

	const self = this;
	this.books = ko.observableArray([]);
	this.total = ko.computed(function(){
		let sum=0;
		self.books().forEach(function(book){
			sum += book.subTotal();
		})
		return sum;
	})

	this.increaseQuantity = function(book){
		if(book.book_quantity() < 10){
			book.book_quantity(book.book_quantity() + 1);
		}
	}

	this.decreaseQuantity = function(book){
		if(book.book_quantity() > 0){
			book.book_quantity(book.book_quantity() - 1);
		}
	}

	this.quantities = ko.computed(function(){
        return self.books().map(function(book){
            return book.book_quantity();
        });
    });

	this.addToCart = function(book){
		localStorage.setItem('quantity1', book.quantities()[0]);
		localStorage.setItem('quantity2', book.quantities()[1]);
		localStorage.setItem('quantity3', book.quantities()[2]);
		window.location.href = "carts.html";
	}


	var quantity1;
	var quantity2;
	var quantity3;
	var cartXHR = new XMLHttpRequest();
	cartXHR.open("GET", "fetch_carts_data.php?username=" + encodeURIComponent(username), true);
	cartXHR.onload = function(){
		if(cartXHR.status === 200){
			response1 = JSON.parse(cartXHR.responseText);
			quantity1 = response1[0];
			quantity2 = response1[1];
			quantity3 = response1[2];
		}
	}
	cartXHR.send()

	var xhr = new XMLHttpRequest();
	xhr.open("GET", "fetch_book_data.php", true);
	xhr.onload = function(){
		if(xhr.status === 200){
			response = JSON.parse(xhr.responseText);
			console.log(response);
			self.books.push(new Book(response[0].Book_Name, quantity1, response[0].Book_Price));
			self.books.push(new Book(response[1].Book_Name, quantity2, response[1].Book_Price));
			self.books.push(new Book(response[2].Book_Name, quantity3, response[2].Book_Price));
		}
		else{
			console.error("Error : " + xhr.status);
		}
	}
	xhr.send();
}

ko.applyBindings(new KnockoutJS());

