//Photo modal
$('div.aaaa').magnificPopup({ 
  type: 'image',
  delegate: 'a',
  
  gallery:{enabled:true},
  callbacks: {
    
    disableOn: function() {
  if( $(window).width() < 3000 ) {
    return false;
  }
  return true;
}
    
  }
});
//end photo modal