function SCMath () {
  // console.log("SCMath Init");

  // structs
  // default matrix
  this.IdentMat = [
    [1, 0, 0, 1],
    [0, 1, 0, 1],
    [0, 0, 1, 1],
    [0, 0, 0, 1]
  ];

  // catmull-rom spline matrix
  this.CatumllMat = [
    [-1,  3, -3,  1],
    [ 2, -5,  4, -1],
    [-1,  0,  1,  0],
    [ 0,  2,  0,  0]
  ];
  this.CatumllMat = this.MatScalar(this.CatumllMat, 0.5);

  // bezier curve matrix
  this.BezierMat = [
    [-1,  3, -3,  1],
    [ 3, -6,  3,  0],
    [-3,  3,  0,  0],
    [ 1,  0,  0,  0]
  ];
}

// matrix1.rows == matrix2.cols
SCMath.prototype.MatMult = function (matrix1, matrix2) {
  var result = new Array;
  var i, j;

  // iterate through each mat1 row
  for (var i = 0; i < matrix1.length; i++) {
    rowCalc = new Array;

    // iterate through each mat2 col
    for (var j = 0; j < matrix2[0].length; j++) {
      var colSum = 0;

      // iterate through each mat2 row
      for (var k = 0; k < matrix2.length; k++) {
        colSum += matrix1[i][k] * matrix2[k][j];
      }

      // add the column sum to the row
      rowCalc.push(colSum);
    }

    // push the row into the result
    result.push(rowCalc);
  }

  return result;
}

// matrix1.rows & matrix1.cols == matrix2.rows & matrix2.cols
SCMath.prototype.MatAdd = function (matrix1, matrix2) {
  var result = new Array;

  // iterate through each row
  for (var i = 0; i < matrix1.length; i++) {
    var rowTemp = new Array;

    // iterate through each column
    for (var j = 0; j < matrix1[i].length; j++) {
      rowTemp.push(matrix1[i][j] + matrix2[i][j]);
    }

    // push the row
    result.push(rowTemp);
  }

  return result;
}

SCMath.prototype.MatSub = function (matrix1, matrix2) {
  var result = new Array;

  // iterate through each row
  for (var i = 0; i < matrix1.length; i++) {
    var rowTemp = new Array;

    // iterate through each column
    for (var j = 0; j < matrix1[i].length; j++) {
      rowTemp.push(matrix1[i][j] - matrix2[i][j]);
    }

    // push the row
    result.push(rowTemp);
  }

  return result;
}

SCMath.prototype.MatScalar = function (matrix, scale) {
  var result = new Array;
  for (var i = 0; i < matrix.length; i++) {
    var rowResult = new Array;

    for (var j = 0; j < matrix[0].length; j++) {
      rowResult.push(matrix[i][j] * scale);
    }

    result.push(rowResult);
  }

  return result;
}

SCMath.prototype.Vector = function (pointX, pointY, pointZ = 0) {
  var vector = new Object;

  vector.x    = pointX;
  vector.y    = pointY;
  vector.z    = pointZ;
  vector.mag  = this.Mag(vector);
  vector.norm = this.Norm(vector);

  return vector;
}

SCMath.prototype.VecAdd = function (vector1, vector2) {
  var x, y, z;
  x = vector1.x + vector2.x;
  y = vector1.y + vector2.y;
  z = vector1.z + vector2.z;
  return this.Vector(x, y, z);
}

SCMath.prototype.VecSub = function (vector1, vector2) {
  var x, y, z;
  x = vector1.x - vector2.x;
  y = vector1.y - vector2.y;
  z = vector1.z - vector2.z;
  return this.Vector(x, y, z);
}

SCMath.prototype.Theta = function (vector1, vector2) {
  // console.log("Theta Called: ");
  var dot      = this.Dot(vector1, vector2);
  var cosTheta = dot / (vector1.mag * vector2.mag);
  var theta    = Math.acos(cosTheta);
  
  return theta;
}

SCMath.prototype.Angle = function (vector1, vector2) {
  var temp = this.VecSub(vector1, vector2);
  var angle = Math.atan(temp.y / temp.x);
  return angle;
}

