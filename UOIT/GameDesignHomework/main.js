// Game, UI, and Player Object
var UI   = {};
var Game = {};
// Game.test = true;


// UI Settings
UI.board          = $('#ui');
UI.healthBar      = $('#health-bar');
UI.manaBar        = $('#mana-bar');
UI.scoreBoard     = $('#score-board');
UI.dimensions     = {
  minX: 0,
  maxX: UI.board.width(),
  minY: 0,
  maxY: UI.healthBar.height()
};

UI.UpdateHealth = function (amount) {
  Game.health += amount;
}
console.log(UI);


// Game Settings
Game.board        = $('#game');
Game.fps          = 30;
Game.score        = 0;
Game.health       = 100;
Game.enemyCount   = 20;
Game.dimensions   = {
  minX: 0,
  maxX: Game.board.width(),
  minY: UI.dimensions.maxY,
  maxY: Game.board.height(),
  tolerance: 10.0
};

// Game Assets
Game.assets = {
  enemies: []
};

Game.assets.Draw = function (x, y, classWord) {
  var asset = $('<div/>');
  asset.addClass(classWord);
  asset.css({
    left: x,
    top: y
  });
  $('#game').append(asset);
};

Game.assets.DrawLevel1Enemies = function (x, y) {
  Game.assets.Draw(x, y, 'level1Enemies');
}

console.log(Game);


// Player Settings
Player = {};
Player.element    = $('#ship');
Player.dimensions = {
  minX: 0,
  maxX: Player.element.width(),
  minY: 0,
  maxY: Player.element.height()
};

// based on center of object
Player.position   = {
  x: Player.element.position().left + (Player.dimensions.maxX / 2),
  y: Player.element.position().top + (Player.dimensions.maxY / 2)
};

console.log(Player.position);

Player.rotation = {
  deg: 90,
  rad: Math.radians(90)
};

// Player running stats
Player.maxSpeed = 10;
Player.minSpeed = 0.5;
Player.curSpeed = 0;

// Assets
Player.assets = {
  sprite: "",
  powers: {
    primaryFireBullets: []
  }
};


// Controls
Player.controlMap = {};
Player.ControlEvents = function () {
  $(document).keydown($.proxy(this.Movement, this));
  $(document).keyup($.proxy(this.Movement, this));
  $(document).mousemove($.proxy(this.LookAt, this));
  $(document).mousedown($.proxy(this.PrimaryFire, this));
}

Player.Movement = function (event) {
  // controlMap[(str)key] = bool
  Player.controlMap[event.key] = event.type == "keydown";

  if (Game.test) console.log(Player.controlMap);
};

Player.LookAt = function (event) {
  if (event) {
    Player.controlMap.mouse = {
      x: event.pageX,
      y: event.pageY
    };
  } else {
    Player.controlMap.mouse = {
      x: 0,
      y: 0
    };
  }

  if (Game.test) console.log(Player.controlMap.mouse);
};

Player.PrimaryFire = function () {
  Player.assets.powers.primaryFireBullets.push({
    sprite: "",
    position: {
      x: Player.position.x,
      y: Player.position.y
    },
    theta: Player.rotation.rad,
    lookAt: Player.controlMap.mouse,
    speed: 10
  });

  if (Game.test) console.log(Player.assets.powers.primaryFireBullets);
};


Player.Update = function () {
  // rotate the ship
  var mouseVec = maths.Vector(Player.controlMap.mouse.x, Player.controlMap.mouse.y);
  var playerVec = maths.Vector(Player.position.x, Player.position.y);
  var deltaVec = maths.VecSub(mouseVec, playerVec);
  var rotation = Math.atan2(deltaVec.x, deltaVec.y);
  rotation = -1 * rotation;
  rotation = rotation - Math.radians(180);
  Player.rotation.deg = (Math.degrees(rotation));
  Player.rotation.rad = (rotation);

  if (Game.test) console.log(Player.rotation);

  // update movement
  if (Player.controlMap["w"]) {
    // control acceleration
    Player.curSpeed += Player.curSpeed <= Player.maxSpeed ? Player.minSpeed : 0;
    Player.position.x += deltaVec.norm.x * Player.curSpeed;
    Player.position.y += deltaVec.norm.y * Player.curSpeed;
  } else {
    Player.curSpeed -= Player.curSpeed > 0 ? Player.minSpeed : 0;
    Player.position.x += deltaVec.norm.x * Player.curSpeed;
    Player.position.y += deltaVec.norm.y * Player.curSpeed;
  }

  // Update the assets
  Player.assets.Update();
};

