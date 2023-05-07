<!DOCTYPE html>
<html>
<head>
<style>
* {
  margin: 0;
  padding: 0;
  border: 2px grey;
  box-sizing: border-box;
  text-decoration: none;
  }
  
h1 {
  font-size: 50px;
  color: gold;
  font-family: Verdana, Arial;
}

#header{
  list-style-type: none;
  overflow: hidden;
  top: 0;
  display: flex;
  align-items: flex-start;
  justify-content: left;
  padding-bottom: 10px;
  min-width: 1000px;
}

.headertext{
  display: inline-block;
  text-align: center;

}

.logo{
  display: inline-block;
  width: 100px;
  height: 125px;
  background-image:url("media/logo2.png");
  background-size: cover;
}


#navbar {
  background-color: #549bf7;
  font-size: 20px;
  color: white;
  list-style-type: none;
  margin: 0px;
  padding: 0 8px;
  overflow: hidden;
  position: -webkit-sticky; /* Safari */
  position: static;
  top: 0;
  display: flex;
  align-items: flex-start;
  justify-content: left;
  min-width: 1000px;
  height: 65px;
  }
  
  
.navbarlist {
  background-color: #549bf7;
  display: inline-block;
  margin: 10px;
  text-align: center;
  padding: 10px 30px;
  border: 2px grey;
  font-family: Verdana, Arial;
  }

  li a {
    color: #f0ffff;
  }

  nav a.current {
  color: black;
  box-shadow: inset 0px -2px 0px 0px black;
  }

  .navbarlist:hover{
    box-shadow: inset 0px -2px 0px 0px black;
  }

  .logout{
        float: right;
        display: inline-block;
        margin: 10px;
        text-align: right;
        list-style-type: none;
        font-size: 20px;
        font-family: Verdana, Arial;
        padding: 10px 30px;
    }
    .logout:hover{
    box-shadow: inset 0px -2px 0px 0px black;
  }
</style>
</head>
<body>
<div id= "header">
  <ul>
      <li class = "logo"></li>
      <li class = "headertext"><h1>AgriCom Training</h1></li>
  </ul>
</div>

<!--script to add active class to current navigation button -->
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script>
$(function(){
  $('a').each(function() {
    if ($(this).prop('href') == window.location.href) {
      $(this).addClass('current');
    }
  });
});
</script>

<div id="navbar">
 
 <nav>
    <ul  >
        <li class="navbarlist"><a href="index.php">Portfolio</a></li>
        <li class="navbarlist" ><a href="orders.php">Orders</a></li>
        <li class="navbarlist"><a href="newsfeed.php">Newsfeed</a></li>
        <li class="navbarlist"><a href="training.php">Training</a></li>
        <li class="navbarlist"><a href="account.php">Account</a></li>
        <li class="logout"><a href="logout.php">Logout</a></li>
    </ul>
  </nav>  
</div>

</body>
</html>