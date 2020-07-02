//function to change language
function changeLanguage () {
    var language = $("#languages").val();
    window.location.href = "../"+language;    
}

//function to open menu
function Toggle (item) {
	$("#"+item).slideToggle();
}

//function to check one required field
function checkOneField(field) {
	var field = $("#" + field);
	if (field.val() == "") {
		$("#btn-submit").attr('disabled', 'disabled');
		field.addClass('input-error');
		var fieldName = field.prop('name');	
		var msg = "The field: " + fieldName + " cannot be empty!";
		alert(msg);	
	}
	else {
		$("#btn-submit").removeAttr('disabled');
	}
}

function markAsSoldOut (Id) {
    $.post ("includes/mark_as_sold_out.php", {
        Id: Id
    }, function (data) {

		if (data == 0) {
			var msg = "Post updated successfully!";
			alert(msg);
			reloadPosts('my_posts.php'); 
		}

		if (data == 1) {
			var errorMsg = "There was a connection error! Please try again!";
			alert(errorMsg);
			reloadPosts('my_posts.php');
		}        
    });
}

function increaseLimit () {
	var limit = $("#limit").val();
	var newLimit = parseInt(limit) + parseInt(6);
	$("#limit").val(newLimit);
}

function clearSearch () {
	$("#search").val("");
	location.reload();
}

function checkComment (Id) {
	var comment = $("#Comment" + Id).html();
	$("#btn-comment" + Id).css("display", "block");	
}