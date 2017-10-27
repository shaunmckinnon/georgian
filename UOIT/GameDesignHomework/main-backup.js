/* Game Settings */
var Game = {};
Game.fps = 30;
Game.score = 0;
Game.enemyCount = 20;

// get screen height and width
var width  = $('body').width();
var height = $('body').height();

// subtract the UI height
var gameHeight = height - ($('#health-bar').height() + $('#mana-bar').height() + 20);

// set the World coordinates
var World = {}
World.topper    = Number(height - gameHeight);
World.bottom = height;
World.left   = 0;
World.right  = width;

// Ship details
var Ship = {};
// set hard limits for the div
$('#ship').css({
  "height": Ship.height,
  "width": Ship.width
});

Ship.element = $('#ship');
Ship.height  = Ship.element.height();
Ship.width   = Ship.element.width();
Ship.x       = (World.right / 2) - (Ship.width / 2);
Ship.y       = $('#ship').position().top + (Ship.height / 2);
Ship.speed   = 10;

var map = {
  theta: 0,
  bullets: [],
  enemies: []
};

// make the Ship move on the WASD keys
$(document).keydown(keyDownEvent);
$(document).keyup(keyDownEvent);
$(document).mousemove(mouseCoordinates);
$(document).mousedown(openFire);

function keyDownEvent (event) {
  map[event.key] = event.type == "keydown";
}

function mouseCoordinates (event) {
  map.mouseNew = {};
  map.mouseNew.x = event.pageX;
  map.mouseNew.y = event.pageY;
}

function openFire () {
  map.bullets.push({
    theta: map.theta, // the ship angle
    x: Ship.x + (Ship.width / 2), // the ship's x
    y: Ship.y + (Ship.height / 2) // the ship's y
  });
}

// States
var mouseLast = {
  x: 0,
  y: 0
};

// Drawing Assets functions
drawBullet = function (x, y) {
  var bullet = $('<div/>');
  bullet.addClass('bullet');
  bullet.css({
    left: x,
    top: y
  });
  $('#game').append(bullet);
}

drawEnemy = function (x, y) {
  var enemy = $('<div / >');
  enemy.addClass('enemy');
  enemy.css({
    left: x,
    top: y
  });
  $('#game').append(enemy);
}

drawWin = function () {
  var win = $('<div/>');
  win.addClass('win');
  win.text('YOU WIN!!!');

  $('#game').append(win);

  // get center of screen
  var x = (World.right / 2) - win.width();
  var y = (World.bottom / 2) - win.height();

  win.css({
    left: x,
    top: y
  });
}

drawLoss = function () {
  var loss = $('<div/>');
  loss.addClass('loss');
  loss.text('YOU LOSE!!!');

  $('#game').append(loss);

  // get center of screen
  var x = (World.right / 2) - loss.width();
  var y = (World.bottom / 2) - loss.height();
  console.log(loss.width());

  loss.css({
    left: x,
    top: y
  });
}

// draw a slew of enemies
for (var i = 0; i < Game.enemyCount; i++) {
  var randX = Math.ceil(Math.random() * World.right - 50);
  var randY = Math.ceil(Math.random() * World.bottom - 50);

  randX = randX > World.left + 50 ? randX : World.left + 50;
  randY = randY > World.topper + 50 ? randY : World.topper + 50;
  randX = randX < World.right - 50 ? randX : World.right - 50;
  randX = randY < World.bottom - 50 ? randX : World.bottom - 50;
  this.drawEnemy(randX, randY);

  map.enemies.push({
    x: randX,
    y: randY
  });
}


// Game update
Game.update = function () {
  // update the ship position
  if (map["w"]) {
    Ship.y -= Ship.speed;
  }

  if (map["a"]) {
    Ship.x -= Ship.speed;
  }

  if (map["s"]) {
    Ship.y += Ship.speed;
  }

  if (map["d"]) {
    Ship.x += Ship.speed;
  }

  // rotate the ship
  if (map.mouseNew && (map.mouseNew.x != mouseLast.x || map.mouseNew.y != mouseLast.y)) {
    var mouseVector = maths.Vector(map.mouseNew.x, map.mouseNew.y);
    mouseLast.x     = map.mouseNew.x;
    mouseLast.y     = map.mouseNew.y;

    var shipTan = Math.atan2((Ship.x - mouseVector.x), (Ship.y - mouseVector.y));
    map.theta = -shipTan;
  }

  // update bullet positions
  for (var i = 0; i < map.bullets.length; i++) {
    map.bullets[i].x += Math.cos(map.bullets[i].theta - Math.radians(90)) * 5;
    map.bullets[i].y += Math.sin(map.bullets[i].theta - Math.radians(90)) * 5;

    var x = map.bullets[i].x;
    var y = map.bullets[i].y;

    // remove an enemy and the bullet if collision
    for (var e = 0; e < map.enemies.length; e++) {
      var eTop = map.enemies[e].y;
      var eLeft = map.enemies[e].x;
      var eRight = map.enemies[e].x + 50;
      var eBottom = map.enemies[e].y + 50;

      // collision detection
      if (x > eLeft && x < eRight && y > eTop && y < eBottom) {
        map.bullets.splice(i, 1);
        map.enemies.splice(e, 1);

        // update score
        Game.score += 1;
        break;
      }
    }

    // if the bullet is undefined (removed)
    if (!map.bullets[i]) {
      continue;
    }

    // remove the bullets if off screen
    if (map.bullets[i].x > (World.right - 10) ||
        map.bullets[i].x < World.left ||
        map.bullets[i].y > (World.bottom - 10) ||
        map.bullets[i].y < World.topper) {
        map.bullets.splice(i, 1);
    }
  }

  // set the win
  if (map.enemies.length == 0) {
    // remove win
    $('.win').remove();
    drawWin();
  } else {
    // update enemy positions (seeking the ship)
    for (var i = 0; i < map.enemies.length; i++) {
      var shipVec = maths.Vector(Ship.x, Ship.y);
      var enemVec = maths.Vector(map.enemies[i].x, map.enemies[i].y);
      var rVec = maths.VecSub(shipVec, enemVec);
      map.enemies[i].x += rVec.norm.x;
      map.enemies[i].y += rVec.norm.y;

      // collision detection against the ship
      var x = map.enemies[i].x;
      var y = map.enemies[i].y;
      var sTop = Ship.y;
      var sLeft = Ship.x;
      var sRight = Ship.x + 123;
      var sBottom = Ship.y + 100;
      if (x > sLeft && x < sRight && y > sTop && y < sBottom) {
        $('.loss').remove();
        drawLoss();
        break;
      }
    }
  }
}

// Game draw
Game.draw = function () {
  // move the ship
  $('#ship').css({
    left: Ship.x,
    top: Ship.y,
    transform: "rotate(" + Math.degrees(map.theta) + "deg)"
  });

  // clear bullets, then draw
  $('.bullet').remove();

  // clear enemies, then draw
  $('.enemy').remove();

  // draw bullets
  for (var i = 0; i < map.bullets.length; i++) {
    drawBullet(map.bullets[i].x, map.bullets[i].y);
  }

  // draw enemies
  for (var i = 0; i < map.enemies.length; i++) {
    drawEnemy(map.enemies[i].x, map.enemies[i].y);
  }

  // update score
  $('#score').text(Game.score);
}

// Game Loop
Game.run = function () {
  Game.update();
  Game.draw();
}

// Loop it!
Game._intervalId = setInterval(Game.run, 1000 / Game.fps);