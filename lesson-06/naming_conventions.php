<input name="age">
<input name="name">
<input name="dob">

$age = $_POST['age'];
$name = $_POST['name'];
$dob = $_POST['dob'];

'INSERT INTO person (age, name, dob) VALUES (:age, :name, :dob)'

$sth->bindParam(':age', $age, PDO::PARAM_INT);
$sth->bindParam(':name', $name, PDO::PARAM_STR);
$sth->bindParam(':dob', $dob, PDO::PARAM_STR);

var_dump( $_POST );

<input type="hidden" value="<?= $console['id']" ?>>

SELECT games.name as game, consoles.name as console FROM games JOIN consoles ON games.console_id = consoles.id