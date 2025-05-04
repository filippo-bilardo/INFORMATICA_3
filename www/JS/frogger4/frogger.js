/**
 * Frogger
 * Gioco ispirato al classico Frogger
 * 
 * Istruzioni:
 * - Usa le frecce direzionali per muovere la rana
 * - Evita le auto e i camion
 * - Arriva alla fine del percorso per vincere
 * 
 * Buon divertimento!
 * 
 * Autore: Filippo Bilardo (with AI)
 * Sito web: https://fb-labs.blogspot.com/
 * YouTube: 
 * GitHub: 
 * data: 10/06/2024
 */

// Inizializzazione del canvas e del contesto
const canvas = document.getElementById('gameCanvas');
const context = canvas.getContext('2d');
canvas.width = 800;
canvas.height = 600;

// Configurazione del gioco
const grid = 50; // Dimensione della griglia (ogni cella è di 50x50 pixel)
const gameWidth = canvas.width;
const gameHeight = canvas.height;

// Caricamento degli effetti sonori
const startSound = new Audio('wav/frog_start.wav');      // Suono per i salti della rana
const moveSound = new Audio('wav/frog_hop.wav');      // Suono per i salti della rana
const smushSound = new Audio('wav/frog_smush.wav');   // Suono per la collisione con un ostacolo 
const gameOverSound = new Audio('wav/gameover.wav');   // Suono per la fine del gioco

// Caricamento delle immagini
let imagesToLoad = 5; // Numero totale di immagini da caricare
const frogImage = new Image();
const frogDeadImage = new Image();
const carImage = new Image();
const carImage2 = new Image();
const truckImage = new Image();

frogImage.src = 'img/frog.png';
frogDeadImage.src = 'img/frog_dead.png';
carImage.src = 'img/car1.png';
carImage2.src = 'img/car1.png'; 
truckImage.src = 'img/truck1.png';

frogImage.onload = onImageLoad;
frogDeadImage.onload = onImageLoad;
carImage.onload = onImageLoad;
carImage2.onload = onImageLoad;
truckImage.onload = onImageLoad;

function onImageLoad() {
    imagesToLoad--;
    if (imagesToLoad === 0) {
        createObstacles();
        gameLoop();
    }
}

// Configurazione del giocatore (rana)
let frog = {
    x: gameWidth / 2 - grid / 2,
    y: gameHeight - grid,
    width: grid,
    height: grid,
    dx: grid,
    dy: grid,
    direction: 0 // 0 = up, 90 = right, 180 = down, 270 = left
};

// Configurazione degli ostacoli
let obstacles = [];
let numCars = 3;
let numTrucks = 2;
let carWidth = grid * 2;
let truckWidth = grid * 3;
let obstacleHeight = grid;

// Funzione per creare ostacoli
function createObstacles() {
    // Creare auto
    for (let i = 0; i < numCars; i++) {
        obstacles.push({
            x: i * 300,
            y: gameHeight - 2 * grid,
            width: carWidth,
            height: obstacleHeight,
            dx: 2,
            image: carImage
        });
    }
    // Creare camion
    for (let i = 0; i < numTrucks; i++) {
        obstacles.push({
            x: i * 350,
            y: gameHeight - 5 * grid,
            width: truckWidth,
            height: obstacleHeight,
            dx: -1.5,
            image: truckImage
        });
    }
}

// Disegnare la rana
function drawFrog() {
    context.save();
    context.translate(frog.x + frog.width / 2, frog.y + frog.height / 2);
    context.rotate(frog.direction * Math.PI / 180);
    context.drawImage(frogImage, -frog.width / 2, -frog.height / 2, frog.width, frog.height);
    context.restore();
}

// Disegnare la rana morta
function drawFrogDead() {
    //Cancello la rana  
    context.clearRect(frog.x, frog.y, frog.width, frog.height);
    //Disegna l'immagine della rana morta
    context.drawImage(frogDeadImage, frog.x, frog.y, frog.width, frog.height);
}

// Disegnare gli ostacoli
function drawObstacles() {
    obstacles.forEach(function(obstacle) {
        context.drawImage(obstacle.image, obstacle.x, obstacle.y, obstacle.width, obstacle.height);
    });
}

// Aggiornare la posizione degli ostacoli
function updateObstacles() {
    obstacles.forEach(function(obstacle) {
        obstacle.x += obstacle.dx;
        if (obstacle.x > gameWidth) {
            obstacle.x = -obstacle.width;
        }
        if (obstacle.x + obstacle.width < 0) {
            obstacle.x = gameWidth;
        }
    });
}

// Rilevamento delle collisioni
function checkCollisions() {
    obstacles.forEach(function(obstacle) {
        if (frog.x < obstacle.x + obstacle.width &&
            frog.x + frog.width > obstacle.x &&
            frog.y < obstacle.y + obstacle.height &&
            frog.y + frog.height > obstacle.y) {
            drawFrogDead();
            smushSound.play();
            //Aspetta un po' prima di resettare il gioco
            setTimeout(resetGame, 500);
            //resetGame();
        }
    });
}

// Resettare il gioco
function resetGame() {
    frog.x = gameWidth / 2 - grid / 2;
    frog.y = gameHeight - grid;
    frog.direction = 0;
}

// Movimento del giocatore
document.addEventListener('keydown', function(event) {
    switch(event.key) {
        case 'ArrowUp':
            if (frog.y - frog.dy >= 0) {
                frog.y -= frog.dy;
                frog.direction = 0;
            }
            moveSound.play();
            break;
        case 'ArrowDown':
            if (frog.y + frog.dy < gameHeight) {
                frog.y += frog.dy;
                frog.direction = 180;
            }
            moveSound.play();
            break;
        case 'ArrowLeft':
            if (frog.x - frog.dx >= 0) {
                frog.x -= frog.dx;
                frog.direction = 270;
            }
            moveSound.play();
            break;
        case 'ArrowRight':
            if (frog.x + frog.dx < gameWidth) {
                frog.x += frog.dx;
                frog.direction = 90;
            }
            moveSound.play();
            break;
    }
});

// Rilevamento del touch per dispositivi mobili
canvas.addEventListener('touchstart', function(event) {
    let touch = event.touches[0];
    let touchX = touch.clientX - canvas.offsetLeft;
    let touchY = touch.clientY - canvas.offsetTop;

    let diffX = touchX - (frog.x + frog.width / 2);
    let diffY = touchY - (frog.y + frog.height / 2);

    if (Math.abs(diffX) > Math.abs(diffY)) {
        // Movimento orizzontale
        if (diffX > 0 && frog.x + frog.dx < gameWidth) {
            frog.x += frog.dx;
            frog.direction = 90;
        } else if (diffX < 0 && frog.x - frog.dx >= 0) {
            frog.x -= frog.dx;
            frog.direction = 270;
        }
    } else {
        // Movimento verticale
        if (diffY > 0 && frog.y + frog.dy < gameHeight) {
            frog.y += frog.dy;
            frog.direction = 180;
        } else if (diffY < 0 && frog.y - frog.dy >= 0) {
            frog.y -= frog.dy;
            frog.direction = 0;
        }
    }
    moveSound.play();
});

// Funzione principale del gioco
function gameLoop() {
    context.clearRect(0, 0, gameWidth, gameHeight); // Pulire il canvas
    drawFrog();
    drawObstacles();
    updateObstacles();
    checkCollisions();
    requestAnimationFrame(gameLoop); 
}
