/**
 * @file
 * @brief Gioco Frogger ispirato al classico arcade.
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

const canvas = document.getElementById('gameCanvas');
const context = canvas.getContext('2d');
canvas.width = 800;
canvas.height = 600;

/**
 * @class SoundManager
 * @brief Gestisce gli effetti sonori del gioco.
 */
class SoundManager {
    constructor() {
        this.startSound = new Audio('wav/frog_start.wav');
        this.moveSound = new Audio('wav/frog_hop.wav');
        this.smushSound = new Audio('wav/frog_smush.wav');
        this.gameOverSound = new Audio('wav/gameover.wav');
    }

    playStartSound() {
        this.startSound.play();
    }

    playMoveSound() {
        this.moveSound.play();
    }

    playSmushSound() {
        this.smushSound.play();
    }
}

const soundManager = new SoundManager();

/**
 * @class ImageManager
 * @brief Gestisce il caricamento delle immagini del gioco.
 */
class ImageManager {
    constructor() {
        this.imagesToLoad = 6; // Incrementato a 6 per includere lo sfondo
        this.frogImage = this.loadImage('img/frog.png');
        this.frogDeadImage = this.loadImage('img/frog_dead.png');
        this.carImage = this.loadImage('img/car1.png');
        this.carImage2 = this.loadImage('img/car2.png');
        this.truckImage = this.loadImage('img/truck1.png');
        this.backgroundImage = this.loadImage('img/newfrogger.png'); // Aggiunta l'immagine di sfondo
    }

    /**
     * @brief Carica un'immagine e decrementa il contatore delle immagini da caricare.
     * @param {string} src - Percorso dell'immagine.
     * @return {Image} L'immagine caricata.
     */
    loadImage(src) {
        let img = new Image();
        img.src = src;
        img.onload = this.onImageLoad.bind(this);
        return img;
    }

    /**
     * @brief Funzione di callback chiamata quando un'immagine è stata caricata.
     */
    onImageLoad() {
        this.imagesToLoad--;
        if (this.imagesToLoad === 0) {
            game.start();
        }
    }
}

const imageManager = new ImageManager();

/**
 * @class Background
 * @brief Gestisce il disegno dello sfondo.
 */
class Background {
    constructor(image) {
        this.image = image;
    }

    /**
     * @brief Disegna lo sfondo sul canvas.
     * @param {CanvasRenderingContext2D} context - Il contesto del canvas.
     */
    draw(context) {
        context.drawImage(this.image, 0, 0, canvas.width, canvas.height);
    }
}

const background = new Background(imageManager.backgroundImage);

/**
 * @class Frog
 * @brief Rappresenta la rana controllata dal giocatore.
 */
class Frog {
    constructor(x, y, width, height, grid) {
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;
        this.grid = grid;
        this.dx = grid;
        this.dy = grid;
        this.direction = 0;
        this.dead = false;
    }

    /**
     * @brief Disegna la rana sul canvas.
     * @param {CanvasRenderingContext2D} context - Il contesto del canvas.
     */
    draw(context) {
        context.save();
        context.translate(this.x + this.width / 2, this.y + this.height / 2);
        context.rotate(this.direction * Math.PI / 180);
        if (this.dead) {
            context.drawImage(imageManager.frogDeadImage, -this.width / 2, -this.height / 2, this.width, this.height);
        } else {
            context.drawImage(imageManager.frogImage, -this.width / 2, -this.height / 2, this.width, this.height);
        }
        context.restore();
    }

    /**
     * @brief Resetta la posizione della rana.
     */
    reset() {
        this.x = canvas.width / 2 - this.grid / 2;
        this.y = canvas.height - this.grid;
        this.direction = 0;
        this.dead = false;
    }

    /**
     * @brief Muove la rana nella direzione specificata.
     * @param {string} direction - La direzione del movimento ('up', 'down', 'left', 'right').
     */
    move(direction) {
        if (!this.dead) {
            switch (direction) {
                case 'up':
                    if (this.y - this.dy >= 0) {
                        this.y -= this.dy;
                        this.direction = 0;
                    }
                    break;
                case 'down':
                    if (this.y + this.dy < canvas.height) {
                        this.y += this.dy;
                        this.direction = 180;
                    }
                    break;
                case 'left':
                    if (this.x - this.dx >= 0) {
                        this.x -= this.dx;
                        this.direction = 270;
                    }
                    break;
                case 'right':
                    if (this.x + this.dx < canvas.width) {
                        this.x += this.dx;
                        this.direction = 90;
                    }
                    break;
            }
            soundManager.playMoveSound();
        }
    }
}

