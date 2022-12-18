const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let timeToNextRaven = 0;
let ravenInterval = 500;
let lastTime = 0;

let ravens = [];
class Raven {
    constructor(){
        this.spriteWidth = 271;
        this.spriteHeight = 194;
        this.sizeModifier = Math.random() * 0.6 + 0.4;
        this.width = this.spriteHeight * this.sizeModifier;
        this.height = this.spriteHeight * this.sizeModifier;
        this.x = canvas.width;
        this.y = Math.random() * (canvas.height - this.height);
        this.directionX = Math.random() * 5 + 3;
        this.directionY = Math.random() * 5 - 2.5;
        this.markedForDeletion = false;
        this.image = new Image();
        this.image.src = 'game_img/raven.png';
        this.frame = 0;
        this.maxFrame = 4;
        this.timeSinceFlap = 0;
        this.flapInterval = 50;
    }
    update(deltatime){
        this.x -= this.directionX;
        this.y += this.directionY;
        if(this.x < 0 - this.width)this.markedForDeletion = true;
        this.timeSinceFlap +=  deltatime;
        if(this.timeSinceFlap > this.flapInterval){
            this.frame++;
            this.frame %= this.maxFrame;
            this.timeSinceFlap = 0;
        }
    }
    draw(){
        ctx.strokeRect(this.x, this.y, this.width, this.height);
        ctx.drawImage(this.image,this.frame * this.spriteWidth ,0 ,this.spriteWidth, this.spriteHeight, this.x, this.y, this.width, this.height);
    }
}

function animate(timestamp){
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    let deltatime = timestamp - lastTime;
    lastTime = timestamp;
    timeToNextRaven += deltatime;
    if(timeToNextRaven > ravenInterval){
        ravens.push(new Raven());
        timeToNextRaven = 0;
    }
    [...ravens].forEach(object => {
        object.update(deltatime);
        object.draw();
    })  
    ravens = ravens.filter(object => !object.markedForDeletion)
    requestAnimationFrame(animate);
}
animate(0);