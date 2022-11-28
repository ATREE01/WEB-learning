let canvas;
let ctx;
let gBArrayHeight = 20;
let gBArrayWidth = 12;
let startX = 4;
let startY = 0;
let score = 0;
let level = 1;
let winOrLose = "playing";
let coordinateArray = [...Array(gBArrayHeight)].map(e => Array(gBArrayWidth).fill(0));
let curTetromino = [[1,0],[0,1],[1,1],[2,1]];

let tetrominos = [];
let tetrominosColor = ['purple','cyan', 'blue', 'yellow', 'orange', ' green', 'red'];
let curTetrominoColor;

let gameBoardArray = [...Array(gBArrayHeight)].map(e => Array(gBArrayWidth).fill(0));

let stoppedShapeArray = [...Array(gBArrayHeight)].map(e => Array(gBArrayWidth).fill(0));

let DIRECTION ={
    IDLE: 0,
    DOWN: 1,
    LEFT: 2,
    RIGHT: 3
};
let direction;

class  Coordinates{
    constructor(x,y){
        this.x = x;
        this.y = y;
    }
}

document.addEventListener('DOMContentLoaded' , SetupCanvas);

function CreateCoordArray(){
    let i = 0, j = 0;
    for( let y = 9; y <= 446;y += 23){
        for(let x = 11; x <= 264 ; x += 23){
            coordinateArray[i][j] = new Coordinates(x,y);
            i++;
        }
        j++, i = 0;
    }
}

function SetupCanvas(){
    canvas = document.getElementById('my_canvas');
    ctx = canvas.getContext('2d');
    canvas.width = 936;
    canvas.height = 956;

    // ctx.scale(2,2);

    ctx.fillStyle = "white";
    ctx.fillRect(0,0,canvas.width,canvas.height);
    ctx.strokeStyle = 'black';
    ctx.strokeRect(8, 8, 280,462);

    ctx.fillStyle = "black";
    ctx.font = '21px Arial';
    ctx.fillText("SCORE", 300, 98);
    // Draw score rectangle
    ctx.strokeRect(300, 107, 161, 24);
    // Draw score
    ctx.fillText(score.toString(), 310, 127);
    // Draw level label text
    ctx.fillText("LEVEL", 300, 157);
    // Draw level rectangle
    ctx.strokeRect(300, 171, 161, 24);
    // Draw level
    ctx.fillText(level.toString(), 310, 190);
    // Draw next label text
    ctx.fillText("WIN / LOSE", 300, 221);
    // Draw playing condition
    ctx.fillText(winOrLose, 310, 261);
    // Draw playing condition rectangle
    ctx.strokeRect(300, 232, 161, 95);
    // Draw controls label text
    ctx.fillText("CONTROLS", 300, 354);
    // Draw controls rectangle
    ctx.strokeRect(300, 366, 161, 104);
    // Draw controls text
    ctx.font = '19px Arial';
    ctx.fillText("A : Move Left", 310, 388);
    ctx.fillText("D : Move Right", 310, 413);
    ctx.fillText("S : Move Down", 310, 438);
    ctx.fillText("E : Rotate Right", 310, 463);

    document.addEventListener('keydown', HandleKeyPress);
    CreateTetrominos();
    CreateTetromino();

    CreateCoordArray();
    DrawTetromino();
}

function DrawTetromino(){
    for(let i = 0; i < curTetromino.length; i++){
        let x = curTetromino[i][0] + startX;
        let y = curTetromino[i][1] + startY;
        gameBoardArray[x][y] = 1;
        let coorX = coordinateArray[x][y].x;
        let coorY = coordinateArray[x][y].y;
        ctx.fillStyle = curTetrominoColor;
        ctx.fillRect(coorX,coorY,21,21);
    }
}

