<?php
header("Content-Type: application/json");

include "db.php";

$game = $_GET['game'];

$stmt = $conn->prepare(
"SELECT player_name, score
FROM scores
WHERE game_name=?
ORDER BY score DESC
LIMIT 3"
);

$stmt->bind_param("s",$game);
$stmt->execute();

$result = $stmt->get_result();

$scores = [];

while($row = $result->fetch_assoc()){
$scores[] = $row;
}

echo json_encode($scores);

$conn->close();
?>