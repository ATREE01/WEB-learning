/** @type {HTMLCanvasElement} */
const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
CANVAS_WIDTH = canvas.width = 500;
CANVAS_HEIGHT = canvas.height = 1000;
const numberOfEnemies = 10;
const enemiesArray = [];

let gameframe = 0;

class Enemy {
    constructor(){
        this.image = new Image();
        this.image.src = 'game_img/enemy2.png';
        this.spriteWidth = 266;
        this.spriteHeight = 188;
        this.speed = Math.random() * 4 + 1;
        this.width = this.spriteWidth / 2.5;
        this.height = this.spriteHeight / 2.5;
        this.x = Math.random() * (canvas.width - this.width);
        this.y = Math.random() * (canvas.height - this.height);
        this.frame = 0;
        this.flapSpeed = Math.floor(Math.random() * 6 + 1);
        this.angle = 0;
        this.angleSpeed = Math.random() * 0.2;
        this.curve = Math.random() * 5;
    }
    update(){
        this.x -= this.speed;
        this.y += Math.sin(this.angle) *this.curve;
        this.angle += this.angleSpeed;
        if(this.x + this.width  < 0){
                this.x = canvas.width;
                this.y = Math.random() * (canvas.height - this.height);
        }
        if(gameframe % this.flapSpeed === 0)
            this.frame++;
        this.frame %= 4;
    }
    draw(){
        ctx.drawImage(this.image, this.frame * this.spriteWidth, 0,this.spriteWidth, this.spriteHeight, 
        this.x, this.y, this.width, this.height);
    }
}

for(let i = 0 ; i < numberOfEnemies; i++)
   enemiesArray.push(new Enemy());

function animate(){
    ctx.clearRect(0,0,CANVAS_WIDTH,CANVAS_HEIGHT);
    enemiesArray.forEach(enemy => {
        enemy.update();
        enemy.draw();
    });
    gameframe++;
    requestAnimationFrame(animate);
}

animate();

console.log();