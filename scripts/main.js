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

function checkReply (Id) {
	var reply = $("#Reply" + Id).html();
	$("#btn-reply" + Id).css("display", "block");
}

function markMailAsRead (Link) {
	$.post("includes/mark_mail_as_read.php", {
		MessagesLink: Link
		}, function (data) {
			if (data == 0) {
				window.location.href= 'read_message.html?MessagesLink=' + Link;
			}
			if (data == 1) {
				alert("There was a connection error! Please try again!");
			}
	});
}