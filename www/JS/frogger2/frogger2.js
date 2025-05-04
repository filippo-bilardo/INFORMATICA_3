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
 * Sito web: https://www.marcoku.com
 * YouTube: https://www.youtube.com/marcoku
 * GitHub: 
 * data: 10/06/2024
 */

// Inizializzazione del canvas e del contesto
var canvas = document.getElementById('gameCanvas');
var context = canvas.getContext('2d');
canvas.width = 800;
canvas.height = 600;

// Configurazione del gioco
var grid = 50; // Dimensione della griglia (ogni cella è di 50x50 pixel)
var gameWidth = canvas.width;
var gameHeight = canvas.height;

// Caricamento delle immagini
var frogImage = new Image();
var carImage = new Image();
var carImage2 = new Image();
var truckImage = new Image();

var imagesToLoad = 4; // Numero totale di immagini da caricare

frogImage.src = 'frog.png'; // Sostituisci con il percorso della tua immagine frog.png
carImage.src = 'car1.png'; // Sostituisci con il percorso della tua immagine car1.png
carImage2.src = 'car1.png'; // Sostituisci con il percorso della tua immagine car1.png
truckImage.src = 'truck1.png'; // Sostituisci con il percorso della tua immagine truck1.png

frogImage.onload = onImageLoad;
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
var frog = {
    x: gameWidth / 2 - grid / 2,
    y: gameHeight - grid,
    width: grid,
    height: grid,
    dx: grid,
    dy: grid
};

// Configurazione degli ostacoli
var obstacles = [];
var numCars = 3;
var numTrucks = 2;
var carWidth = grid * 2;
var truckWidth = grid * 3;
var obstacleHeight = grid;

// Funzione per creare ostacoli
function createObstacles() {
    // Creare auto
    for (var i = 0; i < numCars; i++) {
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
    for (var i = 0; i < numTrucks; i++) {
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
    context.drawImage(frogImage, frog.x, frog.y, frog.width, frog.height);
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
            resetGame();
        }
    });
}

// Resettare il gioco
function resetGame() {
    frog.x = gameWidth / 2 - grid / 2;
    frog.y = gameHeight - grid;
}

// Movimento del giocatore
document.addEventListener('keydown', function(event) {
    switch(event.key) {
        case 'ArrowUp':
            if (frog.y - frog.dy >= 0) {
                frog.y -= frog.dy;
            }
            break;
        case 'ArrowDown':
            if (frog.y + frog.dy < gameHeight) {
                frog.y += frog.dy;
            }
            break;
        case 'ArrowLeft':
            if (frog.x - frog.dx >= 0) {
                frog.x -= frog.dx;
            }
            break;
        case 'ArrowRight':
            if (frog.x + frog.dx < gameWidth) {
                frog.x += frog.dx;
            }
            break;
    }
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
