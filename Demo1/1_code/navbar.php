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
  color: black;
  }
  
h1 {
  font-size: 50px;
  background-color: #549bf7;
  padding: 20px;
  margin-right: 100px;
}
#navbar {
  background-color: #549bf7;
  font-size: 25px;
  color: black;
  list-style-type: none;
  margin: 0px;
  padding: 0 8px;
  overflow: hidden;
  position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 0;
  display: flex;
  align-items: flex-start;
  justify-content: left;
  }
  
  
.navbarlist {
  display: inline-block;
  margin: 10px;
  color: black;
  text-align: center;
  padding: 20px 50px;
  border: 2px grey;
  box-shadow: 0 0 10px 0 black;
  }
  .logout{
        display: inline-block;
        margin-left: 50px;
        text-align: right;
        list-style-type: none;
        font-size: 20px;
    }
</style>
</head>
<body>

<div id="navbar">
 <h1>AgriCom Training</h1>
 <nav>
    <ul >
        <li class="navbarlist"><a href="index.php">Portfolio</a></li>
        <li class="navbarlist"><a href="orders.php">Orders</a></li>
        <li class="navbarlist"><a href="newsfeed.php">Newsfeed</a></li>
        <li class="navbarlist"><a href="training.php">Training</a></li>
        <li class="navbarlist"><a href="account.php">Account</a></li>
        <li class="logout"><a href="logout.php">Logout</a></li>
    </ul>
  </nav>  
</div>

</body>
</html>