// Update the player assets
Player.assets.Update = function () {
  for (var i = 0; i < Player.assets.powers.primaryFireBullets.length; i++) {
    var power = Player.assets.powers.primaryFireBullets[i];
    power.position.x += Math.cos(power.theta - Math.radians(90)) * power.speed;
    power.position.y += Math.sin(power.theta - Math.radians(90)) * power.speed;

    var x = power.position.x;
    var y = power.position.y;

    // check if off screen
    if (power.position.x > (Game.dimensions.maxX - Game.dimensions.tolerance) ||
        power.position.x < (Game.dimensions.minX + Game.dimensions.tolerance) ||
        power.position.y > (Game.dimensions.maxY - Game.dimensions.tolerance) ||
        power.position.y < (Game.dimensions.minY + Game.dimensions.tolerance)) {
      Player.assets.powers.primaryFireBullets.splice(i, 1);
    } else {
      // check if collided with enemy
      for (var e = 0; e < Game.assets.enemies.length; e++) {
        var eTop    = Game.assets.enemies[e].y;
        var eLeft   = Game.assets.enemies[e].x;
        var eRight  = Game.assets.enemies[e].x + 50;
        var eBottom = Game.assets.enemies[e].y + 50;

        // collision detection
        if (x > eLeft && x < eRight && y > eTop && y < eBottom) {
          Player.assets.powers.primaryFireBullets.splice(i, 1);
          Game.assets.enemies.splice(e, 1);

          // update score
          Game.score += 1;
          break;
        }
      }
    }
  }
};

Player.Draw = function () {
  Player.element.css({
    left: Player.position.x - Player.dimensions.maxX,
    top: Player.position.y - Player.dimensions.maxY,
    transform: "rotate(" + (Player.rotation.deg) + "deg)"
  });

  $('.primaryFireBullets').remove();
  for (var i = 0; i < Player.assets.powers.primaryFireBullets.length; i++) {
    var power = Player.assets.powers.primaryFireBullets[i];
    Player.assets.powers.DrawPrimaryFire(power.position.x - (Player.dimensions.maxX / 2), power.position.y - (Player.dimensions.maxY / 2));
  }
};

Player.assets.powers.DrawPrimaryFire = function (x, y) {
  Game.assets.Draw(x, y, 'primaryFireBullets');
}

console.log(Player);


Game.assets.Level1EnemiesUpdate = function () {
  // update enemy positionsw
  for (var i = 0; i < Game.assets.enemies.length; i++) {
    var playerVec = maths.Vector(Player.position.x, Player.position.y);
    var enemyVec  = maths.Vector(Game.assets.enemies[i].x, Game.assets.enemies[i].y);
    var deltaVec = maths.VecSub(playerVec, enemyVec);
    Game.assets.enemies[i].x += deltaVec.norm.x;
    Game.assets.enemies[i].y += deltaVec.norm.y;
  }

  // check if enemy has collided with the ship
  for (var i = 0; i < Game.assets.enemies.length; i++) {
    if (Player.CollisionCheck(Game.assets.enemies[i].x, Game.assets.enemies[i].y, [50, 50])) {
      // reset the enemy
      Game.assets.enemies[i].x = Game.dimensions.minX + 50;
      Game.assets.enemies[i].y = Game.dimensions.miny + 50;
      UI.UpdateHealth(-10);
    }
  }
}