function HandleKeyPress(key){
    if(winOrLose != "Game Over"){
        if(key.keyCode === 65){
            direction = DIRECTION.LEFT;
            if(!HittingTheWall() && !CheckForHorizontalCollision()){
                DeleteTetromino();
                startX--;
                DrawTetromino();
            }
        } else if(key.keyCode === 68){
            direction = DIRECTION.RIGHT;
            if(!HittingTheWall()  && !CheckForHorizontalCollision()){
                DeleteTetromino();
                startX++;
                DrawTetromino();
            }
        } else if(key.keyCode === 83){
            MoveTetrominnoDown();
        } else if(key.keyCode === 69){
            RotateTetromino();
        }
    }
}

function MoveTetrominnoDown(){
    direction = DIRECTION.DOWN;
    if(!CheckForVerticalCollision()){
        DeleteTetromino();
        startY++;
        DrawTetromino();
    }
}

// window.setInterval(function(){
//     if(winOrLose != "Game Over"){
//         MoveTetrominnoDown();
//     }
// }, 1000)

function DeleteTetromino(){
    for(let i = 0; i < curTetromino.length; i++){
        let x = curTetromino[i][0] + startX;
        let y = curTetromino[i][1] + startY;
        gameBoardArray[x][y] = 0;
        let coorX = coordinateArray[x][y].x;
        let coorY = coordinateArray[x][y].y;
        ctx.fillStyle = 'White';
        ctx.fillRect(coorX, coorY ,21 , 21);
    }
}

function CreateTetrominos(){
    // Push T 
    tetrominos.push([[1,0], [0,1], [1,1], [2,1]]);
    // Push I
    tetrominos.push([[0,0], [1,0], [2,0], [3,0]]);
    // Push J
    tetrominos.push([[0,0], [0,1], [1,1], [2,1]]);
    // Push Square
    tetrominos.push([[0,0], [1,0], [0,1], [1,1]]);
    // Push L
    tetrominos.push([[2,0], [0,1], [1,1], [2,1]]);
    // Push S
    tetrominos.push([[1,0], [2,0], [0,1], [1,1]]);
    // Push Z
    tetrominos.push([[0,0], [1,0], [1,1], [2,1]]);
}

function CreateTetromino(){
    let randomTetromino = Math.floor(Math.random() * tetrominos.length);
    curTetromino = tetrominos[randomTetromino];
    curTetrominoColor = tetrominosColor[randomTetromino];
}

function HittingTheWall(){
    for (let i = 0 ;i<curTetromino.length; i++){
        let nowX = curTetromino[i][0] + startX;
        if(nowX <= 0 && direction === DIRECTION.LEFT){
            return true;
        } else if(nowX >= 11 && direction === DIRECTION.RIGHT) {
            return true;
        }
    }
    return false;
}

function CheckForVerticalCollision(){
    let tetrominoCopy = curTetromino;
    let collision = false;
 
    for(let i = 0; i < tetrominoCopy.length; i++){
        let square = tetrominoCopy[i];
        let x = square[0] + startX;
        let y = square[1] + startY;
 
        if(direction === DIRECTION.DOWN){
            y++;
        }
 
        if(typeof stoppedShapeArray[x][y+1] === 'string'){
            DeleteTetromino();
            startY++;
            DrawTetromino();
            collision = true;
            break;
        }
        if(y >= 20){
            collision = true;
            break;
        }
    }
    if(collision){
        if(startY <= 2){
            winOrLose = "Game Over";
            ctx.fillStyle = 'white';
            ctx.fillRect(310, 242, 140, 30);
            ctx.fillStyle = 'black';
            ctx.fillText(winOrLose, 310, 261);
        } else {
 
            for(let i = 0; i < tetrominoCopy.length; i++){
                let square = tetrominoCopy[i];
                let x = square[0] + startX;
                let y = square[1] + startY;
                stoppedShapeArray[x][y] = curTetrominoColor;
            }
 
            CheckForCompletedRows();
 
            CreateTetromino();
 
            direction = DIRECTION.IDLE;
            startX = 4;
            startY = 0;
            DrawTetromino();
        }
    }
    return collision;
}


