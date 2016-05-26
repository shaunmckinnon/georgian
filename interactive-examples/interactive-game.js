/* STANDARD GAME PIECES */
// constructor
function InteractiveGame ( options ) {
  this.options = options                                || {};
  this.startTime = this.options.startTime               || undefined;
  this.gameArray = this.options.gameArray               || [];
  this.sortableSelector = this.options.sortable         || '#sortable';
  this.codeLanguage = this.options.codeLanguage         || 'php';

  this.listElements = [];

  this.createListElements();

  this.initSortable();

  this.initiateModal();
}

// initialize the jQuery sortable
InteractiveGame.prototype.initSortable = function () {
  var thus = this;
  $( this.sortableSelector ).sortable({
    revert: true,
    create: function () {
      var lisArray = $( thus.sortableSelector ).find( 'li' );
      thus.orderCheck( lisArray );
    },
    start: function () {
      if ( thus.startTime == undefined ) {
        console.log('Starting timer');
        thus.startTime = new Date().getTime() / 1000;
        console.log(thus.startTime);
      }
    },
    stop: function () {
      var lisArray = $( thus.sortableSelector ).find( 'li' );
      thus.orderCheck( lisArray );
    }
  });
};

// shuffle the array
InteractiveGame.prototype.shuffle = function () {
  this.listElements = _.shuffle( this.listElements );
};

// check for a win
InteractiveGame.prototype.winCheck = function () {
  var successCount = $( this.sortableSelector ).find('.fa-check').length;
  if ( successCount == this.listElements.length ) {
    this.triggerWinState();
  }
};

// Win State
InteractiveGame.prototype.triggerWinState = function () {
  var time = this.getTotalTime();
  $('body').prepend('<div class="alert alert-success">You solved this in ' + time + ' seconds!</div>');
  this.userFinishedGame();
};

// check the order
InteractiveGame.prototype.orderCheck = function ( lisArray ) {
  $.each( lisArray, function (index, element) {
    if ( $(this).data('org-pos') == index ) {
      $(this).find('.indicator').removeClass('fa-remove');
      $(this).find('.indicator').addClass('fa-check');
    } else {
      $(this).find('.indicator').removeClass('fa-check');
      $(this).find('.indicator').addClass('fa-remove');
    }
  });

  this.winCheck();
};

// create list elements
InteractiveGame.prototype.createListElements = function () {
  var thus = this;
  $.each( this.gameArray, function (i) {
    thus.listElements.push( '<li data-org-pos="' + i + '" class="ui-state-default""><i class="move fa fa-arrows"></i><div class="code-block"><pre><code class="language-php">' + thus.gameArray[i] + '</code></pre></div><i class="indicator fa"></i></li>' );
  });

  this.shuffle();
  this.createBoard();
};

// create board
InteractiveGame.prototype.createBoard = function () {
  var thus = this;
  $.each( this.listElements, function (i) {
    $( thus.sortableSelector ).append( thus.listElements[i] );
  });
};

// get end total time
InteractiveGame.prototype.getTotalTime = function () {
  return Math.round( ( new Date().getTime() / 1000 ) - this.startTime );
};

/* Multiplayer Methods */
InteractiveGame.prototype.addModal = function () {
  var strVar="";
  strVar += "<div id=\"username-modal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\">";
  strVar += "      <div class=\"modal-dialog\">";
  strVar += "        <div class=\"modal-content\">";
  strVar += "          <div class=\"modal-header\">";
  strVar += "            <span id='modal-notification'></span>";
  strVar += "            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;<\/span><\/button>";
  strVar += "            <h4 class=\"modal-title\">Game Username &amp; Game Code<\/h4>";
  strVar += "          <\/div>";
  strVar += "          <div class=\"modal-body\">";
  strVar += "            <form id=\"game_username\">";
  strVar += "              <div class=\"form-group\">";
  strVar += "                <input type=\"text\" name=\"name\" placeholder=\"You Full Name\" class=\"form-control\">";
  strVar += "              <\/div>";
  strVar += "              <div class=\"form-group\">";
  strVar += "                <input type=\"text\" name=\"code\" placeholder=\"The Game Code Here\" class=\"form-control\">";
  strVar += "              <\/div>";
  strVar += "            <\/form>";
  strVar += "          <\/div>";
  strVar += "          <div class=\"modal-footer\">";
  strVar += "            <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close<\/button>";
  strVar += "            <button id=\"game-play\" type=\"button\" class=\"btn btn-primary\">Play<\/button>";
  strVar += "          <\/div>";
  strVar += "        <\/div>";
  strVar += "      <\/div>";
  strVar += "    <\/div>";

  $('body').append(strVar);
};

InteractiveGame.prototype.showModal = function () {
  $( '#username-modal' ).modal( 'show' );
};

InteractiveGame.prototype.hideModal = function () {
  $( '#username-modal' ).modal( 'hide' );
};

InteractiveGame.prototype.initiateModal = function () {
  var thus = this;

  this.addModal();
  this.showModal();

  $( '#game-play' ).click( function () {
    thus.addUserToGame();
  });
};

InteractiveGame.prototype.addUserToGame = function () {
  var thus = this;

  $.post( 'add_user_to_game.php', $('#game_username').serialize() ).done( function (data) {
    if ( Number( $.parseJSON( data ) ) > 0 && $.parseJSON( data ) != "false" ) {
      thus.userId = Number( $.parseJSON( data ) );
      thus.hideModal();
    } else {
      $( '#modal-notification' ).html('<div class="alert alert-danger">There was an error. Please try again.</div>');
    }
  });
};

InteractiveGame.prototype.userFinishedGame = function () {
  var thus = this;
  if ( this.userId ) {
    $.post( 'user_finished_game.php', {
      user_id: thus.userId,
      total_time: thus.getTotalTime()
    }).done( function (data) {
      location.href = 'winners.php?game_code_id=' + Number($.parseJSON(data));
    });
  }
};

