Player.CollisionCheck = function (x, y, size) {
  var playerRight  = Player.position.x;
  var playerBottom = Player.position.y;
  var playerLeft   = Player.position.x;
  var playerTop    = Player.position.y;

  return (x + size[0]) > playerLeft &&
          x < playerRight &&
         (y + size[1]) > playerTop &&
          y < playerBottom;
}


Game.InitLevel1Enemies = function () {
  var enemySize = [50, 50];
  var playerRight = Player.position.x + Player.dimensions.maxX;
  var playerBottom = Player.position.y + Player.dimensions.maxY;
  var playerLeft = Player.position.x - Player.dimensions.maxX;
  var playerTop = Player.position.y - Player.dimensions.maxY;

  for (var i = 0; i < Game.enemyCount; i++) {
    var randX = Math.ceil(Math.random() * Game.dimensions.maxX - Game.dimensions.tolerance);
    var randY = Math.ceil(Math.random() * Game.dimensions.maxY - Game.dimensions.tolerance);

    // avoid drawing at the walls
    randX = randX > Game.dimensions.minX + enemySize[0] ? randX : Game.dimensions.minX + enemySize[0];
    randY = randY > Game.dimensions.minY + enemySize[1] ? randY : Game.dimensions.minY + enemySize[1];
    randX = randX < Game.dimensions.maxX - enemySize[0] ? randX : Game.dimensions.maxX - enemySize[0];
    randY = randY < Game.dimensions.maxY - enemySize[1] ? randY : Game.dimensions.maxY - enemySize[1];

    // avoid drawing on top of the ship
    var collision = (randX + enemySize[0]) > playerLeft &&
                     randX < playerRight &&
                     (randY + enemySize[1]) > playerTop &&
                     randY < playerBottom;

    if (collision) {
      randX += Player.dimensions.maxX + enemySize[0];
      randY += Player.dimensions.maxY + enemySize[1];
    }

    Game.assets.enemies.push({
      x: randX,
      y: randY
    });
  }
};


// Game Initialize
Game.Initialize = function () {
  Player.LookAt();
  Player.ControlEvents();

  
  // Initialize enemies
  Game.InitLevel1Enemies();
};

Game.DrawWin = function () {
  var win = $('<div/>');
  win.addClass('win');
  win.text('YOU WIN!!!');

  $('#game').append(win);

  // get center of screen
  var x = (Game.dimensions.maxX / 2) - win.width();
  var y = (Game.dimensions.maxY / 2) - win.height();

  win.css({
    left: x,
    top: y
  });
}

Game.DrawLose = function () {
  var loss = $('<div/>');
  loss.addClass('lose');
  loss.text('YOU LOSE!!!');

  $('#game').append(loss);

  // get center of screen
  var x = (Game.dimensions.maxX / 2) - loss.width();
  var y = (Game.dimensions.maxY / 2) - loss.height();

  loss.css({
    left: x,
    top: y
  });
}

// Game Update
Game.Update = function () {
  Player.Update();

  Game.assets.Level1EnemiesUpdate();
  if (Game.health <= 0) {
    Game.health = 0;
    Game.assets.enemies = [];
  }
};


// Game Draw
Game.Draw = function () {
  Player.Draw();

  // clear
  $('.win').remove();
  $('.lose').remove();

  // draw enemies
  $('.level1Enemies').remove();
  for (var i = 0; i < Game.assets.enemies.length; i++) {
    Game.assets.DrawLevel1Enemies(Game.assets.enemies[i].x, Game.assets.enemies[i].y);
  }

  // draw health and score
  if (Game.health <= 0) {
    $('#ui > #health-bar > .progress-bar').css({
      width: "0%",
      "background-color": "#333"
    });

    Game.DrawLose();
  } else {
    $('#ui > #health-bar > .progress-bar').css({
      width: Game.health + "%"
    });

    // win
    if (Game.assets.enemies.length <= 0) {
      Game.DrawWin();
    }
  }

  $('#score').text(Game.score);
};


// Game Run
Game.Run = function () {
  Game.Update();
  Game.Draw();
};


// The might loop
Game.Initialize();
Game._intervalId = setInterval(Game.Run, 1000 / Game.fps);

// enable tooltips
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})