function CheckForHorizontalCollision(){
    let temptetromino = curTetromino;
    let collision = false;
    for( let i = 0; i< temptetromino.length;i++){
        let square = temptetromino[i];
        let x = square[0] + startX;
        let y = square[1] + startY;

        if(direction === DIRECTION.LEFT){
            x--;
        } else if(direction === DIRECTION.RIGHT){
            x++;
        }
        var stoppedShapeval = stoppedShapeArray[x][y];
        if(typeof stoppedShapeval === 'string'){
            collision = true;
            break;
        }
    }
    return collision;
};

function CheckForCompletedRows(){
    let rowsToDelete = 0;
    let startOfDeletion = 0;
    for(let y = 0; y < gBArrayHeight; y++){
        let completed = true;
        for (let x = 0 ; x < gBArrayWidth; x++){
            let square = stoppedShapeArray[x][y];
            if(square === 0 || (typeof square === 'undefined')){
                completed = false;
                break;
            }
        }
        if(completed){
            if(startOfDeletion === 0)startOfDeletion = y;
            rowsToDelete++;
            for(let i = 0 ;i < gBArrayWidth; i++){
                stoppedShapeArray[i][y] = 0;
                gameBoardArray[i][y] = 0;
                let coorX = coordinateArray[i][y].x;
                let coorY = coordinateArray[i][y].y;
                ctx.fillStyle= 'white';
                ctx.fillRect(coorX, coorY, 21, 21);
            }
        }
    }
    if(rowsToDelete > 0){
        score += 10;
        ctx.fillStyle = 'White';
        ctx.fillRect(310,109,140,19);
        ctx.fillStyle = 'black';
        ctx.fillText(score.toLocaleString(),310, 127);
        MoveAllRowsDOwn(rowsToDelete,startOfDeletion);
    }
}

function MoveAllRowsDOwn(rowsToDelete,startOfDeletion){
    for(var i = startOfDeletion-1; i>=0 ;i--){
        for(var x = 0; x< gBArrayHeight; x++){
            var y2 = i + rowsToDelete;
            var square = stoppedShapeArray[x][i];
            var nextSquare = stoppedShapeArray[x][y2];
            if(typeof square === 'string'){
                nextSquare = square;
                gameBoardArray[x][y2] = 1;
                stoppedShapeArray[x][y2] = square;
                let coorX = coordinateArray[x][y2].x;
                let coorY = coordinateArray[x][y2].y;
                ctx.fillStyle= nextSquare;
                ctx.fillRect(coorX, coorY, 21, 21);

                square = 0;
                gameBoardArray[x][i] = 0;
                stoppedShapeArray[x][i] = 0;
                coorX = coordinateArray[x][i].x;
                coorY = coordinateArray[x][i].y;
                ctx.fillStyle= 'white';
                ctx.fillRect(coorX, coorY, 21, 21);
            } 
        }
    }
}

function RotateTetromino(){
    let newRotation = new Array();
    let tetrominoCopy = curTetromino;
    let curTetrominoBU;
 
    for(let i = 0; i < tetrominoCopy.length; i++){
        curTetrominoBU = [...curTetromino];
 
        let x = tetrominoCopy[i][0];
        let y = tetrominoCopy[i][1];
        let newX = (GetLastSquareX() - y);
        let newY = x;
        console.log(x,y);
        newRotation.push([newX, newY]);
    }
    DeleteTetromino();
 
    try{
        curTetromino = newRotation;
        DrawTetromino();
    }  
    catch (e){ 
        if(e instanceof TypeError) {
            curTetromino = curTetrominoBU;
            DeleteTetromino();
            DrawTetromino();
        }
    }
}

function GetLastSquareX(){
    let lastX = 0;
     for(let i = 0; i < curTetromino.length; i++)
    {
        let square = curTetromino[i];
        if (square[0] > lastX)
            lastX = square[0];
    }
    return lastX;
}
