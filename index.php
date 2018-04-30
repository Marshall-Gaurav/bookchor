<?php
// include('connection.php');
class User {
    public $name = "";
    public $gender  = "";
    public $dob = "";
    public $experience = "";
    public $skills = "";
    public $email = "";
    public $phone = "";
}
$user = new User();
$user->name = "Gaurav Kumar";
$user->gender  = "Male";
$user->dob  = "28/05/1994";
$user->experience  = "Fresher";
$user->skills  = array('PHP'=>'Intermediate', 'Angular'=>'Intermediate', 'MySQli'=>'Intermediate', 'Bootstrap'=>'Intermediate', 'Angular-Material'=>'Beginner', 'C'=>'Intermediate', 'Python'=>'Beginner');
$user->email = 'code.multiosop@gmail.com';
$user->phone = 9412102272;
echo '<h1>JSON DATA</h1>';
$data = json_encode($user);
echo $data.'<br><br>';
if(isset($_POST['submit']))
{
    echo '<h1>UPDATED JSON DATA</h1>';
    $user->email=$_POST['email'];
    $user->phone=$_POST['phone'];
    $dat1 = [ $_POST['skill1']=>$_POST['exper1'] ];
    $dat2 = [ $_POST['skill2']=>$_POST['exper2'] ];
    $user->skills = array_merge($user->skills, $dat1);
    $user->skills = array_merge($user->skills, $dat2);
    $dataN = json_encode($user);
    echo $dataN;
    $data = $dataN;
}
?>
<html>
<head>
    <title>Book Chor Test</title>
</head>
<body>
<br><br>
<form method='post'>
    <fieldset>
    <legend>Update JSON</legend>
    <table>
        <thead>
            <th>ID.</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Skill</th>
            <th>Experience</th>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><input type='email' name='email' required></td>
                <td><input type='text' name='phone' required></td>
                <td><input type='text' name='skill1' required></td>
                <td><input type='text' name='exper1' required></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><input type='text' name='skill2' required></td>
                <td><input type='text' name='exper2' required></td>
            </tr>
        </tbody>
    </table>
    <input type='submit' value='Save' name='submit'>
    </fieldset>
</form>
<a href='ques.php'>Link to Next Question</a>
</body>
</html>



