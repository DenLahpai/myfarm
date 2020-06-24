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
        alert(data);
        reloadPosts('my_posts.php'); 
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