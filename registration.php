<!DOCTYPE html>
<html>
<body>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Open+Sans:wght@300;400;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
 
  <title>Registration</title>

  <style>
  </style>
</head>



<script src= "https://unpkg.com/react@16/umd/react.production.min.js"></script>
<script src= "https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
<script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>

<?php

session_start(); // Start the session



?>
<header class="header">
        <h2 class="logo"><a href="order.php">Food Company</a></h2>
        <ul class="navmenu">
            <li><a href="order.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a class="active" href="registration.php">Register</a></li>

        </ul>
    </header>

<div id="root"></div>

<script type ="text/babel">


class Form extends React.Component {
  constructor(props) {
    super(props);
    this.state = {username: '', phone: '', email: '', password: '', errorMessage: '', invalidPhone: '', invalidEmail: '', invalidPassword: ''     };

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleInputChange = this.handleInputChange.bind(this);

  } 
  

  handleLoginClick() {
  window.location.href = 'login.php';
  }

  handleInputChange(event) { // live validation of user input
    const { name, value } = event.target;
    this.setState({ [name]: value });

    if (name === 'username') {
    const re = /^[a-zA-Z]*$/;

    if (re.test(value)) {
      this.setState({ [name]: value, errorMessage: ''});
    } else {
      this.setState({
        errorMessage: 'Username should only contain letters.'

      });
      
    }
  } else {
    this.setState({
      [name]: value
    });
  }
  

  if (name === 'phone') {
    const re = /^[0-9]{11}$/;

    if (re.test(value) && value.length === 11 || value.length === 0) {
      this.setState({ [name]: value, invalidPhone: ''});
    } else {
      this.setState({
        invalidPhone: 'Valid phone number required, must contain 11 digits.'
        
      });
      
    }
  } else {
    this.setState({
      [name]: value
    });
  }

  
  if (name === 'email') {
  const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;

  if (regex.test(value) || value.length === 0) {
      this.setState({
        [name]: value, invalidEmail: ''
      });
    } else {
      this.setState({
        invalidEmail: 'Valid email address required'
      });
    }
  } else {
    this.setState({
      [name]: value
    });
  } 

  if (name === 'password') {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; // at least 8 characters long, one uppercase character, and a special character
  if (regex.test(value)|| value.length === 0) {
      this.setState({
        [name]: value, invalidPassword: ''
      });
    } else {
      this.setState({
        invalidPassword: 'Password must include one uppercase and one special character and be 8 characters long.'
      });
    }
  } else {
    this.setState({
      [name]: value
    });
  } 

  
  

  
}
   
    
    
  


  

  handleChange(event) {
    this.setState({value: event.target.value});
  }

  handleSubmit(event) { // prevents the user from submitting the form in final validation check
    
    

  const isValidUsername = /^[a-zA-Z]*$/.test(this.state.username);
  const isValidPhone = /^[0-9]{11}$/.test(this.state.phone);
  const isValidEmail = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i.test(this.state.email);
  const isValidPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(this.state.password);
    if(!isValidUsername || !isValidPhone || !isValidEmail || !isValidPassword) {
      
      alert("Please enter valid information.");
      event.preventDefault();
    }
  
}
      
  
    
    
  


render() {
    return (
      <div class = "submit-page">

      <div class = "submitcontainer">

           <form className="login-form" action ="regsubmit.php" method= "POST" onSubmit={this.handleSubmit} autoComplete="off">
            <input type="username" placeholder="Enter your username..." name="username" id="username" required value = {this.state.username} onChange={this.handleInputChange} />
            <p>{this.state.errorMessage}</p>

            <input type="phone" placeholder="Enter your phone..." name="phone" id="phone" required  value = {this.state.phone} onChange={this.handleInputChange} />
            <p>{this.state.invalidPhone}</p>
            <input type="email" placeholder="Enter your email..." name="email" id="email" required  value = {this.state.email} onChange={this.handleInputChange} />
            <p>{this.state.invalidEmail}</p>
            <input type="password" placeholder="Enter your password..." name="password" id="password" required value = {this.state.password}  onChange={this.handleInputChange} />
            <p>{this.state.invalidPassword}</p>
            <?php
    if (isset($_SESSION['regError'])) {
      echo "<p class='regError'>" . $_SESSION['regError'] . "</p>";
      unset($_SESSION['regError']);
    }
  ?>
            <input type="submit" value="Register" />
            <p> Already have an account?</p>

            <input type="submit" value="Login"  onClick = {this.handleLoginClick}  />

          </form>

      </div>
      





      </div>
       
    );
  }

}




ReactDOM.render(
  <Form />,
  document.getElementById('root')
);





  



</script>













</body>
</html>