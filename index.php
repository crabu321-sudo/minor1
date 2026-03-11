<?php
// Homepage for Gaming Platform
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Gaming Platform</title>

<style>
:root{
--cyan:#00ffff;
--dark:#0f2027;
--mid:#203a43;
}

body{
margin:0;
font-family:Arial,sans-serif;
color:white;
background:linear-gradient(-45deg,var(--dark),var(--mid),#2c5364,#1c1c1c);
background-size:400% 400%;
animation:gradientBG 15s ease infinite;
min-height:100vh;
overflow-x:hidden;
}

@keyframes gradientBG{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

canvas#bg{
position:fixed;
top:0;
left:0;
z-index:-1;
pointer-events:none;
}

header{
background:rgba(0,0,0,0.65);
backdrop-filter:blur(6px);
padding:1.8rem;
text-align:center;
font-size:2.1rem;
font-weight:bold;
border-bottom:1px solid rgba(0,255,255,0.18);
}

.games-container{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
gap:28px;
padding:40px 5vw;
max-width:1400px;
margin:0 auto;
}

.game-card{
background:rgba(0,0,0,0.58);
border-radius:16px;
overflow:hidden;
transition:all .35s ease;
cursor:pointer;
text-align:center;
border:1px solid rgba(0,255,255,.22);
backdrop-filter:blur(5px);
box-shadow:0 4px 15px rgba(0,0,0,.4);
text-decoration:none;
color:inherit;
display:block;
}

.game-card:hover{
transform:translateY(-12px) scale(1.06);
box-shadow:0 12px 35px rgba(0,255,255,.28);
border-color:var(--cyan);
}

.game-image{
height:160px;
display:flex;
align-items:center;
justify-content:center;
overflow:hidden;
}

.game-image img{
width:100%;
height:100%;
object-fit:cover;
}

.game-name{
margin:14px 10px 6px;
font-size:1.1rem;
font-weight:bold;
}

.high-score{
margin:5px 10px;
font-size:.9rem;
color:#ccc;
}

footer{
text-align:center;
padding:20px;
background:rgba(0,0,0,0.5);
margin-top:40px;
}
</style>
</head>

<body>

<canvas id="bg"></canvas>

<header>My Gaming Platform</header>

<div class="games-container">

<a href="ball.html" class="game-card">
<div class="game-image">
<img src="https://via.placeholder.com/240x160/00ffff/000000?text=Ball+Catch">
</div>
<div class="game-name">Ball Catch</div>
<div class="high-score">High Score: <span id="ball-high">—</span></div>
<ol id="ball-leaderboard"></ol>
</a>

<a href="circle1.html" class="game-card">
<div class="game-image">
<img src="https://via.placeholder.com/240x160/ff0000/ffffff?text=Click+Circle">
</div>
<div class="game-name">Click the Circle</div>
<div class="high-score">High Score: <span id="circle1-high">—</span></div>
<ol id="circle1-leaderboard"></ol>
</a>

<a href="dino1.html" class="game-card">
<div class="game-image">
<img src="https://via.placeholder.com/240x160/00ff00/000000?text=Dino+Runner">
</div>
<div class="game-name">Dino Runner</div>
<div class="high-score">High Score: <span id="dino1-high">—</span></div>
<ol id="dino1-leaderboard"></ol>
</a>

<a href="snake.html" class="game-card">
<div class="game-image">
<img src="https://via.placeholder.com/240x160/00ff00/000000?text=Snake">
</div>
<div class="game-name">Snake Game</div>
<div class="high-score">High Score: <span id="snake-high">—</span></div>
<ol id="snake-leaderboard"></ol>
</a>

</div>

<footer>
© Minor Project - GROUP 1 Abhay S R, S4 Computer Engineering, MTI Thrissur
</footer>

<script>
const canvas=document.getElementById("bg");
const ctx=canvas.getContext("2d");

canvas.width=window.innerWidth;
canvas.height=window.innerHeight;

let particles=[];

for(let i=0;i<120;i++){
particles.push({
x:Math.random()*canvas.width,
y:Math.random()*canvas.height,
r:Math.random()*2+1,
dx:Math.random()*1-.5,
dy:Math.random()*1-.5
});
}

function animate(){

ctx.clearRect(0,0,canvas.width,canvas.height);

particles.forEach(p=>{
p.x+=p.dx;
p.y+=p.dy;

if(p.x<0||p.x>canvas.width)p.dx*=-1;
if(p.y<0||p.y>canvas.height)p.dy*=-1;

ctx.fillStyle="rgba(0,255,255,0.7)";
ctx.beginPath();
ctx.arc(p.x,p.y,p.r,0,Math.PI*2);
ctx.fill();
});

requestAnimationFrame(animate);
}

animate();
</script>


<script>

async function loadLeaderboards(){

const games=[
'ball','circle1','dino1','snake'
];

for(const game of games){

try{

let res=await fetch(`get_highscore.php?game=${game}`);
let data=await res.json();

let high=document.getElementById(`${game}-high`);
let list=document.getElementById(`${game}-leaderboard`);

list.innerHTML="";

if(data.length>0){

data.forEach(p=>{
let li=document.createElement("li");
li.textContent=p.player_name+" : "+p.score;
list.appendChild(li);
});

high.textContent=data[0].score;

}else{
high.textContent="—";
}

}catch(e){
console.log("Error:",e);
}

}

}

loadLeaderboards();

</script>

</body>
</html>