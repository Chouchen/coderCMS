
// remap jQuery to $
(function($){
var t = null;
$('.project').hide();
//$('.fancybox').fancybox({autoDimensions:false});
$('.projectLink').click(function(){
	var id = $(this).attr('id');
	$.getJSON('get.php', {q: id}, function(data){
		t = data;
		$('.project').slideUp("fast", 
			function(){
				$(this).html('').append('<h3><a href="'+t.childs.link+'">'+t.childs.title+'</a></h3>').append(t.childs.text).slideDown();
			}
		);
	});
});

})(window.jQuery);



// usage: log('inside coolFunc',this,arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function(){
  log.history = log.history || [];   // store logs to an array for reference
  log.history.push(arguments);
  if(this.console){
    console.log( Array.prototype.slice.call(arguments) );
  }
};



// catch all document.write() calls
(function(doc){
  var write = doc.write;
  doc.write = function(q){ 
    log('document.write(): ',arguments); 
    if (/docwriteregexwhitelist/.test(q)) write.apply(doc,arguments);  
  };
})(document);