const frog = new Frog(canvas.width / 2 - 25, canvas.height - 50, 50, 50, 50);

/**
 * @class Obstacle
 * @brief Rappresenta un ostacolo nel gioco.
 */
class Obstacle {
    constructor(x, y, width, height, dx, image) {
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;
        this.dx = dx;
        this.image = image;
    }

    /**
     * @brief Disegna l'ostacolo sul canvas.
     * @param {CanvasRenderingContext2D} context - Il contesto del canvas.
     */
    draw(context) {
        context.drawImage(this.image, this.x, this.y, this.width, this.height);
    }

    /**
     * @brief Aggiorna la posizione dell'ostacolo.
     */
    update() {
        this.x += this.dx;
        if (this.x > canvas.width) {
            this.x = -this.width;
        }
        if (this.x + this.width < 0) {
            this.x = canvas.width;
        }
    }

    /**
     * @brief Controlla se l'ostacolo collide con la rana.
     * @param {Frog} frog - La rana del giocatore.
     * @return {boolean} True se c'è una collisione, altrimenti false.
     */
    checkCollision(frog) {
        return frog.x < this.x + this.width &&
               frog.x + frog.width > this.x &&
               frog.y < this.y + this.height &&
               frog.y + frog.height > this.y;
    }
}

/**
 * @class Game
 * @brief Gestisce il ciclo di gioco e gli elementi del gioco.
 */
class Game {
    constructor() {
        this.obstacles = [];
        this.createObstacles();
        this.touchStartX = 0;
        this.touchStartY = 0;
    }

    /**
     * @brief Crea gli ostacoli del gioco.
     */
    createObstacles() {
        for (let i = 0; i < 3; i++) {
            this.obstacles.push(new Obstacle(i * 300, canvas.height - 150, 100, 50, 2, imageManager.carImage));
        }
        for (let i = 0; i < 3; i++) {
            this.obstacles.push(new Obstacle(i * 400, canvas.height - 200, 120, 50, -1, imageManager.carImage2));
        }
        for (let i = 0; i < 2; i++) {
            this.obstacles.push(new Obstacle(i * 350, canvas.height - 250, 150, 50, -1.5, imageManager.truckImage));
        }
    }

    /**
     * @brief Avvia il ciclo di gioco.
     */
    start() {
        this.gameLoop();
    }

    /**
     * @brief Esegue il ciclo principale del gioco.
     */
    gameLoop() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        background.draw(context); // Disegna lo sfondo
        frog.draw(context);
        this.obstacles.forEach(obstacle => {
            obstacle.draw(context);
            obstacle.update();
            if (obstacle.checkCollision(frog)) {
                if (!frog.dead) {
                    soundManager.playSmushSound();
                    frog.dead = true;
                    setTimeout(() => frog.reset(), 1000);
                }
            }
        });
        requestAnimationFrame(this.gameLoop.bind(this));
    }

    /**
     * @brief Gestisce l'inizio del tocco.
     * @param {TouchEvent} event - L'evento di tocco.
     */
    handleTouchStart(event) {
        this.touchStartX = event.touches[0].clientX;
        this.touchStartY = event.touches[0].clientY;
    }

    /**
     * @brief Gestisce la fine del tocco.
     * @param {TouchEvent} event - L'evento di tocco.
     */
    handleTouchEnd(event) {
        const touchEndX = event.changedTouches[0].clientX;
        const touchEndY = event.changedTouches[0].clientY;
        const diffX = touchEndX - this.touchStartX;
        const diffY = touchEndY - this.touchStartY;

        if (Math.abs(diffX) > Math.abs(diffY)) {
            if (diffX > 0) {
                frog.move('right');
            } else {
                frog.move('left');
            }
        } else {
            if (diffY > 0) {
                frog.move('down');
            } else {
                frog.move('up');
            }
        }
    }
}

const game = new Game();

// Gestione degli eventi di tastiera
document.addEventListener('keydown', function(event) {
    switch(event.key) {
        case 'ArrowUp':
            frog.move('up');
            break;
        case 'ArrowDown':
            frog.move('down');
            break;
        case 'ArrowLeft':
            frog.move('left');
            break;
        case 'ArrowRight':
            frog.move('right');
            break;
    }
});

// Gestione degli eventi di tocco
canvas.addEventListener('touchstart', function(event) {
    game.handleTouchStart(event);
});

canvas.addEventListener('touchend', function(event) {
    game.handleTouchEnd(event);
});
