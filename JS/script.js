
function registerUser(event) {

    var password = document.getElementById('registrationPassword').value;
    var confirmPassword = document.getElementById('registrationConfirmPassword').value;

    if (password === confirmPassword) {
        submitForm(event);
    } else {
        alert('Passwords do not match. Please try again.');
    }
}

function showRegistrationModal() {
    document.getElementById('registrationModal').style.display = 'block';
}

function closeRegistrationModal() {
    document.getElementById('registrationModal').style.display = 'none';
}

function submitForm(event) {

    event.preventDefault();
    var formData = new FormData(document.getElementById('registrationForm'));
    $.ajax({
        type: 'POST',
        url: 'PHP/savedata.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);

            //Checks if data is already an object
            if (typeof data !== 'object') {
                try {
                    data = JSON.parse(data);
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    return;
                }
            }

            //Shows alert box
            if (data.status === 'success') {
                alert(data.message);
                closeRegistrationModal();
            } else {
                alert(data.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', status, error);
        }
    });
}

function checkUserRegistration(userType) {
    return true;
}

function redirectToUserType(userType) {
    switch (userType) {
        case 'seller':
            window.location.href = '../INTERFACES/HTML/Seller.html';
            break;
        case 'buyer':
            window.location.href = '../INTERFACES/HTML/Seller.html';
            break;
        default:
            alert('Invalid user type');
    }
}

function loginBuyer(event){
    
    event.preventDefault();
    var formData = new FormData(document.getElementById('loginForm'));
    $.ajax({
        type: 'POST',
        url: '../../PHP/login.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);

            //Checks if data is already an object
            if (typeof data !== 'object') {
                try {
                    data = JSON.parse(data);
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    return;
                }
            }

            //Shows alert box
            if (data.status === 'success') {
                window.location.href = '../../INTERFACES/HTML/landingpage.php';
            } else {
                alert(data.message);
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
            console.error('Error:', status, error);
        }
    });
}

function loginSeller(event){
    
    event.preventDefault();
    var formData = new FormData(document.getElementById('loginForm'));
    $.ajax({
        type: 'POST',
        url: '../../PHP/login.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);

            //Checks if data is already an object
            if (typeof data !== 'object') {
                try {
                    data = JSON.parse(data);
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    return;
                }
            }

            //Shows alert box
            if (data.status === 'success') {
                window.location.href = '../SELLERPANEL.php';
            } else if (data.status === 'ForVerification'){
                alert(data.message);
            }else{
                alert(data.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', status, error);
        }
    });
}

function loginAdmin(event){
    
    event.preventDefault();
    var formData = new FormData(document.getElementById('loginForm'));
    $.ajax({
        type: 'POST',
        url: '../../PHP/login.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);

            //Checks if data is already an object
            if (typeof data !== 'object') {
                try {
                    data = JSON.parse(data);
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    return;
                }
            }

            //Shows alert box
            if (data.status === 'success') {
                alert(data.message);
                window.location.href = 'adminpanel.php';
            } else {
                alert(data.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', status, error);
        }
    });
}

function addproduct(event){
    
    event.preventDefault();
    var formData = new FormData(document.getElementById('addproduct'));
    $.ajax({
        type: 'POST',
        url: '../PHP/AddProduct.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);

            //Checks if data is already an object
            if (typeof data !== 'object') {
                try {
                    data = JSON.parse(data);
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    return;
                }
            }

            //Shows alert box
            if (data.status === 'success') {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', status, error);
        }
    });
}

function changePassword(event) {

    event.preventDefault();
    var formData = new FormData(document.getElementById('changePasswordForm'));
    $.ajax({
        type: 'POST',
        url: '../../PHP/ForgotPass.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);

            //Checks if data is already an object
            if (typeof data !== 'object') {
                try {
                    data = JSON.parse(data);
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    return;
                }
            }

            //Shows alert box
            if (data.status === 'success') {
                alert(data.message);
                closeModal();
            } else {
                alert(data.message);
                closeModal();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', status, error);
        }
    });

}

document.addEventListener("DOMContentLoaded", function() {
    const sortingButtons = document.querySelectorAll(".sorting-btn");
    const productsContainer = document.getElementById('products-container');

    sortingButtons.forEach(button => {
        button.addEventListener("click", function() {
            const category = this.getAttribute("data-category");
            fetchProducts(category);
        });
    });

    function fetchProducts(category) {
        fetch(`get_products.php`)
            .then(response => response.json())
            .then(data => {
                const filteredProducts = data.filter(product => product.type === category);
                displayProducts(filteredProducts);
            })
            .catch(error => console.error('Error fetching products:', error));
    }

    function displayProducts(products) {
        // Clear previous products
        productsContainer.innerHTML = '';

        // Display products
        products.forEach(product => {
            const productElement = document.createElement('div');
            productElement.classList.add('product');
            productElement.innerHTML = `
                <img src="${product.image}" alt="${product.name}" />
                <h3>${product.name}</h3>
                <p>${product.description}</p>
                <span>Price: ${product.price}</span>
            `;
            productsContainer.appendChild(productElement);
        });
    }
});
