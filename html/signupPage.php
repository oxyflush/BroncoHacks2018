<?php
$conn=oci_connect('aniu','Damnright1','//dbserver.engr.scu.edu/db11g');
if($conn) {
  print "<br> connection successDan";
} else {
  $e=oci_error;
  print "<br> connection fail:";
  print htmlentities($e['message']);
  exit;
}
//dan-start
if (isset($_POST['userName'])) {
	$userId = $_POST['userId'];
	$userName = $_POST['userName'];
	$age = $_POST['age'];
	$expertise = $_POST['expertise'];
	$insertIntoPeople = "insert into business values($userId,'$userName',$age,'$expertise')";
	$sql_statement = OCIParse($conn,$insertIntoPeople);
	echo $insertIntoPeople;
OCIExecute($sql_statement);
} else if (isset($_POST['delete'])) {
	$userId = $_POST['delete'];
	$deletePerson = "delete from business where ID=$userId";
	$sql_statement = OCIParse($conn,$deletePerson);
	OCIExecute($sql_statement);
}
echo "
<!DOCTYPE html>
<html>
<div id='root'></div>
<!-- Theme Made By www.w3schools.com - No Copyright -->
<title>BroncoHacks2018</title>

<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>

<!-- Bootstrap Core CSS -->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

<!-- Bootstrap Fonts -->
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

<!-- Bootstrap Core JS -->


<!-- General JS -->
<script src='../js/smoothScrolling.js'></script>
<script src='https://unpkg.com/react@16/umd/react.development.js'></script>
<script src='https://unpkg.com/react-dom@16/umd/react-dom.development.js'></script>
<script src='https://unpkg.com/babel-standalone@6.15.0/babel.min.js'></script>

<!-- General CSS -->
<link rel='stylesheet' href='../css/site.css'>
<link rel='stylesheet' href='../css/loginSignupPage.css'>

