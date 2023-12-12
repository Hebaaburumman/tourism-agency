/// Burger Menu
const menuBtn = document.querySelector(".menu-btn");
const navigation = document.querySelector(".navigation");
menuBtn.addEventListener("click", () =>{
    menuBtn.classList.toggle("active");
    navigation.classList.toggle("active");

})

/// nav bar on scroll :
 window.addEventListener("scroll", function(){
    const header = document.querySelector('header');
    if(this.window.scrollY > 0 ){
        header.classList.add('scrolled')
    } else {
        header.classList.remove('scrolled')
    }
})



// save in session storage is login :
let loginButtonNav = document.getElementById('loginn');
let signupButtonNav = document.getElementById('sigupp');
const isloggedin = sessionStorage.getItem("isLoggedIn");

loginButtonNav.addEventListener('click', function () {
    window.location.href = '/login/login.html';
  })
if (isloggedin == 'true') {
  signupButtonNav.textContent = 'Profile';
  signupButtonNav.addEventListener('click', (e) => {
    window.location.href = '/userProfile/profile.html';
  
  });
  loginButtonNav.textContent = 'Log Out';
  loginButtonNav.addEventListener('click', (e) => {
    window.location.href = '/login/login.html';
    sessionStorage.clear();
  });
} else {
    signupButtonNav.addEventListener('click', (e) => {
        window.location.href = "/signup/signup.html";
    });

    loginButtonNav.addEventListener('click', (e) => {
        window.location.href = "/login/login.html";
    }); 
}

document.addEventListener('DOMContentLoaded', function () {
 
  var userId = sessionStorage.getItem('id');
  console.log(userId)

 
  if (userId) {
  
      function fetchUserData() {
          fetch(`http://localhost/tourism/t_api/userread.php?id=${userId}`, {
              method: 'GET',
              headers: {
                  'Content-Type': 'application/json'
              },
          })
              .then(response => {
                  if (!response.ok) {
                      throw new Error('Network response was not ok');
                  }
                  return response.json();
              })
              .then(data => {
                  console.log(data);
                  document.getElementById('user').innerText = data.username;
                  document.getElementById('username').innerText = data.username;
                  document.getElementById('email').innerText = data.email;
                  document.getElementById('password').innerText = data.password;
                  document.getElementById('phone_number').innerText = data.phone_number;
                  document.getElementById('role').innerText = data.role;

            
                  document.getElementById('usernameInput').value = data.username;
                  document.getElementById('emailInput').value = data.email;
                  document.getElementById('passwordInput').value = data.password;
                  document.getElementById('phone_numberInput').value = data.phone_number;
              })
              .catch(error => console.error('Error fetching user data:', error));
      }

      fetchUserData();

  } else {
      console.error('User id not found in sessionStorage');
  }
});

// Show the popup
var editProfileButton = document.getElementById('editprofile');
var popup = document.getElementById('popup');
var backdrop = document.getElementById('backdrop');

editProfileButton.addEventListener('click', function () {

  popup.style.display = 'block';
  backdrop.style.display = 'block';
});

backdrop.addEventListener('click', function () {

  popup.style.display = 'none';
  backdrop.style.display = 'none';
});

// Update user information using update button:
document.getElementById('userForm').addEventListener('submit', function (event) {
  event.preventDefault();

  let editedUserData = {
      username: document.getElementById('usernameInput').value,
      email: document.getElementById('emailInput').value,
      password: document.getElementById('passwordInput').value,
      phone_number: document.getElementById('phone_numberInput').value,
  };

  updateUserData(editedUserData);
});


function updateUserData(updatedUserData) {
 var userId = sessionStorage.getItem('id');
 console.log(userId)
  fetch(`http://localhost/tourism/t_api/userupdate.php?id=${userId}`, {
      method: 'PUT',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(updatedUserData)
  })
      .then(response => {
          if (!response.ok) {
              throw new Error('Network response was not ok');
          }
          return response.json();
      })
      .then(data => {
          alert('Profile updated successfully!');
    
          popup.style.display = 'none';
          backdrop.style.display = 'none';
          
      })
      .catch(error => console.error('Error updating user data:', error));
    }

// Booking table:

function bookTable (){
 var id = sessionStorage.getItem('id');
 fetch (`http://localhost/tourism/t_api/profileBook.php`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
     body: JSON.stringify({
      id: id,
    }),
  }) .then((response) => response.json())
  .then((data) => {
    var tbody = document.getElementById('book_table');
    for (let i = 0; i < data.length; i++) {
        const itemElement = document.createElement('tr');
        itemElement.innerHTML = `
        <td>${data[i]['name']}</td>
        <img src="/images/${data[i]['image']}">
		<td>${data[i]['date']}</td>
		<td>${data[i]['description']}</td>
		<td>${data[i]['price']}</td>
		<td>${data[i]['booking']}</td>

        <td>
		<button onclick="deleteTour(${data[i]['id']})">
		<i class="material-icons text-danger">&#xE872;</i></button>	
        </td>	
        
        `;
        tbody.appendChild(itemElement);
    }

})}
bookTable ();
    /// to make the password ***:
    // function maskPassword(password) {
    //     return '*'.repeat(password.length);
    // }
    // document.addEventListener('DOMContentLoaded', function () {
    //     // ... (your existing code)
    
    //     fetchUserData();
    
    //     function fetchUserData() {
    //         // ... (your existing code)
    
    //         // Populate the input fields in the form with the fetched data
    //         document.getElementById('usernameInput').value = data.username;
    //         document.getElementById('emailInput').value = data.email;
    
    //         // Display the password as asterisks
    //         document.getElementById('password').innerText = maskPassword(data.password);
    
    //         document.getElementById('phone_number').innerText = data.phone_number;
    //         document.getElementById('role').innerText = data.role;
    
    //         // ... (your existing code)
    //     }
    // });
    // document.getElementById('userForm').addEventListener('submit', function (event) {
    //     event.preventDefault();
    
    //     // Capture the edited user data from the form
    //     let editedUserData = {
    //         username: document.getElementById('usernameInput').value,
    //         email: document.getElementById('emailInput').value,
    //         password: document.getElementById('passwordInput').value, // Note: Use password input field directly
    //         phone_number: document.getElementById('phone_numberInput').value,
    //     };
    
    //     // Update user data
    //     updateUserData(editedUserData);
    // });
    
    // // ... (your existing code)
    
    // function fetchUserData() {
    //     // ... (your existing code)
    
    //     // Display the password as asterisks
    //     document.getElementById('password').innerText = maskPassword(data.password);
    
    //     // ... (your existing code)
    // }
        