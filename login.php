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
  
  <title>Log In</title>
  <style>
  </style>
</head>



<script src= "https://unpkg.com/react@16/umd/react.production.min.js"></script>
<script src= "https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
<script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
<?php

session_start();


 

?>

<header class="header">
        <h2 class="logo"><a href="order.php">Food Company</a></h2>
        <ul class="navmenu">
            <li><a href="order.php">Home</a></li>
            <li><a class="active" href="login.php">Login</a></li>
            <li><a href="registration.php">Register</a></li>

        </ul>
    </header>

<div id="root"></div>

<script type ="text/babel">

// Create a React component to control form state
class LoginForm extends React.Component {
  constructor(props) {
    super(props);
    this.state = {email: '', password: '', loginError: '', captchaInput: '', captchaPath: '', captchaSolution: '', captchaError :''};
    
   
    
    
    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleInputChange = this.handleInputChange.bind(this);


    
  } 
  
  
  // randomly generate a CAPTCHA from returned SQL query/JSON object
  componentDidMount() {
    fetch('generateCaptcha.php')
        .then(response => response.json())
        .then(paths => {
            const randomIndex = Math.floor(Math.random() * paths.length);
            const randomPath = paths[randomIndex];
            this.setState({ captchaPath: randomPath.imagepath, captchaSolution: randomPath.solution });

        });
} 


  handleLoginClick() {
  window.location.href = 'registration.php';
  }
  

  handleRegister(){
    window.location.href = 'registration.php';
  }


  handleInputChange(event) {
    const { name, value } = event.target;
    this.setState({ [name]: value });
  }

  handleChange(event) {
    this.setState({value: event.target.value});
  }
  

  // validate CAPTCHA input before allowing the user to login
  handleSubmit(event) {
     
    if(this.state.captchaInput !== this.state.captchaSolution){
      alert("Captcha is incorrect. Please try again.");
      event.preventDefault();
    }
    
    
}


  render() {
    return (

      
      
   
      <div class = "submit-page">

      <div class = "submitcontainer">

           <form className="login-form" action ="loginverify.php" method= "POST" onSubmit={this.handleSubmit} autoComplete="off">
           
            <input type="email" placeholder="Enter your email..." name="email" id="email"   value = {this.state.email} onChange={this.handleInputChange} />
            <input type="password" placeholder="Enter your password..." name="password" id="password"  value = {this.state.password}  onChange={this.handleInputChange} />

            <?php
    if (isset($_SESSION['error'])) {
      echo "<p class='error'>" . $_SESSION['error'] . "</p>";
      unset($_SESSION['error']);
    }
  ?>

              
<img src =  {this.state.captchaPath} alt="captcha" />
<input type="captchaInput" placeholder="Enter captcha..." name="captchaInput" id="captchaInput" value={this.state.captchaInput} onChange={this.handleInputChange} />
            <p>{this.state.captchaError}</p>  
            <input type="submit" value="Login"/>

           
           
          </form>


          <p> Don't have an account?</p>
          <button onClick = {this.handleRegister}> Register </button>
      </div>
      





      </div>
       
    );
  }

}





ReactDOM.render(
  <LoginForm />,
  document.getElementById('root')
);





  



</script>


  






</body>
</html>