<script type='text/babel'>
  
  class Toggle extends React.Component {
    constructor(props) {
      super(props);
      this.state = {username: '',
        password: '',
        isBusiness: false,
        formErrors: {}
      };
    }

    dateChanged(event) {
      this.setState({date: event.target.value});
    }

    validateField(fieldName, value) {
  let fieldValidationErrors = this.state.formErrors;
  let emailValid = this.state.emailValid;
  let passwordValid = this.state.passwordValid;

  switch(fieldName) {
    case 'email':
      if (value === undefined) {
        emailValid = false;
        break;
      }
      emailValid = value.match(/^([\w.%+-]+)@([\w-]+\.)+([\w]{2,})$/i) != null;
      fieldValidationErrors.email = emailValid ? '' : ' is invalid';
      break;
    case 'password':
      if (value === undefined) {
        passwordValid = false;
        break;
      }
      passwordValid = (value.length >= 6);
      fieldValidationErrors.password = passwordValid ? '': ' is too short';
      break;
    default:
      break;
  }
  this.setState({formErrors: fieldValidationErrors,
                  emailValid: emailValid,
                  passwordValid: passwordValid
                });
}

  renderExpertises() {
      let expertises = ['Please select expertise', 'Engineering', 'Business', 'Law', 'Arts', 'iOS Developer']
      let returnVal = expertises.map((expertise, idx) => {
          return (<option value={expertise}>{expertise}</option>)
        });
        return returnVal;
    }
    renderInputs() {
      if (this.state.isBusiness) {
        return (
          <React.Fragment>
             <input name='address' type='text' id='name' value={this.state.address}
              onChange={(e) => this.setState({address: e.target.value})}
              className='form-control'
              placeholder={'Address'}/>
            <input name='city' type='text' id='name' value={this.state.city}
              onChange={(e) => this.setState({city: e.target.value})}
              className='form-control'
              placeholder={'City'}/>
              <input name='state' type='text' id='name' value={this.state.state}
              onChange={(e) => this.setState({state: e.target.value})}
              className='form-control'
              placeholder={'State'}/>
              <input name='zip' type='text' id='name' value={this.state.zip}
              onChange={(e) => this.setState({zip: e.target.value})}
              className='form-control'
              placeholder={'ZIP'}/>
          </React.Fragment>
      );
      }
      else {
        return (
          <React.Fragment>
              <input name='birthDate' type='date' className='form-control' onChange={this.dateChanged.bind(this)} />
              <input name='city' type='text' id='name' value={this.state.city}
              onChange={(e) => this.setState({city: e.target.value})}
              className='form-control'
              placeholder={'City'}/>
              <select name='expertise' className='form-control' id='dropdown'
              onChange={(e) => this.setState({expertise: e.target.value})}>
                {this.renderExpertises()}
            </select>
				<input name='userId' type='text' id='name' value={this.state.userId}
                onChange={(e) => this.setState({userId: e.target.value})}
                className='form-control'
                placeholder={'ID'}/>
                <input name='age' type='text' id='name' value={this.state.age}
                onChange={(e) => this.setState({age: e.target.value})}
                className='form-control'
                placeholder={'Age'}/>
                <input name='phoneNumber' type='text' id='name' value={this.state.phoneNumber}
                onChange={(e) => this.setState({phoneNumber: e.target.value})}
                className='form-control'
                placeholder={'Phone Number'}/>
                <input name='email' type='text' id='name' value={this.state.email}
                onChange={(e) => this.setState({email: e.target.value})}
                onBlur={() => this.validateField('email', this.state.email)}
                style={{backgroundColor: this.state.emailValid == false ? 'rgb(255,0,0,0.5)' : 'transparent'}}
                className='form-control'
                placeholder={'Email'}/>
          </React.Fragment>
        )
      }
    }

    render() {

      return (
          <React.Fragment>
              <nav class='navbar navbar-default navbar-fixed-top'>
                <div class='container'>
                  <div class='navbar-header'>
                    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                      <span class='icon-bar'></span>
                      <span class='icon-bar'></span>
                      <span class='icon-bar'></span>
                    </button>
                    <a class='navbar-brand' href='index.html#myPage'>Home</a>
                  </div>
                  <div class='collapse navbar-collapse' id='myNavbar'>
                    <ul class='nav navbar-nav navbar-right'>
                      <li>
                        <a href='index.html#about'>ABOUT</a>
                      </li>
                      <li>
                        <a href='index.html#services'>SERVICES</a>
                      </li>
                      <li>
                        <a href='index.html#portfolio'>PORTFOLIO</a>
                      </li>
                      <li>
                        <a href='index.html#pricing'>PRICING</a>
                      </li>
                      <li>
                        <a href='index.html#contact'>CONTACT</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
        <div style={{
            minWidth: 400,
            marginLeft: '25%',
            marginRight: '25%',
            marginTop: 60,
            border: '1px solid black'
        }} >
        <div>
					<div className='login-label'>Sign Up</div>
				</div>
        <div style={{display: 'flex' , justifyContent: 'center'}} >
          <input type = 'radio'
                 name = 'radSize'
                 id = 'sizeSmall'
                 value = 'small'
                 checked = {!this.state.isBusiness}
                 onClick={() => this.setState({isBusiness: false})} />
          <label for = 'sizeSmall'>Prisoner</label>
          <input type = 'radio'
                 name = 'radSize'
                 id = 'sizeMed'
                 value = 'medium'
                 checked = {this.state.isBusiness}
                 onClick={() => this.setState({isBusiness: true})} />
          <label for = 'sizeMed'>Business</label>
          </div>
				<form action='' className='loginForm' method='post' >
						<input name={this.state.isBusiness ? 'businessId' : 'userId'} type='text' id='name' value={this.state.username}
              onChange={(e) => this.setState({'username': e.target.value})}
              className='form-control'
              placeholder={this.state.isBusiness ? 'Business Name' : 'Full name'}/>
            {this.renderInputs()}
						<input name={'password'} type='password' id='paw' value={this.state.password}
              onChange={(e) => this.setState({password: e.target.value})}
              onBlur={() => this.validateField('password', this.state.password)}
              style={{backgroundColor: this.state.passwordValid == false ? 'rgb(255,0,0,0.5)' : 'transparent'}}
              className='form-control'
              placeholder='Password'/>
						<input type='button' id='submit'
            className='form-control' value='Submit'
             />
				</form>

        </div>
        </React.Fragment>
      );
    }
  }
  
    ReactDOM.render(
      <Toggle/>,
      document.getElementById('root')
    );
</script>

</html>"
?>
