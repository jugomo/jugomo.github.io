// $(window).unload(function(){
	//if (window.location.indexOf("#") >= 0) {
  	//localStorage.removeItem("myWebSelection");
		//alert('o');
	//}
// });

// $(function() {
	//$('.project6').on('appear', function() {
//      $('#chaotic_1').attr("src", "img/chaotic_1.png");
//			alert('ola ke ase');
//  });

// $('.project6').appear();
//
// 	$(document.body).on('appear', '.project6', function(e, $affected) {
// 	    // this code is executed for each appeared element
// 	    $(this).yellowFade();
//
// 	    $('#chaotic_1').attr("src", "img/chaotic_1.png");
// 			alert('ola ke ase');
// 	  });
// });

$(window).load(function() {
	setTimeout(function(){
  	$(".loading").hide();
	}, 1000);
})

$(document).ready(function(){

	// SCROLL TO A CLICKED PROJECT INTO THE PROJECTS TAB
	$(".pButton").on("click", function(){
		var container = $('.div_content3_inner');
		var itemID = "#project" + this.id;
		var scrollTo = $(itemID);

		//scroll to position
		container.animate({
		    scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop() - 15
		});

		//add styles
		$('.div_content3_header span').removeClass("pButtonHover");

		$("#"+this.id).addClass("pButtonHover");
	});

	// ACTIVATE THE PREVIOUS SAVED ACTIVE TAB
	var sel = localStorage.getItem("myWebSelection");
	if (sel !== null) {
		toggleContent(sel);
	}


	$('.jspDrag').hide();
	$('.jspScrollable').mouseenter(function(){
		$('.jspDrag').stop(true, true).fadeIn('slow');
	});
	$('.jspScrollable').mouseleave(function(){
		$('.jspDrag').stop(true, true).fadeOut('slow');
	});


	// Mostrar info de usuario de la barra inferior
	$("#footer").mouseover(function() {
		$(".div_full_contact").css("display","block");
	});
	//$("#footer").mouseout(function() {
	//	$(".div_full_contact").css("display","none");
	//});
	$("#footer").click(function() {
		if ($('.div_full_contact').css("display") == "none") {
			$(".div_full_contact").css("display","block");
		} else {
			$(".div_full_contact").css("display","none");
		}
	});
	$(".div_contact").click(function() {
		if ($('.div_full_contact').css("display") == "block") {
			$(".div_full_contact").css("display","none");
		}
	});
});

function toggleContent(pos) {
	if (pos==1) {
		$('.div_content1').delay(200).fadeIn('slow');
		$('.div_content4').hide();
		$('.div_content3').hide();
		$('.div_content2').hide();
		localStorage.setItem("myWebSelection", "1");
		$('#a1').addClass("a1focus");
		$('#a2').removeClass("a2focus");
		$('#a3').removeClass("a3focus");
		$('#a4').removeClass("a4focus");
	} else if (pos==2) {
		$('.div_content2').delay(200).fadeIn('slow');
		$('.div_content4').hide();
		$('.div_content3').hide();
		$('.div_content1').hide();
		localStorage.setItem("myWebSelection", "2");
		$('#a1').removeClass("a1focus");
		$('#a2').addClass("a2focus");
		$('#a3').removeClass("a3focus");
		$('#a4').removeClass("a4focus");
	} else if (pos==3) {
		$('.div_content3').delay(200).fadeIn('slow');
		$('.div_content4').hide();
		$('.div_content2').hide();
		$('.div_content1').hide();
		localStorage.setItem("myWebSelection", "3");
		$('#a1').removeClass("a1focus");
		$('#a2').removeClass("a2focus");
		$('#a3').addClass("a3focus");
		$('#a4').removeClass("a4focus");
	} else if (pos==4) {
		$('.div_content4').delay(200).fadeIn('slow');
		$('.div_content3').hide();
		$('.div_content2').hide();
		$('.div_content1').hide();
		localStorage.setItem("myWebSelection", "4");
		$('#a1').removeClass("a1focus");
		$('#a2').removeClass("a2focus");
		$('#a3').removeClass("a3focus");
		$('#a4').addClass("a4focus");
	}
}
