function addNewInp() {
  if ( this.value.length == 0 ) return;

  // get the last DIV which ID starts with ^= "klon"
  var $div = $( 'div[id^="game"]:last' );

  // Read the Number from that DIV's ID (i.e: 3 from "klon3")
  // And increment that number by 1
  var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) + 1;

  // Clone it and assign the new ID (i.e: from num 4 to ID "klon4")
  var new_game = $div.clone().prop( 'id', 'game' + num );
  
  new_game.find('input').val('');
  new_game.find('.tickets-count').val('5');
  new_game.find('.price').val('200');
  new_game.find('.num').text(num);

  $('.games-container').append(new_game);

  this.onkeyup = null;
}