SCMath.prototype.Mag = function (vector) {
  var mag = Math.sqrt(Math.pow(vector.x, 2) + Math.pow(vector.y, 2) + Math.pow(vector.z, 2));
  // console.log(mag);
  return mag;
}

SCMath.prototype.Norm = function (vector) {
  return {
    x: (vector.x / vector.mag), 
    y: (vector.y / vector.mag),
    z: (vector.z / vector.mag)
  };
}

SCMath.prototype.VecScalar = function (vector, scale) {
  return this.Vector(vector.x * scale, vector.y * scale, vector.z * scale);
}

SCMath.prototype.Dot = function (vector1, vector2) {
  var dot = (vector1.x * vector2.x) + (vector1.y * vector2.y) + (vector1.z * vector2.z);
  // console.log(dot);
  return dot;
}

SCMath.prototype.Cross = function (vector1, vector2) {
  var result = new Array;

  result.push((vector1.y * vector2.z) - (vector1.z * vector2.y));
  result.push((vector1.z * vector2.x) - (vector1.x * vector2.z));
  result.push((vector1.x * vector2.y) - (vector1.y * vector2.x));

  return this.Vector(result[0], result[1], result[2]);
}

SCMath.prototype.Proj = function (vector1, vector2) {
  var dot = this.Dot(vector1, vector2);
  var magVec2Sq = Math.pow(vector2.mag, 2);
  var scale = dot / magVec2Sq;

  return this.VecScalar(vector2, scale);
}

SCMath.prototype.Transform = function (translate, rotate, scale, matrix = this.IdentMat) {
  
}

SCMath.prototype.Translate = function (translationVector, matrix = this.IdentMat) {
  return this.MatMult(matrix, this.VecToMat4(translationVector));
}

SCMath.prototype.Rotate = function (axis, angle, matrix = this.IdentMat) {
  angle = Math.radians((angle / 100));
  switch(axis) {
    case "x":
      return this.Roll(angle, matrix);
      break;

    case "y":
      return this.Pitch(angle, matrix);
      break;
      
    case "z":
      return this.Yaw(angle, matrix);
      break;
  }

  return false;
}

// rotate around Y
SCMath.prototype.Pitch = function (angle, matrix = this.IdentMat) {
  var RotMat = [
    [(Math.cos(angle)),      0, (Math.sin(angle)), 1],
    [0,                      1, 0, 1],
    [(-1 * Math.sin(angle)), 0, (Math.cos(angle)), 1],
    [0,                      0, 0, 1]
  ];

  return this.MatMult(matrix, RotMat);
}

// rotate around Z
SCMath.prototype.Yaw = function (angle, matrix = this.IdentMat) {
  var RotMat = [
    [0, (Math.cos(angle)), (-1 * Math.sin(angle)), 1],
    [0, (Math.sin(angle)), (Math.cos(angle)),      1],
    [0, 0, 1,                                      1],
    [0, 0, 0,                                      1]
  ];

  return this.MatMult(matrix, RotMat);
}

// rotate around X
SCMath.prototype.Roll = function (angle, matrix = this.IdentMat) {
  var RotMat = [
    [1, 0, 0, 1],
    [0, (Math.cos(angle)), (-1 * Math.sin(angle)), 1],
    [0, (Math.sin(angle)), (Math.cos(angle)),      1],
    [0, 0, 0, 1]
  ];

  return this.MatMult(matrix, RotMat);
}

SCMath.prototype.Scale = function (scaleVector, matrix = this.IdentMat) {
  return this.MatMult(matrix, VecToMat4(scaleVector));
}



// helpful utilities
SCMath.prototype.VecToMat4 = function (vector) {
  return [
    [vector.x, 0, 0, 1],
    [vector.y, 0, 0, 1],
    [vector.z, 0, 0, 1],
    [0,        0, 0, 1]
  ];
}

Math.radians = function (degrees) {
  return degrees * Math.PI / 180;
}

Math.degrees = function (radians) {
  return radians * 180 / Math.PI;
}

maths = new SCMath();